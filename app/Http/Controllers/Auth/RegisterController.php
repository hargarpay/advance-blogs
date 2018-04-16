<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;
    

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, $status = true, $id = null)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => $status === true ? 'required|string|email|max:255|unique:users' : 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => $status === true ? 'required|string|min:6|confirmed' : 'sometimes|confirmed',
            'role' => 'required|integer|min:1'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->roles()->attach([$data['role']]);
        return $user;
    }

    public function showRegistrationForm()
    {
        if(auth()->user()->cannot('create-user')){
            $title = 'Permission Deny';
            return view('errors.401', compact('title'));
        }
        $title = 'Create User';

        $roles = \App\Role::pluck('name', 'id')->all();

        return view('auth.register', compact('title','roles'));
    }

    public function register(Request $request)
    {
        if(auth()->user()->cannot('create-user')){
            $title = 'Permission Deny';
            return view('errors.401', compact('title'));
        }
        $validate = $this->validator($request->all());

        if($validate->passes()){
            $this->create($request->all());
            flash('Successfully created user')->success();

            return redirect()->back();

        }
        flash('Something is wrong')->error();
        return redirect()->back()
                        ->withErrors($validate)
                        ->withInput();
    }

    public function view(){
        $title = "View Users";

        $users = User::paginate(15);

        return view('auth.view', compact('title', 'users'));
    }

    public function edit(User $user){
        if(auth()->user()->cannot('update-user')){
            $title = 'Permission Deny';
            return view('errors.401', compact('title'));
        }
        $title = "Edit User";
        $roles = \App\Role::pluck('name', 'id')->all();
        return  view('auth.edit', compact('title', 'user', 'roles'));
    }

    public function update(Request $request, User $user){
        if(auth()->user()->cannot('update-user')){
            $title = 'Permission Deny';
            return view('errors.401', compact('title'));
        }
        $validate = $this->validator($request->all(), false, $user->id);
        if($validate->passes()){
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if($request->input('password') !== null){
                $user->password = bcrypt($request->input('email'));
            }
            $user->save();
            $user->roles()->sync([$request->input('role')]);
            flash('Successfully updated user')->success();

            return redirect()->back();

        }
        flash('Something is wrong')->error();
        return redirect()->back()
                        ->withErrors($validate)
                        ->withInput();
    }

    public function delete(User $user){
        if(auth()->user()->cannot('delete-user')){
            $title = 'Permission Deny';
            return view('errors.401', compact('title'));
        }
        $user->delete();
        flash('Successfully deleted user')->success();
        return redirect()->back();
    }

}

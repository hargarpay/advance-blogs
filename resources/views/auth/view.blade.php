@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading padding" style=""><h3>View Users</h3> <a href="{{route('register')}}" class="btn btn-info pull-right">Create User</a></div>

                <div class="panel-body">

                    <table class="table table-striped table-bordered" id="user-table">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th colspan="2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                         @php $page = (isset($_GET['page'])) ? ((int)$_GET['page'] - 1) : 0; $counter = $page * $users->perPage() @endphp
                        @forelse($users as $user)
                            <tr>
                                <td>{{++$counter}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->roles()->first()->name}}</td>
                                <td class="actions-button"><a href="{{route('update.user', ['user' => $user->id])}}" class="btn btn-info btn-block"><i class="glyphicon glyphicon-pencil"></i> Edit</a></td>
                                <td class="actions-button">
 
                                <a href="#" class="btn btn-danger btn-block" onclick="event.preventDefault(); document.getElementById('delete-user').submit();"><i class="glyphicon glyphicon-trash" ></i> Delete</a> 
                                    <form id="delete-user" action="{{ route('delete.user', ['user' => $user->id]) }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"><i class="glyphicon glyphicon-exclamation-sign"></i> Sorry, No Post has been created</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

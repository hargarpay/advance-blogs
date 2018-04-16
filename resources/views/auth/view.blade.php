@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading padding" ><h3>View Users</h3> <a href="{{route('register')}}" class="btn btn-info pull-right">Create User</a></div>

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
 
                                <a href="#" data-href="{{route('delete.user', ['user' => $user->id])}}" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-trash" ></i> Delete</a> 
                                   
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
                <div class="panel-footer" >
                    @include('pagination.default', ['paginator' => $users])
                </div>
            </div>
        </div>
    </div>
</div>
@include('partial.delete-put-method')
@endsection

@extends('layouts.app')

@section('content')

	
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-bordered" id="user-table">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Tile</th>
                            <th>Description</th>
                            <th>Date Created</th>
                            <th colspan="3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php @endphp
                        @forelse($posts as $post)
                            <tr>
                            	<td>{{$counter}</td>
                                <td>{{$post->name}}</td>
                                <td>{{$post->description}}</td>
                                <td>{{$post->created_at_format}}</td>
                                <td class="actions-button"><a href="#" class="btn btn-warning btn-block"><i class="glyphicon glyphicon-pencil"></i>Publish</a></td>
                                <td class="actions-button"><a href="#" class="btn btn-info btn-block"><i class="glyphicon glyphicon-pencil"></i>Edit</a></td>
                                <td class="actions-button"><a href="#" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-trash"></i>Delete</a></td>
                            </tr>
                        @empty
                        	<tr>
                            	<td colspan="7"><i class="glyphicon glyphicon-exclamation-sign"></i> Sorry, No Post has been created</td>
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
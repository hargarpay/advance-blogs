@extends('layouts.app')

@section('content')

	
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading padding"><h3>View Posts</h3> <a href="{{route('create.post')}}" class="btn btn-info pull-right">Create Post</a></div>

                <div class="panel-body">

                    <table class="table table-striped table-bordered" id="post-table">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $page = (isset($_GET['page'])) ? ((int)$_GET['page'] - 1) : 0; $counter = $page * $posts->perPage() @endphp
                        @forelse($posts as $post)
                            <tr>
                            	<td>{{++$counter}}</td>
                                <td data-title="Title">{{$post->title}}</td>
                                <td data-title="Description">{{substr($post->description, 0, 50)}} ...</td>
                                <td data-title="Date Created">{{$post->created_at_format}}</td>
                                <td class="actions-button dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        More <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a data-href="{{route('restore.post', ['post' => $post->id])}}" class="btn btn-success btn-block"><i class="glyphicon glyphicon-pencil"></i> Restore</a>
                                        </li>
                                        <li>
                                            <a data-href="{{route('delete.post', ['post' => $post->id])}}" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-trash"></i> Delete</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @empty
                        	<tr>
                            	<td colspan="5"><i class="glyphicon glyphicon-exclamation-sign"></i> Sorry, No Post has been trashed</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer" >
                    @include('pagination.default', ['paginator' => $posts])
                </div>
            </div>
        </div>
    </div>
</div>
@include('partial.delete-put-method')
@endsection
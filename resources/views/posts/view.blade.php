@extends('layouts.app')

@section('content')

	
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading padding">
                    <h3>View Posts</h3>
                    <a href="{{route('view.trash.posts')}}" class="btn btn-danger pull-right">View Trash Posts</a>
                    <span class="pull-right">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>
                    <a href="{{route('create.post')}}" class="btn btn-info pull-right">Create Post</a></div>

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
                                            <a class="btn btn-default btn-block non-script" href="{{route('view.single.post', ['post' => $post->id, 'slug' => str_slug($post->title)])}}">
                                                view
                                            </a>
                                        </li>
                                        <li>
                                            @if(!$post->published)
                                                <a href="#" class="btn btn-warning btn-block" data-href="{{route('publish.post', ['post' => $post->id])}}">Publish</a>
                                            @else
                                                <a href="" class="btn btn-default btn-block" data-href="{{route('draft.post', ['post' => $post->id])}}" >Draft</a>
                                            @endif
                                        </li>
                                        <li>
                                            <a href="{{ route('update.post', ['post' => $post->id]) }}" class="btn btn-info btn-block"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" data-href="{{ route('trash.post', ['post' => $post->id]) }}" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-trash"></i> Trash</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @empty
                        	<tr>
                            	<td colspan="5"><i class="glyphicon glyphicon-exclamation-sign"></i> Sorry, No Post has been created</td>
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
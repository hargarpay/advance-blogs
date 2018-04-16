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
                            <th colspan="3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $page = (isset($_GET['page'])) ? ((int)$_GET['page'] - 1) : 0; $counter = $page * $posts->perPage() @endphp
                        @forelse($posts as $post)
                            <tr>
                            	<td>{{++$counter}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{substr($post->description, 0, 50)}} ...</td>
                                <td>{{$post->created_at_format}}</td>
                                <td class="actions-button">
                                @if(!$post->published)
                                    <a href="#" class="btn btn-warning btn-block" data-href="{{route('publish.post', ['post' => $post->id])}}">Publish</a>
                                @else
                                    <a href="" class="btn btn-default btn-block" data-href="{{route('draft.post', ['post' => $post->id])}}" >Draft</a>
                                @endif
                                </td>
                                <td class="actions-button"><a href="{{ route('update.post', ['post' => $post->id]) }}" class="btn btn-info btn-block"><i class="glyphicon glyphicon-pencil"></i>Edit</a></td>
                                <td class="actions-button">
                                    <a href="#" data-href="{{ route('trash.post', ['post' => $post->id]) }}" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-trash"></i>Delete</a>
                                </td>
                            </tr>
                        @empty
                        	<tr>
                            	<td colspan="7"><i class="glyphicon glyphicon-exclamation-sign"></i> Sorry, No Post has been created</td>
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
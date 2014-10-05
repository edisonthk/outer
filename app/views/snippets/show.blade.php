@extends('layouts.base')

@section('meta')
<meta name="description" content="【★】">
<meta name="keywords" content="【★】">
<title>Codegarage</title>
@endsection

@section('content')
<div id="single-snippet">
	<div class="toolbar">
		<div class="btn-group">
		<a class="btn btn-edit" href="/snippet/{{$snippet->id}}/edit">
			<i class="fa fa-pencil"></i>&nbsp;Edit
		</a>
		{{ Form::open(array('method'=>'delete','url' => '/snippet/'.$snippet->id)) }}
			<button class="btn btn-delete" type="submit" onclick="return confirm('Are you sure you want to delete this item?');">
				<i class="fa fa-trash"></i>&nbsp;Delete
			</button>
		{{ Form::close() }}
		</div>
	</div>
	<h2>{{$snippet->title}}</h2>
	<div class="meta">
		<div class="tags-group">
			@foreach($snippet->tags()->getResults() as $tag)
				<span class="tag">{{$tag->name}}</span>
			@endforeach
		</div>
		<div class="datetime">last updated at {{$snippet->updated_at}} </div>
	</div>
	<hr />
	<div class="show_snippet_content">
		{{ $snippet->content }}
	</div>
</div>		
	
@stop

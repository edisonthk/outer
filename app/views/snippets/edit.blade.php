@extends('layouts.base')

@section('meta')
<meta name="description" content="【★】">
<meta name="keywords" content="【★】">
<title>CodeGarage</title>
@endsection


@section('content')
<h1>Edit Snippet</h1>
{{ HTML::ul($errors->all()) }}

{{ Form::model($snippet, array('route' => array('snippet.update', $snippet->id), 'method' => 'PUT')) }}

	<div class="form-group">
		{{ Form::label('title', 'title') }}
		{{ Form::text('title', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('content', 'content') }}
		{{ Form::text('content', null, array('class' => 'form-control')) }}
	</div>
	
	<div class="form-group">
		{{ Form::label('tags_id', 'tags_id') }}
		{{ Form::text('tags_id', null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('Edit the snippet!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@stop

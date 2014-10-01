  @extends('layouts.base')

@section('meta')
<meta name="description" content="【★】">
<meta name="keywords" content="【★】">
<title>CodeGarage</title>
@endsection


@section('content')
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('method'=>'post','url' => '/snippet')) }}

	<div class="form-group">
		{{ Form::label('title', 'title') }}
		{{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('content', 'content') }}
		{{ Form::text('content', Input::old('content'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('tags_id', 'tags_id') }}
		{{ Form::text('tags_id', Input::old('tags_id'), array('class' => 'form-control')) }}
	</div>


	{{ Form::submit('Create the snippet!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop

@extends('layouts.base')

@section('meta')
<meta name="description" content="【★】">
<meta name="keywords" content="【★】">
<title>CodeGarage</title>
@endsection

@section('head')
<script type="text/javascript" src="/plugins/textext/js/textext.core.js"></script>
<script type="text/javascript" src="/plugins/textext/js/textext.plugin.tags.js"></script>
<script type="text/javascript" src="/plugins/textext/js/textext.plugin.suggestions.js"></script>
<script type="text/javascript" src="/plugins/textext/js/textext.plugin.prompt.js"></script>
<script type="text/javascript" src="/plugins/textext/js/textext.plugin.focus.js"></script>
<script type="text/javascript" src="/plugins/textext/js/textext.plugin.filter.js"></script>
<script type="text/javascript" src="/plugins/textext/js/textext.plugin.autocomplete.js"></script>
<script type="text/javascript" src="/plugins/textext/js/textext.plugin.arrow.js"></script>
<script type="text/javascript" src="/plugins/textext/js/textext.plugin.ajax.js"></script>

<link rel="stylesheet" type="text/css" href="/plugins/textext/css/textext.core.css">
<link rel="stylesheet" type="text/css" href="/plugins/textext/css/textext.plugin.arrow.css">
<link rel="stylesheet" type="text/css" href="/plugins/textext/css/textext.plugin.autocomplete.css">
<link rel="stylesheet" type="text/css" href="/plugins/textext/css/textext.plugin.clear.css">
<link rel="stylesheet" type="text/css" href="/plugins/textext/css/textext.plugin.focus.css">
<link rel="stylesheet" type="text/css" href="/plugins/textext/css/textext.plugin.prompt.css">
<link rel="stylesheet" type="text/css" href="/plugins/textext/css/textext.plugin.tags.css">

<script type="text/javascript">
window.onload = function(){

	// ====================
	// textext auto complete tag jquery plugin
	// more detail on http://textextjs.com/manual/index.html
	$('#tags').textext({
        plugins : 'tags prompt focus autocomplete arrow ajax',
        tagsItems : {{Input::old('tags','[]')}},
        prompt : 'Add one...',
        ajax : {
            url : '/tag/api',
            dataType : 'json',
            cacheResults : true
        }
    });
}
</script>
@endsection

@section('content')

@if(!empty($errors->all()))
	<div class="alert alert-danger">
	{{ HTML::ul($errors->all()) }}
	</div>
@endif

{{ Form::open(array('method'=>'post','url' => '/snippet')) }}

	<div class="form-group">
		{{ Form::label('title', 'title') }}
		{{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('content', 'content') }}
		{{ Form::textarea('content', Input::old('content'), array('class' => 'form-control', 'size' => '30x5')) }}
	</div>

	<div class="form-group">
		{{ Form::label('tags', 'TAG') }}
		{{ Form::text('tags', '', array('id'=>'tags')) }}
	</div>


	{{ Form::submit('Create the snippet!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

@stop

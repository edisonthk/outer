@extends('layouts.base')

@section('meta')
<title>fsdfsd</title>
@endsection

@section('content')
	<div id="snippets">
		@foreach($snippets as $snippet)
		<div class="single-snippet">
			<div class="title">
				<p><a href="/snippet/{{$snippet->id}}">{{$snippet->title}}</a></p>
				{{-- <p>
					<a href="/snippet/{{$snippet->id}}/edit">Edit</a>
					{{ Form::open(array('method'=>'delete','url' => '/snippet/'.$snippet->id)) }}
						<input type="submit" value="Delete">
					{{ Form::close() }}
				</p> --}}
			</div>
			<div class="meta">
				<div class="tags-group">
					@foreach($snippet->tags()->getResults() as $tag)
						<span class="tag">{{$tag->name}}</span>
					@endforeach
				</div>
				<div class="datetime">created at {{$snippet->updated_at}} </div>
			</div>			
		</div>
		@endforeach
	</div>
@stop
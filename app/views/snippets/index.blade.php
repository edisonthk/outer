@extends('layouts.base')

@section('meta')
<title>fsdfsd</title>
@endsection

@section('content')
	<div id="snippets">
		@foreach($snippets as $snippet)
		<div>
			<div>
				<p><a href="/snippet/{{$snippet->id}}">{{$snippet->title}}</a></p>
				<p>
					<a href="/snippet/{{$snippet->id}}/edit">Edit</a>
					{{ Form::open(array('method'=>'delete','url' => '/snippet/'.$snippet->id)) }}
						<input type="submit" value="Delete">
					{{ Form::close() }}
				</p>
			</div>
			<div>
				<p>tag {{$snippet->tags_id}} </p>
				<p>created at {{$snippet->updated_at}} </p>
			</div>
		</div>
		@endforeach
	</div>
@stop
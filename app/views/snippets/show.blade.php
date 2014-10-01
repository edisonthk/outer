@extends('layouts.base')

@section('meta')
<title>fsdfsd</title>
@endsection

@section('content')
	<section>

	<div style="border:solid; border-width:1px; width:749px; margin:5px;">
		<div style="display:flex;">
			<p><?php echo $snippet->content ?></p>
		</div>
		<div style="display:flex; justify-content:space-between;">
			<p>tag<?php echo $snippet->tags_id ?></p>
			<p>created at <?php echo $snippet->created_at ?></p>
		</div>
	</div>
<hr>
	<div>
		<?php echo $snippet->content ?>
	</div>
<hr>
	<div>
		<p style="font-size:2rem;">Comments</p>
	<div></div>
	</div>
</section>

@stop

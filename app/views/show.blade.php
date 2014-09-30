<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style>
/* v2.0 | 20110126
  http://meyerweb.com/eric/tools/css/reset/ 
  License: none (public domain)
*/

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
	text-decoration:none;
}
/* HTML5 display-role reset for older browsers */
article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}
h1,h3,h4,h5,th{font-weight:bold;}
h1{color:#333;padding:0;margin:0 0 7px;text-align:left;}
h2{font-size:30px;font-weight:200;margin:20px 0 11px;padding:0;padding-bottom:10px;color:#333;}
h2 a{color:#333;}
h3{color:#666;}
h5{color:gray;}
h1{font-size:29px;font-weight:200;}
h3{font-size:18px;font-weight:normal;}
h4{font-size:16px;}
h5{font-size:14px;font-weight:bold;margin-bottom:2px;}
h6{font-size:65%;color:#666;font-weight:normal;}


.header {
	overflow: hidden;
	height: 60px;
	line-height: 60px;
	position: relative;	
	margin-bottom: 0px;
	margin-top:-16px;	
	/*background: linear-gradient(to bottom, #485053 0%,#3b4447 100%);*/
	background:#f1f1f1;
	border-bottom: 1px solid #e8e8e8;
}

.header-content{
	margin-left:130px;
	display:flex;
}

.logo{
	padding: 0px 20px;
	color: #485053;
	line-height:inherit;
	font-size: 150%
}
/*////////////////////////////////////////////////////////////////*/
h1,div.new{
	font-family:'Lato', sans-serif;
	text-align:center;
	color: #999;
}



.welcome {
	width: 300px;
	height: 200px;
	position: absolute;
	left: 50%;
	top: 50%;
	margin-left: -150px;
	margin-top: -100px;
}

.nav{
	width: 300px;
	height: 200px;
	position: absolute;
	left: 50%;
	top: 70%;
	margin-left: -150px;
	margin-top: -100px;
}

a, a:visited {
	text-decoration:none;
}

h1 {
	font-size: 32px;
	margin: 16px 0 0 0;
}
</style>
</head>
<body>
<header class="header">
	<div class="header-content" style="padding-right:30px;">
		<a href="http://localhost:8000/snippet" class="logo">My Code Garage</a>
		<a href="<?= "http://localhost:8000/snippet/create"; ?>">Create a snippet</a>
		<a href="<?= "http://localhost:8000/snippet/{$snippet->id}/edit"; ?>">Edit this snippet</a>
		<div style="margin-top:20px;">
			{{ Form::open(array('url' => 'snippet/' . $snippet->id)) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::submit('Delete this snippet') }}
			{{ Form::close() }}
		</div>
	</div>
</header>

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

</body>
</html>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
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
	border:solid;
	border-width:1px;
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
	margin:auto;
	margin-left:130px;
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
	<div class="header-content">
		<a href="" class="logo">My Code Garage</a>
		<a href="<?= "http://localhost:8000/snippet/create"; ?>">Create a snippet</a>
	</div>
</header>

<section style="display:flex;">

<section style="width:749px; margin:auto;">
	<form action="" method="get"><input type="text" name="search" value="Search your keywords here"></form>
	
	<div>(検索結果)</div>
	
	<?php foreach($snippets as $key =>$value): ?>
	<div>
		<?php $show_number = $value->id; ?>
		<div style="display:flex;">
			<p><?php echo $value->id ?></p>
			<p><a href="<?= "http://localhost:8000/snippet/{$show_number}"; ?>"><?php echo $value->title ?></a></p>
		</div>
		<div style="display:flex; justify-content:space-between;">
			<p>tag<?php echo $value->tags_id ?></p>
			<p>created at <?php echo $value->updated_at ?></p>
		</div>
	</div>
	<?php endforeach; ?>
</section>

<aside style="display:flex; flex-direction:column;" >
	<div>
		<a href="">Sign in</a>
	</div>
	<div style="width:286px;" >
		<p>About here</p>
		<p>Hi! Here's my garage of my history work. I am going to share with everyone about the work I have done and some of my experienced. Hope you will be benefit with it.</p>
	</div>
	<div>
		<p>Tags</p>
		<div>(tag一覧)</div>
	</div>
</aside>
</section>
</body>
</html>

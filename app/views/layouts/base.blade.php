<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no">
		<meta name="format-detection" content="telephone=no">
		@yield('meta')
		
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/common.css">

		<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>
		@yield('head')
	</head>
	<body>
		<nav>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1><a href="/">Codegarage</a></h1>
					</div>
				</div>
			</div>
			<div class="nav-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<input type="text" placeholder="search">
						</div>
					</div>
				</div>
			</div>
		</nav>
		<div class="wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-8">@yield('content')</div>
					<div class="col-md-4">
						<div class="sidebar">
							<a href="/snippet/create">Create new Snippet</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
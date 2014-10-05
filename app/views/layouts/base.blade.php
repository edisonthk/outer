<!doctype html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<!-- <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=no"> -->
		<meta name="format-detection" content="telephone=no">
		@yield('meta')
		
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/common.css">


		<script type="text/javascript" src="/lib/angular.min.js"></script>
		<script type="text/javascript" src="/angular/app.js"></script>
	</head>
	<body>
		<nav>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 id="logo"><a href="/">Codegarage</a></h1>
					</div>
				</div>
			</div>
			<div class="nav-bar">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<form class="navbar-form">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="search">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</nav>
		@yield('content')
	</body>
</html>
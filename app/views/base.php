<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="format-detection" content="telephone=no">
		<title>Codegarage</title>
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/common.css">

		<!-- Angularjs library -->
		<script type="text/javascript" src="/angular-libs/angular.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-route.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-sanitize.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-resource.min.js"></script>

		<!-- Angularjs Application -->
		<script type="text/javascript" src="/angular-js/app.js"></script>
		<script type="text/javascript" src="/angular-js/services.js"></script>
		<script type="text/javascript" src="/angular-js/controllers.js"></script>
		

	</head>
	<body ng-app="codegarageApp">
		
		<!-- static part -->
		<nav>
			
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<a id="logo" href="/"><i class="fa fa-code fa-lg"></i>&nbsp;CodeGarage</a>
						</div>
					</div>
				</div>
			
		</nav>
		

		<!-- dynamic part -->
		<div class="wrapper">
			<div class="table-cell" ng-view></div>
		</div>
	</body>
</html>

<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="format-detection" content="telephone=no">
		<title>Codegarage</title>
		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/common.css">
		<link rel="stylesheet" type="text/css" href="/css/anim.css">

		<!-- Angularjs library -->
		<script type="text/javascript" src="/angular-libs/angular.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-route.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-sanitize.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-resource.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-animate.min.js"></script>

		<!-- Plugins -->
		<link rel="stylesheet" type="text/css" href="/plugins/ngTagsInput/ng-tags-input.min.css">
		<link rel="stylesheet" type="text/css" href="/plugins/codemirror/codemirror.css">
		<link rel="stylesheet" type="text/css" href="/plugins/prettify/prettify.css">
		<link rel="stylesheet" type="text/css" href="/plugins/ngMarkdownEditor/angular-markdown-editor.min.css">

		<script type="text/javascript" src="/plugins/ngTagsInput/ng-tags-input.min.js"></script>
		<script type="text/javascript" src="/plugins/codemirror/codemirror.js"></script>
		<script type="text/javascript" src="/plugins/codemirror/gfm.js"></script>
		<script type="text/javascript" src="/plugins/codemirror/markdown.js"></script>
		<script type="text/javascript" src="/plugins/codemirror/overlay.js"></script>
		<script type="text/javascript" src="/plugins/showdown/showdown.js"></script>
		<script type="text/javascript" src="/plugins/prettify/prettify.min.js"></script>
		<script type="text/javascript" src="/plugins/ngMarkdownEditor/angular-markdown-editor.js"></script>

		
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
						<div class="col-xs-4">
							<a id="logo" href="/"><i class="fa fa-code fa-lg"></i>&nbsp;CodeGarage</a>
						</div>
						<div class="col-xs-8">
							<?php if(Session::has("user")): ?>
								<div class="topbar-menu-item">
									<img src="<?= Session::get("user")["picture"] ?>" height="40px" width="40px" class="img-rounded" alt="avatar" />
									<span><?= Session::get("user")["name"] ?></span>
								</div>
								<a class="topbar-menu-item" href="/snippet/create"><i class="fa fa-plus fa-lg"></i>&nbsp;<span>create</span></a>
								<a class="topbar-menu-item" href="/account/signout/">Signout</a>
							<?php else: ?>
								<a class="topbar-menu-item" href="/account/signin">Sign In</a>
								<a class="topbar-menu-item" href="/aboutsite">Help&nbsp;<i class="fa fa-question"></i></a>
							<?php endif;?>
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

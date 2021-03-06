﻿<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<title>Codegarage</title>
		<meta name="description" content="ソースコードの倉庫のことで、MBEDのC言語からAndroidのJava, ゲームのCPPなどソースコードであれば何でもありです。">
		<meta name="keywords" content="CodeGarage,code,garage,コード,ガレージ,コードガレージ,スニペット,">

		<link rel="icon" type="image/png" href="/img/icon@57x57.png" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/icon@114x114.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/icon@72x72.png">
		<link rel="apple-touch-icon-precomposed" href="/img/icon@57x57.png">

		<base href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/">

		<!-- Open Graph Protocol -->
		<!-- Google Plus && Facebook -->
		<meta property="og:type" content="website" />
		<meta property="og:title" content="CodeGarage" />
		<meta property="og:url" content="http://edisonthk.codegarage.com/" />
		<meta property="og:image" content="http://codegarage.edisonthk.com/img/icon@114x114.png" />
		<meta property="og:description" content="キーボードだけで検索、選択ができるスニペットの共有サイト" />

		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="CodeGarage" />
		<meta name="twitter:description" content="キーボードだけで検索、選択ができるスニペットの共有サイト" />
		<meta name="twitter:image" content="http://codegarage.edisonthk.com/img/icon@114x114.png" />
		<meta name="twitter:url" content="http://edisonthk.codegarage.com/" />


		<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/common.css">
		<link rel="stylesheet" type="text/css" href="/css/anim.css">
		<link rel="stylesheet" type="text/css" href="/css/allmighty-autocomplete.css">


		<!-- jQuery -->
		<!-- <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> -->

		<!-- Angularjs library -->
		<script type="text/javascript" src="/angular-libs/angular.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-route.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-sanitize.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-resource.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-animate.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-cookie.min.js"></script> <!-- https://github.com/ivpusic/angular-cookie -->
		<script type="text/javascript" src="/angular-libs/angular-social.min.js"></script> <!-- https://github.com/esvit/angular-social -->
		<script type="text/javascript" src="/angular-libs/allmighty-autocomplete.js"></script> <!-- https://github.com/JustGoscha/allmighty-autocomplete -->

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

		<!-- Markdown -->
	<!--	<script type="text/javascript" src="/plugins/wmd-editor/Markdown.Converter.js"></script>
		<script type="text/javascript" src="/plugins/wmd-editor/Markdown.Sanitizer.js"></script>
		<script type="text/javascript" src="/plugins/wmd-editor/Markdown.Editor.js"></script> -->

		
		<!-- Angularjs Application -->
		<script type="text/javascript" src="/angular-js/app.js"></script>
		<script type="text/javascript" src="/angular-js/directive.js"></script>
		<script type="text/javascript" src="/angular-js/services.js"></script>
		<script type="text/javascript" src="/angular-js/controllers.js"></script>
		

	</head>
	<body ng-app="codegarageApp">

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-44036434-6', 'auto');
		  ga('send', 'pageview');

		</script>
		
		<!-- static part -->
		<nav ng-class="{'dialog-open': dialogBox.show}">
			
				<div class="container">
					<div class="row">
						<div class="col-xs-4">
							<a id="logo" href="/snippets"><i class="fa fa-code fa-lg"></i>&nbsp;CodeGarage &nbsp;<span class="super-tiny">beta</span></a>
						</div>
						<div class="col-xs-8">
							<div style="float:left;">
								<?php if(Session::has("user")): ?>
									<div class="topbar-menu-item">
										<img src="<?= Session::get("user")["picture"] ?>" height="40px" width="40px" class="img-rounded" alt="avatar" />
										<span><?php //echo Session::get("user")["name"]; ?></span>
									</div>
									<a class="topbar-menu-item" href="/snippet/create"><i class="fa fa-plus"></i>&nbsp;<span>新規</span></a>
									<a class="topbar-menu-item" href="/account/signout/"><i class="fa fa-sign-out"></i>&nbsp;<span>サインアウト</span></a>
								<?php else: ?>
									<a class="topbar-menu-item" href="/account/signin"><i class="fa fa-sign-in"></i>&nbsp;<span>サインイン</span></a>
								<?php endif;?>
								<a class="topbar-menu-item" href="/help"><i class="fa fa-question"></i>&nbsp;ヘルプ</a>
							</div>
							<ul class="ng-social"
								 style="float:right;"
								 ng-social-buttons
							     data-url="location.absUrl()"
							     data-title="'CodeGarage'"
							     data-description="'キーボードのみで検索可能なスニペットデータベース'"
							     data-image="'http://codegarage.edisonthk.com/img/icon@114x114.jpg'">
							    <li class="topbar-menu-item ng-social-twitter right"><i class="fa fa-twitter"></i></li>
							    <li class="topbar-menu-item ng-social-google-plus right"><i class="fa fa-google-plus"></i></li>
							    <li class="topbar-menu-item ng-social-facebook right"><i class="fa fa-facebook"></i></li>
							</ul>
						</div>
					</div>
				</div>
			
		</nav>
		

		<!-- dynamic part -->
		<div class="wrapper" ng-class="{'dialog-open': dialogBox.show}">
			<div class="table-cell" ng-controller="SnippetContollers"><ng-include src="template"></ng-include></div>
		</div>

		<!-- dialog -->
		<dialog-box ng-if="dialogBox.show">
			<div class="dialog-background"></div>
			<div class="dialog">
				<div class="dialog-message">
					<h3 ng-bind-html="dialogBox.title"></h3>
					<p ng-bind-html="dialogBox.message"></p>
				</div>
				<button class="btn {{dialogBox.okButtonClass}}" ng-click="dialogBox.okButtonClickEvent()">{{dialogBox.okButtonText}}</button>
				<button class="btn {{dialogBox.noButtonClass}}" ng-click="dialogBox.noButtonClickEvent()">{{dialogBox.noButtonText}}</button>
			</div>
		</dialog-box>
	</body>
</html>

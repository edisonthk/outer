<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<base href="/" />
		<title>Codegarage</title>
		<meta name="description" content="ソースコードの倉庫のことで、MBEDのC言語からAndroidのJava, ゲームのCPPなどソースコードであれば何でもありです。">
		<meta name="keywords" content="CodeGarage,code,garage,コード,ガレージ,コードガレージ,スニペット,">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no">

		<link rel="icon" type="image/png" href="/img/icon@57x57.png" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/img/icon@114x114.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/icon@72x72.png">
		<link rel="apple-touch-icon-precomposed" href="/img/icon@57x57.png">

		<base href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/">


		
		<!-- Mobile Angular UI -->
		<link rel="stylesheet" href="/css/mobile-angular-ui-hover.min.css" />
	    <link rel="stylesheet" href="/css/mobile-angular-ui-base.min.css" />
	    <link rel="stylesheet" href="/css/mobile-angular-ui-desktop.min.css" />

		<link rel="stylesheet" type="text/css" href="/css/responsive-common.css">
		


		<!-- jQuery -->
		<!-- <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> -->

		<!-- Angularjs library -->
		<script type="text/javascript" src="/angular-libs/angular.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-route.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-sanitize.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-resource.min.js"></script>
		<script type="text/javascript" src="/angular-libs/angular-social.min.js"></script> <!-- https://github.com/esvit/angular-social -->
		<script type="text/javascript" src="/angular-libs/mobile-angular-ui.min.js"></script>
		<script type="text/javascript" src="/angular-libs/mobile-angular-ui.migrate.min.js"></script>

		<!-- Plugins -->
		<link rel="stylesheet" type="text/css" href="/plugins/prettify/prettify.css">
		<link rel="stylesheet" type="text/css" href="/plugins/ngMarkdownEditor/angular-markdown-editor.min.css">

		
		<script type="text/javascript" src="/plugins/codemirror/codemirror.js"></script>
		<script type="text/javascript" src="/plugins/codemirror/gfm.js"></script>
		<script type="text/javascript" src="/plugins/codemirror/markdown.js"></script>
		<script type="text/javascript" src="/plugins/codemirror/overlay.js"></script>
		<script type="text/javascript" src="/plugins/showdown/showdown.js"></script>
		<script type="text/javascript" src="/plugins/prettify/prettify.min.js"></script>
		<script type="text/javascript" src="/plugins/ngMarkdownEditor/angular-markdown-editor.js"></script>

		
		<!-- Angularjs Application -->
		<script type="text/javascript" src="/angular-js/responsive-app.js"></script>
		<script type="text/javascript" src="/angular-js/services.js"></script>
	
	</head>
	<body ng-app="CodegarageApp" ng-controller="SnippetController">

		<!-- Sidebars -->
	 	<div class="sidebar sidebar-left"
	 		ng-include="'/html/responsive/sidebar'" >
	 	</div>
	  	

		<div class="app">
		    <div class="navbar navbar-app navbar-absolute-top">
		    	<div class="navbar-brand navbar-brand-center" ui-yield-to="title"></div>
		        <div class="btn-group pull-left">
		          	<div ui-toggle="uiSidebarLeft" class="btn sidebar-toggle">
		            	<i class="fa fa-code fa-2x"></i>
		          	</div>
		        </div>
		    </div>
		    

		    <!-- App body -->

		    <div class='app-body'>
		      	<div class='app-content'>
		      		<div ng-include="appbody_template"></div>
		      	</div>
		    </div>
		</div><!-- ~ .app -->

		<!-- Modals and Overlays -->
		<div ui-yield-to="modals"></div>

	</body>
</html>

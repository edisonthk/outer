
var codegarageApp = angular.module('codegarageApp',['ngRoute','ngSanitize','ngResource','ngAnimate','ngTagsInput','ngSocial','ui.markdown','snippetContollers','snippetServices']);

codegarageApp.config(['$locationProvider','$routeProvider',
	function($locationProvider,$routeProvider) {
		$routeProvider.
			when('/', {
				redirectTo:'/snippets',
			}).
			when('/snippets/:snippet?', {
				templateUrl: '/html/snippet/',
				controller: 'snippetListCtrl',
				reloadOnSearch: false,
			}).
			when('/snippet/create', {
				templateUrl: '/html/snippet/create',
				controller: 'snippetModifyCtrl',
				reloadOnSearch: false,
			}).
			when('/snippet/:snippet/edit', {
				templateUrl: '/html/snippet/modify',
				controller: 'snippetModifyCtrl',
				reloadOnSearch: false,
			}).
			when('/help', {
				templateUrl: '/html/help',
				controller: 'snippetHelpCtrl',
			});

		$locationProvider.html5Mode(true).hashPrefix('!');
	}]);
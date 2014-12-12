
var codegarageApp = angular.module('codegarageApp',['ngRoute','ngSanitize','ngResource','ngAnimate','ngTagsInput','ngSocial','ui.markdown','SnippetContollers','snippetServices']);

codegarageApp.config(['$locationProvider',
	function($locationProvider) {
		// $routeProvider.
		// 	when('/', {
		// 		redirectTo:'/snippets',
		// 	}).
		// 	when('/snippets/:snippet?', {
		// 		templateUrl: '/html/snippet/',
		// 		controller: 'snippetListCtrl',
		// 	}).
		// 	when('/snippet/create', {
		// 		templateUrl: '/html/snippet/create',
		// 		controller: 'snippetModifyCtrl',
		// 	}).
		// 	when('/snippet/:snippet/edit', {
		// 		templateUrl: '/html/snippet/modify',
		// 		controller: 'snippetModifyCtrl',
		// 	}).
		// 	when('/help', {
		// 		templateUrl: '/html/help',
		// 	});

		$locationProvider.html5Mode(!0).hashPrefix("!");
	}]);
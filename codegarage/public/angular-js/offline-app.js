
var codegarageApp = angular.module('codegarageApp',['ngRoute','ngSanitize','ngResource','ngAnimate','ngTagsInput','ui.markdown','snippetContollers','snippetServices']);

codegarageApp.config(['$locationProvider','$routeProvider',
	function($locationProvider,$routeProvider) {
		$routeProvider.
			when('/', {
				redirectTo:'/snippets',
			}).
			when('/snippets/:snippet?', {
				controller: 'snippetListCtrl',
			});

		$locationProvider.html5Mode(false).hashPrefix('!');
	}]);
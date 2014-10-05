
var codegarageApp = angular.module('codegarageApp',['ngRoute','ngSanitize','ngResource','snippetContollers','snippetServices']);

codegarageApp.config(['$locationProvider','$routeProvider',
	function($locationProvider,$routeProvider) {
		$routeProvider.
			when('/snippets/:snippet?', {
				templateUrl: '/angular-html/index.html',
				controller: 'snippetListCtrl',
				reloadOnSearch: false,
			}).
			otherwise({
				redirectTo: '/snippets',
			});

		$locationProvider.html5Mode(true).hashPrefix('!');
	}]);

function resizedDoneAction(){
    
}
var doit;
window.onresize = function(){
  clearTimeout(doit);
  doit = setTimeout(resizedDoneAction, 300);
};
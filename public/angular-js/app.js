
var codegarageApp = angular.module('codegarageApp',['ngRoute','ngSanitize','ngResource','ngTagsInput','snippetContollers','snippetServices']);

codegarageApp.config(['$locationProvider','$routeProvider',
	function($locationProvider,$routeProvider) {
		$routeProvider.
			when('/snippets/:snippet?', {
				templateUrl: '/angular-html/index.html',
				controller: 'snippetListCtrl',
				reloadOnSearch: false,
			}).
			when('/snippet/create', {
				templateUrl: '/angular-html/modify.html',
				controller: 'snippetModifyCtrl',
				reloadOnSearch: false,
			}).
			when('/snippet/:snippet/edit', {
				templateUrl: '/angular-html/modify.html',
				controller: 'snippetModifyCtrl',
				reloadOnSearch: false,
			}).
			otherwise({
				redirectTo: '/snippets',
			});

		$locationProvider.html5Mode(true).hashPrefix('!');
	}]);

codegarageApp.directive('articleBlock', function() {
    return {
    	scope: true,
    	link: function (scope,element, attrs){
    		
    		console.log(element.html());
    	}
    }
});

function resizedDoneAction(){
    
}
var doit;
window.onresize = function(){
  clearTimeout(doit);
  doit = setTimeout(resizedDoneAction, 300);
};
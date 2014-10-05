var snippetContollers = angular.module('snippetContollers', ['ngSanitize']);

snippetContollers.controller('snippetListCtrl', ['$rootScope','$scope','$window','$http','$routeParams','$location','Snippet',
	function($rootScope, $scope, $window, $http,$routeParams,$location,Snippet){

	$scope.snippet_selected = -1;

	if(typeof $rootScope.snippets != "object"){
		$rootScope.snippets = Snippet.query();	
	}

	var navHeight = document.getElementsByTagName("nav")[0].offsetHeight;
	var menuElement = document.getElementById("snippets");
	menuElement.style.top = navHeight + "px";

	// Handle height and offsetTop of the side menu at left hand side
	angular.element($window).bind('scroll', function () {
		;
		var top  = window.pageYOffset || document.documentElement.scrollTop,
    		left = window.pageXOffset || document.documentElement.scrollLeft;

    	var menuTop = navHeight - top;
    	if(menuTop <= navHeight){
    		
    		if(menuTop > 0){
    			menuElement.style.top = menuTop + "px";	
    			menuElement.style.height = (window.innerHeight-menuTop)+"px";
    		}else{
    			menuElement.style.top = 0;	
    			menuElement.style.height = window.innerHeight + "px";
    		}
    	}
	});


	$scope.article = null;

	var default_subtitle = 	"Snippets list";
	$scope.subtitle = default_subtitle;

	$scope.$watch('$routeUpdate', function() { 
		var path = ($location.path() + '').split('/');
		
		if(typeof path[2] == "string"){
			var snippet_id = parseInt(path[2])
			if(!isNaN(snippet_id)){
				$scope.subtitle = default_subtitle;
				$scope.snippet_selected = snippet_id;
				Snippet.get({snippetId: snippet_id}, function(article) {
					$scope.article = article;
				});
			}
		}
	});
	

	$scope.searchEvent = function(){

		if(($scope.search_keywords+'').length > 0 && typeof $scope.search_keywords != "undefined"){
			$scope.subtitle = "Searching for \""+$scope.search_keywords+"\"";
		}else{
			$scope.subtitle = default_subtitle;
		}
		

		if(event.keyCode == 13){
			if(($scope.search_keywords+'').length == 0){
				$http.get('/json/snippet').success(function(data) {
					$rootScope.snippets = data;
				});

			}else{
				$http.get('/json/search?kw='+encodeURIComponent($scope.search_keywords)).success(function(data) {
					$rootScope.snippets = data;
				});

			}
		}
		// 
	}

}]);


snippetContollers.controller('snippetModifyCtrl', ['$rootScope','$scope','$http','$routeParams','$location','Snippet',
	function($rootScope, $scope, $http,$routeParams,$location,Snippet){

		$scope.tags = [
			{text: "rails"},
			{text: "aa"}
		];

		$scope.loadTags = function(query) {

			return $http.get('/json/tag/?q='+query);
		};

		$scope.submit = function()
		{
			console.log("submit");
		}


		
		if(typeof $routeParams.snippet === "string"){

			Snippet.get({snippetId: $routeParams.snippet}, function(article)
			{
				$scope.article = article;
			})

		}
	
}]);
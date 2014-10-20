var snippetContollers = angular.module('snippetContollers', ['ngSanitize']);

snippetContollers.controller('snippetListCtrl', ['$route','$rootScope','$scope','$window','$http','$routeParams','$location','Snippet',
	function($route, $rootScope, $scope, $window, $http,$routeParams,$location,Snippet){

	$scope.snippet_selected = -1;

	if(typeof $rootScope.snippets != "object"){
		$rootScope.snippets = Snippet.query();	
	}

	$scope.article = null;

	var default_subtitle = 	"Snippets list";
	$scope.subtitle = default_subtitle;

	

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

			}else if($scope.search_keywords.match(/^[0-9]+$/g)){
				// only number
				if(typeof $rootScope.snippets !== "undefined"){
					var temp_snippet_selected = $rootScope.snippets[parseInt($scope.search_keywords)-1];

					$location.path("/snippets/"+temp_snippet_selected.id);
				}
			}else{
				$http.get('/json/search?kw='+encodeURIComponent($scope.search_keywords)).success(function(data) {
					$rootScope.snippets = data;
					$scope.search_keywords = "";
				});

			}
		}
		// 
	}

	
	$scope.locationUpdate = function(){

		var path = ($location.path() + '').split('/');
		
		if(typeof path[2] == "string"){
			var snippet_id = parseInt(path[2])
			if(!isNaN(snippet_id)){
				$scope.subtitle = default_subtitle;
				$scope.snippet_selected = snippet_id;
				Snippet.get({snippetId: snippet_id}, function(article) {
					article.content = filterContent(article.content);
					$scope.article = article;
				});
			}
		}
	}

	$scope.locationUpdate();

	$scope.loading = false;
	$scope.$on('$routeChangeStart', function(next, current) { 
	   $scope.article = null;
	   $scope.loading = true;

	}); 

	// 
	var lastRoute = $route.current;
    $scope.$on('$locationChangeSuccess', function(event) {

    	// event when location Changed success
    	$scope.locationUpdate();
    	$scope.loading = false;
    	

		// To prevent controller reloading
		if(/^\/snippet$/.test($location.path()) && 
			/^\/snippet\/[0-9]+$/.test($location.path()) ){
			
			$route.current = lastRoute;
		}
		
    });

}]);


snippetContollers.controller('snippetModifyCtrl', ['$rootScope','$scope','$http','$routeParams','$location','Snippet',
	function($rootScope, $scope, $http,$routeParams,$location,Snippet){

		$scope.tags = [
			{text: "rails"},
			
		];

		$scope.editorOptions = {

		}

		$scope.loadTags = function(query) {

			return $http.get('/json/tag/?q='+query);
		};

		$scope.submit = function()
		{
			var tempTags = $scope.tags;
			var newTags = [];
			for (var i = 0; i < tempTags.length; i++) {
				newTags.push(tempTags[i].text);
			};
			postData = {
				title: $scope.article.title, 
				content: $scope.article.content,
				tags: newTags
			};
			if(typeof $routeParams.snippet === "string"){
				// update
				Snippet.update({snippetId: $routeParams.snippet}, postData, function(){
					// success
				}, function(e){
					// error
					console.log(e);
				});
			}else{
				// create
				Snippet.create( {}, postData, function(){
					// success
				}, function(e){
					// error
					console.log(e);
				});
			}
			
		}
		
		if(typeof $routeParams.snippet === "string"){

			Snippet.get({snippetId: $routeParams.snippet}, function(article)
			{
				article.content = filterContent(article.content);
				
				$scope.article = article;
			})

		}
	
}]);

function filterContent(content)
{
	content = content.replace(/\\n/g,"\n");	
	return content;
}
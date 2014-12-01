var snippetContollers = angular.module('snippetContollers', ['ngSanitize']);


snippetContollers.controller('snippetListCtrl', ['$route','$rootScope','$scope','$window','$http','$routeParams','$location','Snippet',
	function($route, $rootScope, $scope, $window, $http,$routeParams,$location,Snippet){

	$scope.snippet_selected = -1;

	if(typeof $rootScope.snippets != "object"){
		$rootScope.snippets = Snippet.query();	
	}

	$scope.article = null;

	var default_subtitle = 	"最新のスニペット一覧";
	$scope.subtitle = default_subtitle;
	// 検索イベント
	$scope.searchEvent = function(){

		// BEGIN: subtitleの表示文字を構成
		if(($scope.search_keywords+'').length > 0 && typeof $scope.search_keywords != "undefined"){
			var tags = $scope.search_keywords.match(/\[(.*?)\]/g);
			if(tags == null){
				$scope.subtitle = "\""+$scope.search_keywords+"\"　を検索";	
			}else{

				
				// 検索するタグが重複しています。
				var duplicated_flag = false;
				for(var i=0;i<tags.length && !duplicated_flag;i++){
					for(var j=0;j<tags.length && !duplicated_flag;j++){
						if(i != j){
							if(tags[i] == tags[j]){
								duplicated_flag = true;
							}
						}
					}
				}
				if(duplicated_flag){
					$scope.subtitle = "検索するタグが重複しています";
				}else{
					// 検索するタグ
					var temp = "";
					for(var i=0;i<tags.length;i++){
						temp += tags[i].replace(/[\]\[]/g,"") + ",";
					}
					temp = temp.substring(0,temp.length-1);
					console.log(temp);
					temp += "タグ";

					// 検索する言葉
					var words = $scope.search_keywords.replace(/\[(.*?)\]/g,"");
					if(words.length <= 0){
						// 検索する言葉がありません
						temp += "を検索";
					}else{
						temp += "と\""+words+"\"を検索";
					}

					$scope.subtitle = temp;

				}
			}
		}else{
			$scope.subtitle = default_subtitle;
		}
		// END: subtitleの表示文字を構成
		

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
					$scope.last_searched_keywords = $scope.search_keywords;
					
				});

			}
		}
		// 
	}

	$scope.deleteButtonClicked = function(article_clicked) {

		$rootScope.dialogBox = {
			show: true,
			okButtonText: "削除",
			noButtonText: "キャンセル",
			title: "<i class='fa fa-trash'></i>&nbsp;削除",
			message: "\""+article_clicked.title+"\"を削除しますか？この動作は戻せないのでご注意ください。",
			okButtonClass: "btn-danger",
			noButtonClass: "btn-primary",
			okButtonClickEvent: function() {
				Snippet.delete({snippetId: article_clicked.id}, {} , function(){
					$rootScope.snippets = Snippet.query();	
					$location.path("/snippets/").replace();
					$rootScope.dialogBox.show = false;
				}, function(e){
					console.log(e);
					$rootScope.dialogBox.title = "<span class='error-message'><i class='fa fa-close error-message'></i>&nbsp;削除失敗</span>"
					$rootScope.dialogBox.message = "\""+article_clicked.title+"\"が削除できません。理由は"+e.data.error;
				});
			},
			noButtonClickEvent: function() {
				$rootScope.dialogBox.show = false;
			},
		}
	}

	
	$scope.locationUpdate = function(){
		

		var path = ($location.path() + '').split('/');
		if(typeof path[1] == "string" && path[1] == "account"){
			$window.location.href = $location.path();
		}
		
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

    $scope.$on('$viewContentLoaded', function(event) {
	    $window.ga('send', 'pageview', { page: $location.path() });
	});

}]);


snippetContollers.controller('snippetModifyCtrl', ['$rootScope','$scope','$window','$http','$routeParams','$location','Snippet',
	function($rootScope, $scope, $window, $http,$routeParams,$location,Snippet){

		// if(typeof $scope.article === "undefined" || typeof $scope.article.title === "undefined" || typeof $scope.article.content === "undefined" ){
		// 	$scope.article = {title: "", content: "", tags: []};
		// }

		$scope.$on('$viewContentLoaded', function(event) {
		    $window.ga('send', 'pageview', { page: $location.path() });
		});

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
				// snippet update
				Snippet.update({snippetId: $routeParams.snippet}, postData, function(){
					// success
					// スニペットの更新が成功
					$scope.errorMessage = false;
					$scope.success = true;
					$rootScope.snippets = Snippet.query();	

				}, function(e){
					// スニペットの更新が失敗
					errorMessage = [];
					for(var key in e.data.error){
						errorMessage.push(e.data.error[key]);
					}
					$scope.errorMessage = errorMessage;
					$scope.success = false;
				});
			}else{
				// snippet create
				Snippet.create( {}, postData, function(result){
					// success
					// スニペットの新規が成功
					$scope.success = true;
					$scope.errorMessage = false;
					$rootScope.snippets = Snippet.query();	
					$location.path("/snippet/"+result.id+"/edit").replace();

				}, function(e){
					// error
					// スニペットの新規が失敗
					errorMessage = [];

					if(typeof e.data.error === "object"){
						for(var key in e.data.error){
							if(e.data.error[key] instanceof Array){
								errorMessage.push(e.data.error[key][0]);	
							}else{
								errorMessage.push(e.data.error[key]);	
							}
						}
					}else{
						errorMessage.push(e.data.error);
					}
					
					$scope.errorMessage = errorMessage;
					$scope.success = false;
				});
			}
			
		}
		
		if(typeof $routeParams.snippet === "string"){

			Snippet.get({snippetId: $routeParams.snippet}, function(article)
			{
				article.content = filterContent(article.content);
				
				$scope.article = article;

				var tags = [];
				for(var i =0;i<article.tags.length;i++){
					tags.push({"text":article.tags[i].name});
				}
				$scope.tags = tags;
			})

		}


	
}]);

function filterContent(content)
{
	// content = content.replace(/\\n/g,"\n");	
	return content;
}
// controller
angular.module('CodegarageApp',['ngRoute','mobile-angular-ui','mobile-angular-ui.migrate','ngSanitize','ngResource','ngSocial','ui.markdown','SnippetController','snippetServices'])
.config(['$locationProvider',function(a){
	a.html5Mode(!0).hashPrefix("!");
}]);

// controller
angular.module('SnippetController', ['ngSanitize'])
.controller('SnippetController',['$scope','$location','$http','$anchorScroll','$window','Snippet',function($scope,$location,$http,$anchorScroll,$window,Snippet){
	$scope.snippets = Snippet.query();
	$scope.textbox = {
		keywords: "",
	}
	
	$scope.submit_keywords_event = function() {
		if(($scope.textbox.keywords+'').length == 0){
			$scope.snippets = Snippet.query();

		}else if($scope.textbox.keywords.match(/^[0-9]+$/g)){
			// 検索ボックスに数字のみ入力されているので、
			// articleを選択
			if(typeof $scope.snippets !== "undefined"){
				var temp_snippet_selected = $scope.snippets[parseInt($scope.textbox.keywords)-1];
				$scope.moveToSelectedSnippet(temp_snippet_selected.id);
				$location.path("/snippets/"+temp_snippet_selected.id);
				$scope.textbox.keywords = "";
			}
		}else{

			var temp = $scope.textbox.keywords.match(/[0-9]+$/);
			if(null !== temp){
				// 検索ボックスに最後の文字が数字なので、
				// articleを選択
				var snippet_selected_id = $scope.snippets[parseInt(temp[0])-1];
				$scope.moveToSelectedSnippet(snippet_selected_id.id);
				$location.path("/snippets/"+snippet_selected_id.id);	
				$scope.textbox.keywords = "";
			}else{
				// 入力したキーワードを検索
				$http.get('/json/search?kw='+encodeURIComponent($scope.textbox.keywords)).success(function(data) {
					$scope.snippets = data;
					$scope.last_searched_keywords = $scope.textbox.keywords;
					// $scope.textbox.keywords = "";
				});
			}
		}
	}

	// According to HTML5 spec, angular provide a way to move to specific element by id and hash
	// More detail on the way of moving element
	// 
	// https://docs.angularjs.org/api/ng/service/$anchorScroll
	//
	$scope.moveToSelectedSnippet = function(snippet_id) {
		var newHash = 'snippet-item-' + snippet_id;
	    if ($location.hash() !== newHash) {
	        // set the $location.hash to `newHash` and
	        // $anchorScroll will automatically scroll to it
	        $location.hash(newHash);
	    } else {
	        // call $anchorScroll() explicitly,
	        // since $location.hash hasn't changed
	        $anchorScroll();
	    }
	}

	// GAの動作
	$scope.$on("$includeContentLoaded", function () {
		$window.ga('send', 'pageview', { page: $location.path() });
	})

	// ページ更新
	$scope.$watch(function () {
		return $location.path();
	}, function (t) {
		var path = t.split('/');
		if(typeof path[1] == "string" && path[1] == "account"){
			
		}else if(path[1] === "snippets"){
			// URL: /snippets/*
			

			if(!isNaN(snippet_id = parseInt(path[2]))){
				// URL: /snippets/20
				$scope.appbody_template = "/html/responsive/snippet";
				$scope.snippet_selected = snippet_id;
				Snippet.get({snippetId: snippet_id}, function(article) {
					article.content = filterContent(article.content);
					$scope.article = article;
				});	
			}else{
				// URL: /snippets/
				$scope.appbody_template = "/html/responsive/about";
				$scope.snippets = Snippet.query();
			}	
			

		}else if(path[1] === "snippet"){

			// URL: /snippet/*

			if(path[2] === "create"){
				// URL: /snippet/create/
				$scope.template = "/html/snippet/create";

			}else if(path[2].match(/^[0-9]+/) && path[3] === "edit"){
				$scope.template = "/html/snippet/modify";
			}
		}else if(path[1] === "help") {
			// URL: /help
			$scope.template = "/html/help";
		}
	});
}]);

function filterContent(content)
{
	// content = content.replace(/\\n/g,"\n");	
	return content;
}
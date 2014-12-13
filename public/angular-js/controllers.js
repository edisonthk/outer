var snippetContollers = angular.module('SnippetContollers', ['ngSanitize']);


snippetContollers.controller('SnippetContollers', ['$anchorScroll','$route','$rootScope','$scope','$window','$http','$routeParams','$location','Snippet',
	function($anchorScroll, $route, $rootScope, $scope, $window, $http,$routeParams,$location,Snippet){

	$scope.textbox = {
		keywords: "",
		tags: [],
	}
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
		if(($scope.textbox.keywords+'').length > 0 && typeof $scope.textbox.keywords != "undefined"){
			var tags = $scope.textbox.keywords.match(/\[(.*?)\]/g);
			if(tags == null){
				$scope.subtitle = "\""+$scope.textbox.keywords+"\"　を検索";	
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
					var words = $scope.textbox.keywords.replace(/\[(.*?)\]/g,"");
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
			console.log($scope.textbox);
			if(($scope.textbox.keywords+'').length == 0){
				$http.get('/json/snippet').success(function(data) {
					$rootScope.snippets = data;
				});

			}else if($scope.textbox.keywords.match(/^[0-9]+$/g)){
				// 検索ボックスに数字のみ入力されているので、
				// articleを選択
				if(typeof $rootScope.snippets !== "undefined"){
					var temp_snippet_selected = $rootScope.snippets[parseInt($scope.textbox.keywords)-1];
					$scope.moveToSelectedSnippet(temp_snippet_selected.id);
					$location.path("/snippets/"+temp_snippet_selected.id);
				}
			}else{

				var temp = $scope.textbox.keywords.match(/[0-9]+$/);
				if(null !== temp){
					// 検索ボックスに最後の文字が数字なので、
					// articleを選択
					var snippet_selected_id = $rootScope.snippets[parseInt(temp[0])-1];
					$scope.moveToSelectedSnippet(snippet_selected_id.id);
					$location.path("/snippets/"+snippet_selected_id.id);	
				}else{
					// 入力したキーワードを検索
					$http.get('/json/search?kw='+encodeURIComponent($scope.textbox.keywords)).success(function(data) {
						$rootScope.snippets = data;
						$scope.last_searched_keywords = $scope.textbox.keywords;
						// $scope.textbox.keywords = "";
					});
				}
			}
		}
		// 
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
					$scope.article = null;
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

	$scope.homeButtonClickedEvent = function() {
		$rootScope.snippets = Snippet.query();
		$scope.article = null;
	}

	$scope.$on("$includeContentLoaded", function () {
		$window.ga('send', 'pageview', { page: $location.path() });
	})

	// location update
	$scope.$watch(function () {
		return $location.path();
	}, function (t) {

		var path = t.split('/');
		if(typeof path[1] == "string" && path[1] == "account"){
			$window.location = t;
		}else if(path.length > 1 && path[1] === "snippets"){
			// URL: /snippets/*
			$scope.template = "/html/snippet/";

			console.log($scope.article);

			if(!isNaN(snippet_id = parseInt(path[2]))){
				// URL: /snippets/20
				$scope.subtitle = default_subtitle;
				$scope.snippet_selected = snippet_id;
				$scope.textbox.keywords = "";
				$scope._current_pre_ele = 0;
				Snippet.get({snippetId: snippet_id}, function(article) {
					article.content = filterContent(article.content);
					$scope.article = article;
				});	
			}else{
				// URL: /snippets/
				$rootScope.snippets = Snippet.query();
			}	
			
		}else if(path[1] === "snippet"){

			// URL: /snippet/*

			if(path[2] === "create"){
				// URL: /snippet/create/
				$scope.template = "/html/snippet/create";

				// empty article variable
				$scope.article = {
					title: "",
					content: "",
					tags: [],
				};

			}else if(path[2].match(/^[0-9]+/) && path[3] === "edit"){
				$scope.template = "/html/snippet/modify";
			}
		}else if(path[1] === "help") {
			// URL: /help
			$scope.template = "/html/help";
		}
	})
}]);


snippetContollers.controller('SnippetModifyCtrl', ['$rootScope','$scope','$window','$http','$location','Snippet',
	function($rootScope, $scope, $window, $http,$location,Snippet){

		// if(typeof $scope.article === "undefined" || typeof $scope.article.title === "undefined" || typeof $scope.article.content === "undefined" ){
		// 	$scope.article = {title: "", content: "", tags: []};
		// }

		$scope.$on('$viewContentLoaded', function(event) {
		    $window.ga('send', 'pageview', { page: $location.path() });
		});

		// 
		var snippetId = NaN;
		var _temp = $location.path().split("/");
		if(_temp[2] === "create"){
			// URL: /snippet/create
		}else if(_temp[2].match(/^[0-9]+$/)){
			snippetId = parseInt(_temp[2]);
			if(!isNaN(snippetId)){
				Snippet.get({snippetId: snippetId}, function(article)
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

			if(!isNaN(snippetId)){
				// snippet update
				Snippet.update({snippetId: snippetId}, postData, function(){
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
}]);

function filterContent(content)
{
	// content = content.replace(/\\n/g,"\n");	
	return content;
}
var snippetContollers = angular.module('SnippetContollers', ['ngSanitize']);


snippetContollers.controller('SnippetContollers', ['$anchorScroll','$route','$rootScope','$scope','$window','$http','ipCookie','$routeParams','$location','$timeout','$cacheFactory','Snippet',
	function($anchorScroll, $route, $rootScope, $scope, $window, $http,ipCookie, $routeParams,$location,$timeout,$cacheFactory, Snippet){

	$scope.cookie_options = {
		expires: 7,
		expirationUnit: 'days',
	};
	

	var candidate = [];
	if(ipCookie('candidate')){
		candidate = ipCookie('candidate');
	}

	$scope.textbox = {
		candidate: candidate,
		focus: false,
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
	$scope.searchEvent = function() {
		// 検索テキストボックスを非表示
		$scope.textbox.focus = false;

		//
		if(($scope.textbox.keywords+'').length == 0){
			$http.get('/json/snippet').success(function(data) {
				$rootScope.snippets = data;
			});

		}else if($scope.textbox.keywords.match(/^[0-9]+$/g)){
			// 検索ボックスに数字のみ入力されているので、
			// articleを選択
			if(typeof $rootScope.snippets !== "undefined"){
				$scope.moveToSelectedSnippet($scope.textbox.keywords);
			}
		}else{

			var temp = $scope.textbox.keywords.match(/[0-9]+$/);
			if(null !== temp){
				// 検索ボックスに最後の文字が数字なので、
				// articleを選択
				
				$scope.moveToSelectedSnippet(temp[0]);
			}else{
				// checking if duplicated 
				var push_flag = ($scope.textbox.keywords.length > 0);
				console.log($scope.textbox.keywords );
				
				for(var i = 0; i < candidate.length && !push_flag;i++){

					if(candidate[i] == $scope.textbox.keywords){
						console.log("bbbbbbb");
						push_flag = false;
						break;
					}
				}

				if(push_flag){
					// append into candidate
					// if candidate size is bigger then 5, shift to upper and remove the oldest one.
					if(candidate.length >= 5){
						for(var i=1;i < candidate.length; i++){
							candidate[i - 1] = candidate[i];
						}
						candidate[0] = $scope.textbox.keywords;
						console.log(candidate);
					}else{
						// else, append keywords into candidate
						candidate.push($scope.textbox.keywords);
						// // reverse
						// for (var i = candidate.length - 1; i > 0; i--) {
						// 	var temp = candidate[i];
						// 	candidate[i] = candidate[i - 1];
						// 	candidate[i - 1] = temp;
						// };
					}

					$scope.textbox.candidate = candidate;
					ipCookie('candidate',JSON.stringify(candidate), $scope.cookie_options);
				}


				// 入力したキーワードを検索
				$http.get('/json/search?kw='+encodeURIComponent($scope.textbox.keywords)).success(function(data) {
					$rootScope.snippets = data;
					$scope.last_searched_keywords = $scope.textbox.keywords;
					// $scope.textbox.keywords = "";
				});
			}
		}

		console.log("fdsf");

		$scope.textbox.keywords = "";
	}

	$scope.onKeyUpEvent = function(kw){
		if(kw.match(/^[0-9]+$/g)){
			$scope.moveToSelectedSnippet(kw);
		}
	}

	// キーアップするたびにイベントが発生します
	$scope.onTypeEvent = function(kw){
		
		

		// BEGIN: subtitleの表示文字を構成
		// if(($scope.textbox.keywords+'').length > 0 && typeof $scope.textbox.keywords != "undefined"){
		// 	var tags = $scope.textbox.keywords.match(/\[(.*?)\]/g);
		// 	if(tags == null){
		// 		$scope.subtitle = "\""+$scope.textbox.keywords+"\"　を検索";	
		// 	}else{

				
		// 		// 検索するタグが重複しています。
		// 		var duplicated_flag = false;
		// 		for(var i=0;i<tags.length && !duplicated_flag;i++){
		// 			for(var j=0;j<tags.length && !duplicated_flag;j++){
		// 				if(i != j){
		// 					if(tags[i] == tags[j]){
		// 						duplicated_flag = true;
		// 					}
		// 				}
		// 			}
		// 		}
		// 		if(duplicated_flag){
		// 			$scope.subtitle = "検索するタグが重複しています";
		// 		}else{
		// 			// 検索するタグ
		// 			var temp = "";
		// 			for(var i=0;i<tags.length;i++){
		// 				temp += tags[i].replace(/[\]\[]/g,"") + ",";
		// 			}
		// 			temp = temp.substring(0,temp.length-1);
		// 			console.log(temp);
		// 			temp += "タグ";

		// 			// 検索する言葉
		// 			var words = $scope.textbox.keywords.replace(/\[(.*?)\]/g,"");
		// 			if(words.length <= 0){
		// 				// 検索する言葉がありません
		// 				temp += "を検索";
		// 			}else{
		// 				temp += "と\""+words+"\"を検索";
		// 			}

		// 			$scope.subtitle = temp;

		// 		}
		// 	}
		// }else{
		// 	$scope.subtitle = default_subtitle;
		// }
		// // END: subtitleの表示文字を構成
		
	}

	// According to HTML5 spec, angular provide a way to move to specific element by id and hash
	// More detail on the way of moving element
	// 
	// https://docs.angularjs.org/api/ng/service/$anchorScroll
	//
	$scope.moveToSelectedSnippet = function(selected_id) {

		var selected_id = parseInt(selected_id);
		if(isNaN(selected_id)){
			return ;
		}

		try{
			var snippet_id = ($rootScope.snippets[selected_id-1]).id;
			var hash_snippet_id = 1;
			if(selected_id - 4 >= 1){
				hash_snippet_id = $rootScope.snippets[selected_id - 4].id;
			}
			

			var newHash = 'snippet-item-' + (hash_snippet_id);
		    if ($location.hash() !== newHash) {
		        // set the $location.hash to `newHash` and
		        // $anchorScroll will automatically scroll to it
		        $location.hash(newHash);
		    } else {
		        // call $anchorScroll() explicitly,
		        // since $location.hash hasn't changed
		        $anchorScroll();
		    }

		    $location.path("/snippets/"+snippet_id).replace();
		    clearTimeout($scope.timeout_id);
		    $scope.timeout_id = setTimeout(function(){
		    	$scope.$apply();
		    },700);

		}catch(err){}
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

			if(!isNaN(snippet_id = parseInt(path[2]))){
				// URL: /snippets/20
				$scope.subtitle = default_subtitle;
				$scope.snippet_selected = snippet_id;
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
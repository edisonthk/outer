// controller
angular.module('CodegarageApp',['ngRoute','mobile-angular-ui','mobile-angular-ui.migrate','ngSanitize','ngResource','ngSocial','ui.markdown','SnippetController','snippetServices'])
.config(['$locationProvider',function(a){
	a.html5Mode(!0).hashPrefix("!");
}]);

// controller
angular.module('SnippetController', ['ngSanitize'])
.controller('SnippetController',['$scope','$location','Snippet',function(a,b,Snippet){
	a.snippets = Snippet.query();
	a.title = "fdsfds";

	a.$watch(function () {
		return b.path();
	}, function (t) {
		var path = t.split('/');
		if(typeof path[1] == "string" && path[1] == "account"){
			
		}else if(path.length > 1 && path[1] === "snippets"){
			// URL: /snippets/*
			a.appbody_template = "/html/responsive/snippet";			

			console.log(a.article);

			if(!isNaN(snippet_id = parseInt(path[2]))){
				// URL: /snippets/20
				a.snippet_selected = snippet_id;
				Snippet.get({snippetId: snippet_id}, function(article) {
					article.content = filterContent(article.content);
					a.article = article;
				});	
			}else{
				// URL: /snippets/
				a.snippets = Snippet.query();
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
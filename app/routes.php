<?php
Route::controller('/account','AccountController');
Route::controller('/json/tag','TagController');
Route::resource('/json/snippet','SnippetController');

Route::get('/json/search','SnippetController@search');

Route::controller('/html','HtmlController');



Route::get("/help",'HtmlController@angularJS');
Route::get("/snippet/create",'HtmlController@angularJS');
Route::get("/snippet/{snippet}/edit",'HtmlController@angularJS');
Route::get("/snippets/{snippet?}",'HtmlController@angularJS');
Route::get("/",'HtmlController@landingPage');

// Route::get('/',function(){
// 	echo "<html><head><link rel='stylesheet' href='/css/common.css'></head><body>";
// 	foreach (Snippet::all() as $key => $value) {
// 		echo $value->content."<br/>";
// 	}
// 	echo "</body></html>";
// });

Route::get("/test",function(){
	phpinfo();
});
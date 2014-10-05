<?php
Route::controller('/account','AccountController');
Route::controller('/json/tag','TagController');
Route::resource('/json/snippet','SnippetController');

Route::get('/json/search','SnippetController@search');

Route::get("/snippets/{snippet?}",function(){
	return View::make("base");
});
Route::get("/",function(){
	return View::make("base");
});

// Route::get('/',function(){
// 	echo "<html><head><link rel='stylesheet' href='/css/common.css'></head><body>";
// 	foreach (Snippet::all() as $key => $value) {
// 		echo $value->content."<br/>";
// 	}
// 	echo "</body></html>";
// });

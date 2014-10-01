<?php

Route::controller('/account','AccountController');
Route::resource('/snippet','SnippetController');
Route::get('/snippet/search','SnippetController@search');

Route::get("/","SnippetController@index");

// Route::get('/',function(){
// 	echo "<html><head><link rel='stylesheet' href='/css/common.css'></head><body>";
// 	foreach (Snippet::all() as $key => $value) {
// 		echo $value->content."<br/>";
// 	}
// 	echo "</body></html>";
// });

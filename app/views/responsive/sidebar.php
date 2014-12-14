<div class="scrollable">
  <h1 class="scrollable-header app-name"><i class="fa fa-code"></i>CodeGarage</h1>  
  <div class="search-form">
  	<form ng-submit="submit_keywords_event()">
  		<div class="form-group">
	  		<input class="form-control" type="text" ng-model="textbox.keywords" name="kw" placeholder="検索" />
	  	</div>
	</form>
  </div>
  <div class="scrollable-content">
    <div class="list-group" ui-turn-off='uiSidebarLeft'>
    	<a ng-repeat="snippet in snippets" class="list-group-item" href="/snippets/{{snippet.id}}">{{snippet.title}}</a>
    </div>
  </div>
</div>
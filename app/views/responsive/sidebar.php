<div class="scrollable">
  <h1 class="scrollable-header app-name"><i class="fa fa-code"></i>CodeGarage</h1>  
  <div class="scrollable-content">
    <div class="list-group" ui-turn-off='uiSidebarLeft'>
    	<a ng-repeat="snippet in snippets" class="list-group-item" href="/snippets/{{snippet.id}}">{{snippet.title}}</a>
    </div>
  </div>
</div>
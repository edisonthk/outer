<div snippetContollers id="editor-snippet" class="container">
	<div class="row">
		<div class="col-xs-6">
			<form>
				<div class="form-group">
					<input type="text" class="form-control" ng-model="article.title" />
				</div>
				<div class="form-group">
					<textarea class="form-control" ng-model="article.content"></textarea>
				</div>
				
				<tags-input ng-model="tags">
					<auto-complete source="loadTags($query)"></auto-complete>
				</tags-input>
				
				<div class="form-group">
					<button ng-click="submit()">Submit</button>
				</div>
			</form>
		</div>

		<div id="article" class="col-xs-6">
			<h1 class="artitle-title"><i class="fa pull-left fa-quote-left"></i>{{article.title}}<i class="fa pull-right fa-quote-right"></i></h1>
			<div class="gray-bg article-block">
				<div class="article-content" article-block ng-bind-markdown="article.content"></div>
			</div>
		</div>
	</div>
</div>

<div ng-if="article != null"  class="container">
	<!-- Layout when article is selected -->
	<div class="row">
		
	</div>
</div>


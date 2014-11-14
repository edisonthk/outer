
<div snippetContollers side-menu-scrolling-event id="snippets" class="container" >
	<div class="row">
		<div class="col-xs-4 gray-bg">
			<div class="search-form form-group">
				<div class="snippet-padding">
					<input id="searchText" type="text" 
						class="form-control" 
						ng-model="search_keywords" 
						ng-keyup="searchEvent()" 
						placeholder="Searching snippets ....">
				</div>
			</div>
			<div class="snippet-list-subtitle">
				<p class="snippet-padding">{{subtitle}}</p>
			</div>
			<div class="snippet-list">
				<div id="snippet-item-{{snippet.id}}" ng-repeat="snippet in snippets" class="single-snippet" ng-class="{active: (snippet.id==snippet_selected)}">

					<a href="/snippets/{{snippet.id}}">
						<div class="snippet-padding">
							<div class="title">
								<p>{{$index + 1}}&nbsp;{{snippet.title}}</p>
							</div>
							<div class="meta clearfix">
								<div class="tags-group">
									<span ng-repeat="tag in snippet.tags" class="tag">{{tag.name}}</span>
								</div>
								<div class="datetime">Updated at {{snippet.updated_at}} </div>
							</div>	
						</div>
					</a>		
				</div>
			</div>
		</div>
	</div>
</div>


<div ng-if="article == null &amp;&amp; !loading" id="empty-board">
	<!-- Layout when article is not selected -->
	<div class="container">
		<div class="row">
			<div class="col-xs-7 col-xs-offset-5">
				<h1>Choose the article</h1>
			</div>
		</div>
	</div>
</div>
<div ng-if="article != null &amp;&amp; !loading" id="article" class="container">
	<!-- Layout when article is selected -->
	<div class="row">
		<div class="col-xs-8 col-xs-offset-4">
			<h1 class="artitle-title"><i class="fa pull-left fa-quote-left"></i>{{article.title}}<i class="fa pull-right fa-quote-right"></i></h1>

			

			<div class="gray-bg article-block" >
				<ul class="snippet-tools clearfix">
					<li ng-if="article.editable">
						<a href="/snippet/{{article.id}}/edit"><i class="fa fa-edit fa-lg"></i>&nbsp;<span>modify</span></a>
					</li>
					<li ng-if="article.editable">
						<!-- href="/snippet/{{article.id}}/delete" -->
						<a ng-click="deleteButtonClicked(article);"><i class="fa fa-trash fa-lg"></i>&nbsp;<span>delete</span></a>
					</li>
					<li ng-if="!article.editable">
						<a><i class="fa fa-edit fa-lg"></i>&nbsp;<span>Created by {{article.creator_name}}</span></a>
					</li>
				</ul>
				<div class="article-tag">
					<span ng-repeat="tag in article.tags" class="tag">{{tag.name}}</span>
				</div>
				<div class="article-content" article-block ng-bind-markdown="article.content"></div>
			</div>
		</div>
	</div>
</div>



<div ui-content-for="title">
  <span>{{article.title}}</span>
</div>

<div class="scrollable">
  	<div class="scrollable-content">
  		<div class="section section-break">
			<div class="gray-bg article-block" >
				<div class="snippet-tools clearfix">
					<i class="fa fa-edit fa-lg"></i>&nbsp;<span>Created by {{article.creator_name}}</span>
				</div>
				
				<div class="article-tag">
					<span ng-repeat="tag in article.tags" class="tag">{{tag.name}}</span>
				</div>

				<div class="article-content" article-block ng-bind-markdown="article.content"></div>
			</div>
  		</div>
	</div>
</div>
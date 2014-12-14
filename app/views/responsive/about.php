<div ui-content-for="title">
  <span></span>
</div>

<div class="full">
	<div class="v-middle">
		<div class="h-middle">
			<h1>ようこそ！CodeGarageへ</h1>
		</div>
	</div>
</div>

<div ui-content-for="modals">
  <div class="modal" ui-if='modal1' ui-state='modal1'>
    <div class="modal-backdrop in"></div>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" 
                  ui-turn-off="modal1">&times;</button>
          <h4 class="modal-title">共有</h4>
        </div>
        <div class="modal-body">
        	<p>CodeGarageを共有しましょう</p>
          <ul class="ng-social"
			 ng-social-buttons
		     data-url="location.absUrl()"
		     data-title="'CodeGarage'"
		     data-description="'キーボードのみで検索可能なスニペットデータベース'"
		     data-image="'http://codegarage.edisonthk.com/img/icon@114x114.jpg'">
		    <li class="topbar-menu-item ng-social-twitter right"><img src="/img/twitter.png"></li>
		    <li class="topbar-menu-item ng-social-google-plus right"><img src="/img/google_plus.png"></li>
		    <li class="topbar-menu-item ng-social-facebook right"><img src="/img/facebook.png"></li>
		</ul>
        </div>
        <div class="modal-footer">
          <button ui-turn-off="modal1" class="btn btn-default">閉じる</button>
        </div>
      </div>
    </div>
  </div>
</div>
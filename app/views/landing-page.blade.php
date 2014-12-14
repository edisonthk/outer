<!DOCTYPE html>
<html lang="ja">
  <head>
	<meta charset="utf-8">
	<title>Twitter Bootstrap</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
	<!-- CSS の組み込み -->
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/css/landing-page.css">

	<script type="text/javascript" src="/js/jquery-1.8.3.min.js"></script>

	<!-- https://github.com/jcobb/basic-jquery-slider -->
	<script type="text/javascript" src="/js/bjqs-1.3.js"></script>
	<script language="JavaScript">
<!--
// 画像を一定間隔で入れ替える
// img0.jpg,img1.jpgなどの数字が続いたファイルを複数用意します。
num = 5; // 入れ替える画像の枚数(最初の画像も含める)
nme = "img/img" // 画像のディレクトリとファイル名の数字と拡張子より前の部分
exp = "jpg" // 拡張子
cnt = 0;
function changeImage() {
  cnt++;
  cnt %= num;
  document.img.src = nme + cnt + "." + exp;
}
//-->
</script>
	
  </head>
  <body>

<div class="container">
	<div class="row row-1"><img class="f" src="img/pic1.png"></div>
	<div class="row row-2">
		<div class="col-xs-3 col-xs-offset-2"> <img class="e" src="img/pic2.png"></div>
		

		<div class="col-xs-7 logo"><p style="font-size:2.2em;color:white;text-align:left;"><span>&lt;/&gt;</span>CodeGarage</p>
			<p class="description" style="color:white;text-align:left;font-size:1.0em;">キーボードに最適化したコード検索サイト</p>
		</div>

	</div>

	<div class="row row-3">
		<div class="col-md-12">
			<div style="color:white;font-size:2em;">次の３種類のショートカットを試してください。</div>
		</div>
	</div>
	<div class="row row-4">
		<div id="shortcut">
			<ul class="bjqs">
	          @if(UserAgent::is('OS X'))
	          	<li><img src="/img/key2.png"></li><!-- Cmd + A-->
	          @else
	          	<li><img src="/img/key1.png"></li><!-- Control + A-->
	          @endif
	          <li><img src="/img/key3.png"></li>
	          <li><img src="/img/key4.png"></li>
	        </ul>
	    </div>
	</div>
	<div class="row row-5">
		<div class="col-xs-12">
			<a class="btn" href="/account/signin">ログインして使う</a>
			<a class="btn" href="/snippets">ログインせず使う</a>
		</div>
	</div>
	
</div>

<script type="text/javascript">

        jQuery('#shortcut').bjqs({
            height      : 68,
            width       : 461,
            responsive : true,
            showcontrols: false, // hide next and prev controls by set false
            animspeed: 3000 // the delay between each slide
          });
        
</script>

	</body>
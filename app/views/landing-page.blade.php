<!DOCTYPE html>
<html lang="ja">
  <head>
	<meta charset="utf-8">
	<title>Twitter Bootstrap</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
	<!-- CSS の組み込み -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	
	<SCRIPT language="JavaScript">
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
</SCRIPT>
	
  </head>
  <body style="margin-top: 0;margin-left: 0;margin-right: 0;margin-bottom: 0;background-color:#000000;font-family:Meiryo UI;text-align:center;"><!--d9534f-->

<style type="text/css">

span{color:#008a62;}

a:link { color: white } 
a:visited { color: white } 
a:hover { color: white } 

</style>
    
  <script src="http://code.jquery.com/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

<div class="container">
	<div class="row"><img src="img/pic1.png"></div>
	<div class="row">
		<div class="col-md-3 col-md-offset-2"> <img src="img/pic2.png"></div>
		<div style="height:80px;"></div>
		<div class="col-md-7 " style="font-size:2.2em;color:white;text-align:left;"><span>&lt;/&gt;</span>CodeGarage</div>
		<div style="height:120px;color:white;text-align:left;">  キ ー ボ ー ドに 最 適 化 し た コ ー ド 検 索 サ イ ト</div>
	</div>

	<div class="row">
		<div class="col-md-12" style="height:400px;background-color:#000000;margin: 0 auto;">

		<div style="color:white;font-size:2em;height:150px;">次の３種類のショートカットを試してください。</div>
			<br>
				<div class="row" style="height:200px;margin:0 auto;"><img src="img/Enter.png"></div>

				<div class="container" style="color:white;position:absolute;">
					<div class="row">
	
						<div class="col-md-2 col-md-offset-3" style="vertical-align:middle;text-align: center;background-color:#008a62;height:50px;">
							<a href="/account/signin" style="vertical-align:middle;">ログインして使う</a>
						</div>
	
						<div class="col-md-2 col-md-offset-2" style="background-color:#008a62;height:50px;vertical-align: middle;text-align: center;">
							<a href="/snippets" style="vertical-align:middle;">ログインせず使う</a>
						</div>

						<div class="col-md-3" style="height:50px;"></div>
					</div>
				</div>
		</div>
	</div>
	
	<div class="col-md-12" style="height:100px;background-color:#000000;margin: 0 auto;"></div>
</div>

<script type="text/javascript">
console.log("hello");
</script>

	</body>
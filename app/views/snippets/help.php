<div class="help container">
    <article>
        <section class="row title-section">
            <blockquote id="howtouse_codegarage">検索機能の使い方</blockquote>
        </section>
        <section class="row">
            <div class="col-xs-6 offset1">
                <h2 class="title"><i class="fa pull-left fa-quote-left"></i></span>まずは検索<i class="fa pull-right fa-quote-right"></i></span></h2>
                <p>キーポードを直接検索したいキーワードを打っていただいて、最後にEnterキーを押せば検索するスニペットがリストアウトされます。</p>
            </div>
            <div class="right col-xs-offset-1 col-xs-5">
                <img src="/img/help/gif1.gif" alt="" width="370px" height="370px">
            </div>
        </section>
        <section class="row">
            <div class="right col-xs-5">
                <img src="/img/help/gif2.gif" alt="" width="370px" height="370px">
            </div>
            <div class="col-xs-6 col-xs-offset-1 offset2">
                <h2 class="title"><i class="fa pull-left fa-quote-left"></i></span>次は選ぶ<i class="fa pull-right fa-quote-right"></i></span></h2>
                <p>スニペットを選ぶときは右に改訂あるスニペットの番号を入力して、最後にEnterキーを押せば選択されます。</p>
                <p>例では、「リンクから画像保存」というスニペットを選択したいと、「2」を入力してEnterキーを押しました。</p>
            </div>
        </section>
        <section class="row">
            <div class="col-xs-6 offset1">
                <h2 class="title"><i class="fa pull-left fa-quote-left"></i></span>最後にソースコードを選択<i class="fa pull-right fa-quote-right"></i></span></h2>
                <p>
                    <span ng-if="navigator.platform.indexOf('Win') != -1">Ctrl + A</span>
                    <span ng-if="navigator.platform.indexOf('Win') == -1">Cmd + A</span>
                    でソースコードを選択して、
                    <span ng-if="navigator.platform.indexOf('Win') != -1">Ctrl + C</span>
                    <span ng-if="navigator.platform.indexOf('Win') == -1">Cmd + C</span>
                    でソースコードをコピーします。
                </p>
            </div>
            <div class="right col-xs-5 col-xs-offset-1 ">
                <img src="/img/help/gif3.gif" alt="" width="370px" height="370px">
            </div>
        </section>
    </article>

    <article>
        <section class="row title-section">
            <blockquote id="add_snippet">スニペットの追加方法</blockquote>
        </section>
        <section class="row">
            <div class="col-xs-6 offset1">
                <h2 class="title"><i class="fa pull-left fa-quote-left"></i></span>まず、「新規」をクリック<i class="fa pull-right fa-quote-right"></i></span></h2>
                <p>
                    新しいスニペットを追加する際にまずログインしないといけません。ログインした後、メニューのところに「新規」をクリックします。
                </p>
            </div>
            <div class="right col-xs-5 col-xs-offset-1">
                <img src="/img/help/click_new.gif" alt="" width="370px" height="414px">
            </div>
        </section>
        <section class="row">
            <div class="row offset3">
                <div class="col-xs-12">
                     <h2 class="title"><i class="fa pull-left fa-quote-left"></i></span>次に、スニペットを書く<i class="fa pull-right fa-quote-right"></i></span></h2>
                </div>
            </div>
            <div class="row offset3">
                <ol>
                    <li class="col-xs-3">
                        <p>スニペットのタイトルを書きます。</p>
                    </li>
                    <li class="col-xs-3 col-xs-offset-1">
                        <p>コンテンツを書きます。ソースコードの場合はまずソースコードを選択して「&lt;/&gt;」というボタンを押してください。</p>
                    </li>
                    <li class="col-xs-3 col-xs-offset-1">
                        <p>タグを加えて送信ボタンを押せばスニペットの新規が完了です。</p>
                    </li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <img class="large middle-img" width="800px" height="452px" src="/img/help/create_new_snippet.gif" alt="">
                </div>
            </div>
        </section>
    </article>
    
    <!-- リスト -->
    <div class="func-list">
        <div><a href="#howtouse_codegarage">検索機能の使い方</a></div>
        <div><a href="#add_snippet">スニペットの追加方法</a></div>
    </div>

</div>
<style>
    article {
        margin-top: 40px;
        margin-bottom: 80px;
    }
    section {
        margin-top: 15px;
        min-height: 200px;
        box-sizing: border-box;
        background-color: rgba(30,30,30,0.5);
    }
    section.title-section {
        min-height: inherit;
    }
    section.title-section blockquote {
        margin-bottom: 0px;
    }
    section .title {
        display: inline-block;
    }

    /*offset1, offset2, offset3はそれぞれのsectionのオフセット*/
    .offset1 {
        margin-top:120px;
        padding-left: 50px;
    }
    .offset2 {
        margin-top: 90px;
    }
    .offset3 {
        padding-left: 50px;
        padding-right: 50px;
    }
    .offset3 p {
        margin-left: -10px;
    }
    .help.container {
        width: 960px;
        margin: 0 auto;
    }

    

    .left {
        color: #444;
        text-align: right;
        box-sizing: border-box;
        padding-right: 40px;
        padding-top: 30px;

    }
    .left:nth-child(2) {
        text-align: left;
    }

    .right img {
       width: 100%;
       height: auto;
       margin-bottom: 20px;
       margin-top: 20px;
    }
    .right:nth-child(1) {
        text-align: right;
    }

    .func-list {
        position: fixed;
        right: 40px;
        top: 40px;
        background: rgba(50, 50, 50, 0.9);
        padding: 10px;
        width: 250px;
    }

    .func-list > div {
        padding: 3px 12px;
        margin: 10px;
        border-left: 8px solid #ccc;
    }
    img.middle-img {
        display:block;
        margin: 0px auto;
    }
    img.large {
        margin-top: 50px;
        margin-bottom: 50px;
    }
</style>
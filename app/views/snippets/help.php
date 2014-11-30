<div class="container">
    <article>
        <h3 id="explanation1">検索機能の使い方</h3>
        <section class="row">
            <div class="left col-md-6">
                ページを開いたら<br>
                <span class="decoration1">まず検索ワードを入力</span>
            </div>
            <div class="right col-md-6">
                <img src="/img/help/gif1.gif" alt="">
            </div>
        </section>
        <section class="row">
            <div class="right col-md-6">
                <img src="/img/help/gif2.gif" alt="">
            </div>
            <div class="left col-md-6">
                検索されたものを選ぶときは<br>
                <span class="decoration1">[数字]＋[Enter]</span>
            </div>
        </section>
        <section class="row">
            <div class="left col-md-6">
                <span class="decoration1">[ctrl]+[a]</span>でソースを選択
            </div>
            <div class="right col-md-6">
                <img src="/img/help/gif3.gif" alt="">
            </div>
        </section>
    </article>

    <article>
        <h3 id="explanation2">スニペットの追加方法</h3>
        <section class="row">
            <div class="left col-md-6">
                新規を押す
            </div>
            <div class="right col-md-6">
                <img alt="" class="avatar" data-user="7471716" height="auto" src="https://avatars3.githubusercontent.com/u/7471718?v=3&amp;s=460" width="100%">
            </div>
        </section>
        <section class="row">
            <div class="left col-md-6">
                タイトルとスニペットに関する記事を書く。
                例えば、『B』などのボタンを押した後の文字列は太文字になる。
                検索しやすくするようにタグもつけると良い
            </div>
            <div class="right col-md-6"></div>
        </section>
        <section class="row">
            <div class="left col-md-6">
                送信を押す！するとスニペットが追加されている！
            </div>
            <div class="right col-md-6"></div>
        </section>
    </article>
    <div class="func-list">
        <div><a href="#explanation1">検索機能の使い方</a></div>
        <div><a href="#explanation2">スニペットの追加方法</a></div>
    </div>

</div>

<style>
    h3 {
        padding: 16px 50px;
        color: #fff;
        border-top: 2px solid rgba(0,0,0, 0.2);
        background: rgba(20, 20, 20, 0.4);
        font-size: 28px;
    }

    section {
        min-height: 200px;
        box-sizing: border-box;
        padding: 12px 25px;
    }


    .container {
        width: 960px;
        margin: 0 auto;
    }

    .decoration1 {
        font-weight: bold;
        font-size: 30px;
    }

    .left {
        font-size: 24px;
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
       width: auto;
       max-height: 350px;
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
</style>
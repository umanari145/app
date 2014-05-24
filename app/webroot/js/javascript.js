$(function(){

        //セレクトタグに反応して
/*        //ソートをかける
        $("select").change(function() {
            var element = document.getElementById("ItemsSortKey"); 
            var sortKey = element.selectedIndex;
            location.href= URL + "cake/items?sortKey="+sortKey;
            });
*/
        //↑はソート条件を変えただけで作動するようにする仕様

        //コメント追加 ajaxを使った処理
        $("#CommentAdd").click(function(){

                //変数の設定ここの変数名はcommentのテーブル名と一緒にしないとだめ
                //たとえばuser_idをlogin_numberなどとすると登録されない
                var poster  = $('#commentUsername').val();
                var item_id = $('#commentItemId').val();
                var body    = $('#commentBody').val();
                var user_id = $('#commentUserId').val();
                var comment = { "user_id":user_id, "item_id":item_id, "body":body };

                //空白だと動かない
                if($.trim(body) !== "" )
                {
                     //位置調節→loading画像の読み込み
                     adjustLoading(150,"#loading","");
                     $('#loading').show();

                     $.ajax({
                         url : URL + COMMENT_CONTROLLER + 'add/' +item_id ,
                         data : { comment:comment},
                         //functionの戻り値はいらないので()にしておく。なんらかのデータがあれば(data)としておく。投票データなどを参考に。
                         type : "POST",
                         async : true ,
                         success:function(){
                         $("#comments").prepend('<p class="com">'+body+'<br><a href="/cake/items/userinfo/'+user_id+'">'+poster+'</a></p>');  
                         //loading画像をけす
                         $('#loading').hide();
                         //完了メッセージ
                         adjustLoading(25,"#complete_message","コメントを追加しました");
                         $('#complete_message').fadeIn(2000);
                         $('#complete_message').fadeOut(5000);
                         $("#commentBody").val('').focus();
                         }
                         });
                }
                else
                {
                    alert("コメントが入力されていません。");
                }
                
                //データは送らない
                return false;
        });

        //モーダルウィンドウ
        //items/viewのみこの動作はする
        //フラグのiをいれておかないと小文字の場合、動作しないなんてことになる
        var re = RegExp(/^.*Items\/view\/.*$/i);
        var flg;

        flg = ( document.URL.match(re) ) ? true : false ;

        if( flg == true ){

            $("body").append("<div id='glayLayer'></div><div id='overLayer'></div>");

            //画像をクリックすると処理が始まる
            $(".modal").click(function(){

                    //showは非表示(display:none)なものが、表示されるメソッド
                    $("#glayLayer").show();
                    //htmlタグの中に画像のurlを代入する

                    $("#overLayer").fadeIn(3000)
                    .html("<img src='"+$(this).attr("href")+"' onLoad=adjustImage() />")
                    //画像を読み込んだら処理を開始させるため、onLoadが必要(これがないとよみこまないうちに処理がはじまってしまう。)

                    //falseにしないと画像を別ウィンドウで開いてしまう
                    return false;

                    });

            //モーダルが有効になっているときに
            //バックレイヤーをクリックすると
            //モーダルがおわる
            $("#glayLayer").click(function(){
                    $("#overLayer").fadeOut(2000);
                    $(this).fadeOut(3000);
                    });
        }
});

//無事読み込めたときの処理ちゃんと位置調整をする　
//これをしないと初回だけうまく表示されないなどのエラーがおこる
function adjustImage(){
    $("#overLayer").css("margin-left",-$("#overLayer").width()/2)
        //scrollTopをしてしておけば場所を指定できる
        .css("margin-top",$(window).scrollTop()-$("#overLayer").width()/2);
}

//loading画像,メッセージの位置調節
function adjustLoading( fix , selector , message ){
    $(selector).css("top",$(window).scrollTop() + fix );
    //messageあるときはメッセージ入れる
    if( message != "" ) $(selector).text( message );
}

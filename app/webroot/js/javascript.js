$(function(){

        var URL = "http://dev.cutedogphotosite.net/";
        //セレクトタグに反応して
/*        //ソートをかける
        $("select").change(function() {
            var element = document.getElementById("ItemsSortKey"); 
            var sortKey = element.selectedIndex;
            location.href= URL + "cake/items?sortKey="+sortKey;
            });
*/
        //↑はソート条件を変えただけで作動するようにする仕様



        //評価をしたときの動き
        $("#valuation").click(function(){

            //変数設定
            var login_id =$('#welcome').html();
            var item_id = $('.Itemid').html();
            var voteValue;

            //ゲストの場合はログイン画面へ。
            if(login_id == "ゲスト") location.href= URL + "cake/users/";

            //loadinはshowとhideをある程度離さないと
            //機能しない。多分、一瞬でおわっていまう。
            adjustLoading(10,"#loading","");
            $('#loading').show();

            for(var i = 1 ;i <= 5 ; i++ ) {

            voteValue = document.getElementById("VoteVotePoint"+i); 

            if(voteValue.checked == true ) {


                var vote_point = voteValue.value;
                var vote={"login_id":login_id,"item_id":item_id,"vote_point":vote_point};


                $.post( URL + 'cake/votes/add/',
                        {vote:vote},
                        //既存の表示を隠して、読み込み後のページを表示させる
                        //(正規表現でグラフの部分のみ抜き取る)
                        //↑これをやろうとおもったがなぜか正規表現は使えない・・・
                        function(data){
                        data.match(/<div id="core2">\s*(.*?)<\/div>/g);
                        //alert(data);
                        //alert(RegExp.lastMatch);//←これはタグ部分も含めた場所を抜き取る
                        //alert(RegExp.lastParen);//←これはヒットした部分、()のみ抜き取る
                        $('#loading').hide();
                        adjustLoading(25,"#complete_message","商品に投票しました");
                        $('#complete_message').fadeIn(2000);
                        $('#complete_message').fadeOut(5000);
                        }
                      );
                break;//ループからぬける
            }
            }
            return false;
        });

        //コメント追加 ajaxを使った処理
        $("#CommentAdd").click(function(){

                //変数の設定ここの変数名はcommentのテーブル名と一緒にしないとだめ
                //たとえばuser_idをlogin_numberなどとすると登録されない
                var poster  = $('#welcome').html();
                var item_id = $('.Itemid').html();
                var body    = $('#commentBody').val();
                var user_id = $('#login_number').html();
                var comment = {"user_id":user_id,"item_id":item_id,"body":body};

                //ゲストの場合ログイン画面へ飛ばす
                if(poster == "ゲスト") location.href= URL + "cake/users/index";

                //空白だと動かない
                if($.trim(body) !=="" ){
                //位置調節→loading画像の読み込み
                adjustLoading(150,"#loading","");
                $('#loading').show();

                     $.ajax({
                         url : URL + 'cake/comments/add/'+item_id ,
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
                //データは送らない
                return false;
        });

        //タグ入力支援
        $(".tag").mouseover(function(){
                $(this).css("opacity","0.4");
                });

        $(".tag").mouseout(function(){
                $(this).css("background","#00ffff");
                $(this).css("opacity","1.0");
                });

        //クリックしたらタグフィールドに
        $(".tag").click(function(){
                var tag=$(this).text();
                var tagArr=$("#ItemTags").val();
                //区切り文字
                var separator;
                separator = ( $.trim( tagArr ) == "" ) ? " " : "," ; 
                tagArr += separator + tag;
                $("#ItemTags").val(tagArr);

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

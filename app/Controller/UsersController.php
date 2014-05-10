<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $name    = "Users";
    public $layout  = "review" ;
    //通常のログイン画面
    public  $components = array( 'Cookie' , 'Session' );
    //cookie処理

    public function beforeFilter (){

        $login_id = $this->Cookie->read( 'login_id' );
        
        if( $login_id !== null ) $this->redirect( array( 'controller' => 'items' , 'action' => 'index' ) ) ;

        $this->set( 'login_id' , $login_id );
    }

    function index(){

        $title   = "ログイン画面";
        $message = "メールアドレスとパスワードを入力してください";

        //postがあったときはここの処理
        if( $this->request->is('post') ){
            
            $login_id = $this->request->data["User"]["login_id"] ;
            $pass     = sha1( $this->request->data["User"]["pass"] );
 
            if( $this->User->validates() ){

                //データがあるかないかはこれで判断
                if( $this->User->hasAny( array( 'User.login_id' => $login_id ,'User.pass' => $pass ) ) ){

                    //ログオン状態を保持する場合
                    if( $this->request->data["User"]["iscookie"] === "1" ){

                        $this->Cookie->Write( 'login_id' , $login_id , false , 14 * 24 * 60 * 60 );
                    }else{
                        //ログインを保持しない場合
                        $this->Session->Write( 'login_id' , $login_id );
                    }
                    
                    $this->redirect( array('controller' => 'items', 'action' => 'index') );
                }else{
                    //エラーメッセージを力技で入れる。
                    $this->User->validationErrors["pass"][0] = "メールアドレス、パスワードのいずれかが違います。";
                }
            }
        }
        $this->set( 'title'   , $title );
        $this->set( 'message' , $message );

    }

    //新規登録画面
    function regist(){

        $title   = "新規登録画面";
        $message = "メールアドレスとパスワードを登録してください";

        $passCheckMessage = "";

        $this->set( 'status' , 'regist');

        if($this->request->is('post')){
            
            $login_id = $this->request->data["User"]["login_id"];
            $pass     = $this->request->data["User"]["pass"];
            

            $this->request->data["User"]["passArr"][0] =  $this->request->data["User"]["pass"];
            $this->request->data["User"]["passArr"][1] =  $this->request->data["User"]["re_pass"];

            $this->User->set( $this->request->data );
            $this->User->validate=$this->User->validate_regist;

            if( $this->User->validates() ){

               /* //ログオン状態を保持する場合
                if( $this->request->data["User"]["iscookie"] === "1" ){
                    $this->Cookie->Write( 'login_id' , $login_id , false , 14 * 24 * 60 * 60 );
                    

                }else{
                    //ログインを保持しない場合
                    $this->Session->Write( 'login_id' , $login_id );
                }
                */
                $this->request->data["User"]["session_id"] = $this->Session->id();

                 $this->User->save( $this->request->data );
                 $regist_mail_flg = $this->Common->send_regist_mail( $login_id );
             
                 $message  = "仮登録が完了しました。届いたメールのリンクをクリックして登録を完了ください。";
                 $this->set( 'status' , 'pro');
            }

            if( isset( $this->User->validationErrors["passArr"]["0"] ) === true ){
                $passCheckMessage = $this->User->validationErrors["passArr"]["0"] ;        
            }
        }

        $this->set( 'title' , $title );
        $this->set( 'passCheckMessage' , $passCheckMessage );
        $this->set( 'message' , $message );
    }

    function pro_to_def_registration(){
	$session_id =  $this->request->query["session_id"] ;
       
        $this->User->updateAll(
                     array( "status"     => "'member'"), //←シングルクオートないと動かない
                     array( "session_id" => $session_id )
        );
        
        $this->redirect( array( 'action' => 'index') );
           
    }
  
    //logoutのメソッドはここにきて、
    //最後はindexにいく
    function logout(){
        $this->redirect( array( 'action' => 'index' ));
    }
}

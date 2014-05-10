<?php


class CommonComponent extends Component {

	//ここで宣言しないと当然メソッドが使えない
	public $components=array('Cookie','Session');
	
	//login_idを送る
	public function getLogin_id(){
		$login_id=$this->Cookie->read('login_id');
        
        if($login_id === null){
			$login_id=$this->Session->Read('login_id');
			if($login_id === null ) $login_id = "ゲスト";
		}
		return $login_id;
	}

           

        public function send_regist_mail( $email ){
              
            mb_language("japanese");
            mb_internal_encoding("UTF-8");

            $session_id = $this->Session->id();              
             
            $title = "会員登録ありがとうございます。 ";

            $body = "ご登録ありがとうございます。\n\n"
                  . "以下のリンクをクリックしていただくと正式に登録となります。\n" ;

	    $body .= URL . "cake/users/pro_to_def_registration?" . "session_id=" . $session_id ;
                
               $regist_mail_flg = mb_send_mail( $email , $title , $body ) ;
 
               return $regist_mail_flg ;

        }
}

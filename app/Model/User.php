<?php
App::uses('AppModel', 'Model');

class User extends AppModel{
    //ヴァリデーションをログイン時と登録時で分ける
    public $validate =array(
	'login_id' => array('rule'=>'notEmpty','message'=>"メールアドレスが未入力です"),
    'pass'     => array('rule'=>'notEmpty','message'=>"パスワードが未入力です")        
    );
    //登録時のヴァリデーション
    public $validate_regist = array(

        'login_id' =>array( 
            'notEmpty'=>array(
                //alphanumricは日本語を通してしまうので独自仕様が必要
                'rule' => 'notEmpty' ,
                'message' => 'メールアドレスを入力してください。'
            ),

            'email'=>array(
                //alphanumricは日本語を通してしまうので独自仕様が必要
                'rule' => 'email' ,
                'message' => '不適切なメールアドレスです。'
            ),

            'isUnique'=>array(
                'rule' =>'isUnique' ,
                'message' => 'そのメールアドレスはすでに登録されています。'
            )
        ),
       
       'yourname' => array(
            //alphanumricは日本語を通してしまうので独自仕様が必要
            'notEmpty' => array(
                'rule' =>'notEmpty' ,
                'message' => 'ユーザー名を登録してください。')
            ) ,

      'pass' => array(
            //alphanumricは日本語を通してしまうので独自仕様が必要
            'custom' => array(
                'rule'=>array('custom', '/^[a-z\d]{4,30}$/i'),
                'message' => '4字以上30字以内の半角英数字を入力してください')
            ) ,

       'passArr' => array(
            'passCheck' => array(
                'rule' => 'passCheck',
                'message' => 'パスワードが一致していません。もう一度正確に入力してください。',
            )
             
        )
    );

    //userinfoページでこのhasoneを使う
    public $hasOne = array('Item'=>array('conditions'=>'delete_flg = 0 '));

    //パスワードは暗号化する
    public function beforeSave(){
        $this->data["User"]["pass"]=sha1($this->data["User"]["pass"]);
    }        

    //一致しなければアウト
    public function passCheck( $data = array() ){
        
        if( $data["passArr"][0] === $data["passArr"][1] ){
            return true ;
        }else{
            return false ;
        }

    }
    
    public function userinfo($id){
        $userinfo=$this->find('first',array('conditions' => array('User.id'=>$id),
            'fields'     => array('User.id','User.login_id' ,'User.yourname')));
   return $userinfo;
   
   }


}

?>

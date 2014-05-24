<?php
App::uses('AppModel', 'Model');

class User extends AppModel{
 
    public $name = 'User';
 
    // バリデーションルール
    public $validate = array(
    'username' => array(
        array('rule' => array('custom', '/^[a-zA-Z0-9]+$/'), 'message' => '半角英数字で入力して下さい。'),
        array('rule' => 'isUnique', 'message' => 'このユーザー名は既に使われています。')
    ),
    'email' => array(
        array('rule' => 'email', 'message' => '正しいメールアドレスを入力してください。')
    ),
    'password' => array(
        array('rule' => array('custom', '/^[a-zA-Z0-9]{6,25}$/'), 'message' => '6文字以上25文字以下の半角英数字で入力して下さい。')
    ),
     'role' => Array(
            'valid' => Array(
                'rule' => Array('inList', Array('admin', 'staff', 'author')),
                'message' => '権限を選択してください。',
                'allowEmpty' => false
            )
        )
); 
    public function beforeSave() {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

    public function userinfo($id){
        $userinfo=$this->find('first',
            array('conditions' => array('User.id'=>$id),
                  'fields'     => array('User.id','User.username')));
       
        return $userinfo;
   }


}

?>

<?php
App::uses('AppModel', 'Model');
/**
 * Userinfo Model
 *
 * @property User $User
 */
class Userinfo extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'ユーザー名を入力してください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	        'userimage' => array(
                       'imageCheck' => array(
                            'rule' => array('imageCheck'),
                            'message' => '画像ファイルをアップロードしてください。※有効なファイル形式はjpeg,jpg,gif,pngのみです。またサイズは1MB以内です。',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),

        	'contents' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => '自己紹介欄を入れてください。',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);


	public function imageCheck( $data  ){
		//画像は無くてもOK
	        $image= $data["userimage"]; 	
                
                if( $image["name"] === "" ){
			return true ;
		}else{

			if($image['error'] === 0 && $image['size'] !== 0 && preg_match ( '/^image.*/', $image['type'] ) === 1){

				if(is_uploaded_file($image['tmp_name']) && $image['size'] < 1000000){

					$ext = array();
					$ext = explode( '/', $image['type']);
					if ( $ext[1] !== 'jpg' && $ext[1] !== 'gif' && $ext[1] !== 'jpeg' && $ext[1] !== 'png' ) {
						return false;
					}
					//アップされた画像がすべての条件をクリアしていたらここに来る
					return true;
				}
				return false;
			}
		}
	}

        public function beforeSave(){
            //画像の名前だけを配列にしてデータベースに格納する。
                    $image = $this->data["Userinfo"]["userimage"];
                    $ext = array();
                    $ext = explode( '/', $image['type']);
                    //これはこの関数で使うアップ用のファイル名
                    $imageName = time() ."." . $ext[1];
                    //これはデータベースの名前で使うデータ
                    //配列をスカラにしないとDBが認識できない
                    $this->data["Userinfo"]["userimage"] = $imageName;
                    move_uploaded_file ($image["tmp_name"], IMG_PATH . $imageName );
         

        }
//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

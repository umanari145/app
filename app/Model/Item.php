<?php
App::uses('AppModel', 'Model');
/**
 * Item Model
 *
 * @property Cate $Cate
 * @property Comment $Comment
 */
class Item extends AppModel {
    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    public $actsAs = array('Containable');
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule'     => array('notempty'),
                'message'  => '商品名を入れてください'
            ),
        ),
        'body' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => '記事内容を入力してください'
            ),
        ),
        'image' => array(
            'imageCheck' => array(
                'rule' => array('imageCheck','image'),
                'message' => '画像ファイルをアップロードしてください。※有効なファイル形式はjpeg,jpg,gif,pngのみです。またサイズは1MB以内です。'
            ),
        ),
        'image2' => array(
            'imageCheck' => array(
                'rule' => array('imageCheck','image2'),
                'message' => '※有効なファイル形式はjpeg,jpg,gif,pngのみです。またサイズは1MB以内です。',
                'allowEmpty' => true
            ),
        ),
        'image3' => array(
            'imageCheck' => array(
                'rule' => array('imageCheck','image3'),
                'message' => '※有効なファイル形式はjpeg,jpg,gif,pngのみです。またサイズは1MB以内です。',
                'allowEmpty' => true
            ),
        ),
        'cate_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => '',
            ),
        )
    );

    //画像ファイルチェック関数
    public function imageCheck($data,$key){

        $image=array();
        $image=$data[$key];

        //もし一枚目でファイルがない場合はエラー
        if($key==="image" && $image["name"] === "" ) return false; 

        if($image["name"] !== ""){

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
            return false;
        }
        //２枚目、３枚目の画像はなくてもOKなのでここに来る
        return true;
    }

    //画像ファイルはアップする前に名前を変え、
    //サムネイルを作る
    public function beforeSave(){

        //ここでこの条件がないとカウンター増加
        //など別のItemテーブルへのアクセスの時にも
        //反応してしまう。
        if(isset($this->data["Item"]["image"]) === true ){

            //１枚目は必須だが、２枚目、３枚目は必須でない。
            //値がなければNULLで値を出す
            $keyArr=array("_001"=>"image","_002"=>"image2","_003"=>"image3");
            //サムネイル用のクラスを読み込み

            include('class/SimpleImage.php');
            $imgcreate = new SimpleImage();

            foreach($keyArr as $key => $val){
                //１枚目じゃなくて値がないときはヌルをいれておく
                if( $val === "image" || $this->data["Item"][$val]["name"] !== "" ){
                    $imageArr=$this->data["Item"][$val];

                    $ext = array();
                    $ext = explode( '/', $imageArr['type']);

                    //これはこの関数で使うアップ用のファイル名
                    $imageName = time() . $key ."." . $ext[1];
                    //これはデータベースの名前で使うデータ
                    //配列をスカラにしないとDBが認識できない
                    $this->data["Item"][$val] = $imageName;

                    move_uploaded_file ($imageArr["tmp_name"],IMG_PATH.$imageName );
                    $imgcreate->load( IMG_PATH . $imageName );
                    $imgcreate->resize( 200 , 200 );
                    $imgcreate->save( IMG_PATH_THUMB . $imageName );

                }else{
                    //２枚目、３枚目でファイルがないときはここ
                    $this->data["Item"][$val] = null;
                }
            }
            //foreach終わり
            return true;
        }
        //item登録以外(カウンターでの増加)
        //などはここの処理を使う
        return true;
    } 

    //itemデータ一覧
    //階層を2段以上掘るときの処理に注意！
    public function itemData($id){

        $item = $this->find('all',
            array(
                'contain' => array(
                    'Comment'=> array( 'fields' => array('body'), 'User' => array('fields' => array( 'id' ,'username'))),
                    'User'   => array( 'fields' => array( 'id' ,'username' )),
                    'Cate.cate'),
                'conditions' => array( 'Item.id' => $id ) )

            );

        return $item[0];

    }

    public function getSearchQuery()
    {
        //検索窓に文字があった場合
        if( isset( $this->request->query['word'] ) === true && trim( $this->request->query['word'] ) !== "" )
        {    
            
            $word = $this->request->query['word'];
            $this->paginate['conditions'] = array( 'or' => array(
                                                                  array('Item.body Like' => "%" . $word . "%" ),
                                                                  array('Item.name Like' => "%" . $word. "%" )
                                                                )
                                                  );
            $this->set( 'word' , $word );
        }

        //カテゴリ検索あった場合はここで絞り込み
        //ただしインデックスは０表記
        if( $key !== null && $key !== "0" ) $this->paginate['conditions'] = array( 
                                                                                   'Item.delete_flg' => 0 , 
                                                                                   'Item.cate_id'    => $key
                                                                                  );
    
    }

    //左サイドの
    //カテゴリリスト
    public function cateList(){

        $this->recursive=2;
        //取り出したい情報はitemごとのカテゴリーの数と名称
        //名称を取り出すためにidでリンク付けをする
        $list = $this->find('all',array('fields'=>array('COUNT(cate_id)','cate_id'),'group'=>'cate_id'));
        return $list;

    }
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Cate' => array(
            'className' => 'Cate',
            'foreignKey' => 'cate_id',
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
        )
    );
    /**
     * hasMany associations
     *
     * @var array
     */
    //個別itemのviewページでこのhasmanyを使う
    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'item_id',
            'dependent' => false,
            'conditions' => 'delete_flg = 0'
        )
    );

}

<?php
App::uses('AppController', 'Controller');
/**
 * Items Controller
 *
 * @property Item $Item
 */
class TagsController extends AppController {

	public $uses=array('Tag');
	public $layout='review';
	public $paginate=array(
	                    	'page'      => 1 ,
	                    	'limit'     => 2,
	                    	'sort'      => 'id',
	                    	'direction' =>'desc',
	                    	'recursive' => 1
	                       );
	//componentはコントローラーの共通処理
	public $components=array('Common','Cookie','Session');
	/**
	 * index method
	*/
	//タグでのソート
	function hojikuri($id=null){
		//modelで↓をかくと、なぜかaddができない。
		//だからソートするときのみ、リレーションを設定する。
		$this->Tag->bindModel(array(
				'hasAndBelongsToMany' => array(
					'Item' => array(
									'className' => 'Item',
									'joinTable' => 'items_tags',
									'foreignKey' => 'tag_id',
									'associationForeignKey' => 'item_id'
					)
				)
				)
		);
			 
	$this->paginate['conditions']=array('Tag.id'=>$id);
	$items=$this->paginate();
    
    foreach( $items as $item ){ 

	/*$this->loadModel('Cate');
	$this->loadModel('Tag');
	$this->loadModel('Vote');
	*/
	$this->loadModel('Item');
	
	var_dump($item);
	exit;
	$itemsdetail=$this->Item->find(
			'first',
			array(
				'contain'=>array('Cate.cate','Tag.tag','Vote.vote_point'),
				'conditions'=>$item_id)
				);
	}
	
	
	var_dump($items["Item"]);
	
	
	exit;
		$this->set('sortKey',$sortKey);
		//任意のviewにデータを渡したいときはrenderを使う。
		$this->render('/Items/index.ctp');
	}
}

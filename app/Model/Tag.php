<?php
App::uses('AppModel', 'Model');

class Tag extends AppModel {
	public $name='Tag';
	public $displayField = 'tag';
	public $useTable='tags';


	//ここを有効にしてしまうと
	//なぜか
	//itemのaddメソッドがうまく入らない
	/*public $hasAndBelongsToMany = array(
		'Item' => array(
			'className' => 'Item',
			'joinTable' => 'items_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => 'item_id'
		)
	);*/

	public function beforeSave(){
		//すでにあるものははじき、そうでなければ登録
		if($this->hasAny(array("tag"=>trim($this->data["Tag"]["tag"])))){
			return false;	
		}else{
			return true;
		}	
	}

	//item登録時タグの追加
	public function addTag($tagData){

		//まずタグの分解
		$tags=explode(",",$tagData);

		//登録と同時にtagのidを取得
		$tagNumber=array();
		foreach($tags as $tag){
			//複数のデータを作るときはこれしないとだめ
			$this->create();
			//配列で入れないとはじかれる
			//空白削除と大文字に
			$this->save(array("tag"=>strtoupper(trim($tag))));
			$tag_id=$this->find('first',
				array('fields'=>array('Tag.id'),
				'conditions'=>array('Tag.tag'=>strtoupper(trim($tag)))
			)
		);
			array_push($tagNumber,$tag_id['Tag']['id']);
		}

		return $tagNumber;

	}

}
?>

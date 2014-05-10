<?php
App::uses('AppModel', 'Model');

class Tag extends AppModel {
	public $name='Tag';
	public $displayField = 'tag';
	public $useTable='tags';


	//‚±‚±‚ð—LŒø‚É‚µ‚Ä‚µ‚Ü‚¤‚Æ
	//‚È‚º‚©
	//item‚Ìaddƒƒ\ƒbƒh‚ª‚¤‚Ü‚­“ü‚ç‚È‚¢
	/*public $hasAndBelongsToMany = array(
		'Item' => array(
			'className' => 'Item',
			'joinTable' => 'items_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => 'item_id'
		)
	);*/

	public function beforeSave(){
		//‚·‚Å‚É‚ ‚é‚à‚Ì‚Í‚Í‚¶‚«A‚»‚¤‚Å‚È‚¯‚ê‚Î“o˜^
		if($this->hasAny(array("tag"=>trim($this->data["Tag"]["tag"])))){
			return false;	
		}else{
			return true;
		}	
	}

	//item“o˜^Žžƒ^ƒO‚Ì’Ç‰Á
	public function addTag($tagData){

		//‚Ü‚¸ƒ^ƒO‚Ì•ª‰ð
		$tags=explode(",",$tagData);

		//“o˜^‚Æ“¯Žž‚Étag‚Ìid‚ðŽæ“¾
		$tagNumber=array();
		foreach($tags as $tag){
			//•¡”‚Ìƒf[ƒ^‚ðì‚é‚Æ‚«‚Í‚±‚ê‚µ‚È‚¢‚Æ‚¾‚ß
			$this->create();
			//”z—ñ‚Å“ü‚ê‚È‚¢‚Æ‚Í‚¶‚©‚ê‚é
			//‹ó”’íœ‚Æ‘å•¶Žš‚É
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

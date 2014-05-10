<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property User $User
 */
class Vote extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $uses = 'Vote';
	public $actsAs = array('Containable');

	//The Associations below have been created with all possible keys, those that are not needed can be removed


	//投票データの集計
	public function voting($id){
		
		$votes=array();
	
		for($i=1;$i<=5;$i++){
			$vote[$i]=$this->find('count',array('conditions'=>array('item_id'=>$id,'vote_point'=>$i)));
			array_push($votes,$vote[$i]);
		}

		return $votes;
	}
	//投票データの平均値
	public function votingAv($id){
	$totalVote=$this->find('first',array('fields'=>array('AVG(vote_point) AS voteAVG','COUNT(id) AS cnt'),
			'conditions'=>array('item_id'=>$id)	
		)
	);

	return $totalVote[0];

	}

}

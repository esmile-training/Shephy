<?php

class Controller_Top extends Controller_Base_Game
{
	public function action_index($error_code = null)
	{
		\config::load('error');
		$this->view_data['error_msg'] = ($error_code)? config::get('msg.'.$error_code) : false;

		View_Wrap::contents('top', $this->view_data);
	}
	
	public function action_logIn()
	{
		$param = input::post();

		//ユーザデータ取得
		$this->view_data['user'] = Model_User::find('first', array(
			'where' => array(
				'name' => $param['name'],
				'password' => $param['password'],
			)
		));
		
		// データがない場合insertを行ってからユーザーデータ取得
		if(is_null($this->view_data['user'])){
			$userDb = DB::insert();
			$userDb->table('user');
			// カラム名と値をセット
			$userDb->columns(array(
				'name',
				'password',
			   )
			);
			$userDb->values(array(
				$param['name'],
				$param['password'],
			));
			$userDb->execute(); //クエリ実行

			$userDb->reset(); //クエリリセット
			
			//ユーザデータ取得			
			$this->view_data['user'] = Model_User::find('first', array(
				'where' => array(
					'name' => $param['name'],
					'password' => $param['password'],
				)
			));
		}

		// 元となるデッキデータを取得
		$deckSource = array_merge($this->csv->getAll('/field/deck_mst'));
		$handData = "";
		$handMin = 1;
		$handMax = 5;
		// 手札データの生成
		for($handCounter = $handMin; $handCounter <= $handMax; $handCounter++){
			// 手札にするカード1枚をランダム選択
			$deckValue = rand(0,(count($deckSource)-1));
			// カードのidを文字列として連結して格納
			$handData = $handData.$deckSource[$deckValue]['id'];
			// 5枚目の手札以外はidの後にカンマを入れて区切る
			if($handCounter != $handMax){
				$handData = $handData.",";
			}
			// 選択されたカードデータを削除
			unset($deckSource[$deckValue]);
			// 削除された要素を詰める
			$deckSource = array_merge($deckSource);
		}
		
		// デッキデータの生成
		$deckCounter = 0;
		$deckData = "";
		foreach ($deckSource as $deck):
			$deckCounter++;
			// カードのidを文字列として連結して格納
			$deckData = $deckData.$deck['id'];
			// 最後のカード以外はidの後にカンマを入れて区切る
			if($deckCounter != count($deckSource)){
				$deckData = $deckData.",";
			}
		endforeach;
		
		//フィールドデータをinsert
		$uGameDataDb = DB::insert();
		$uGameDataDb->table('uGameData');
		// カラム名と値をセット
		$uGameDataDb->columns(array(
			'uId',
			'hand',
			'deck',
		   )
		);
		$uGameDataDb->values(array(
			$this->view_data['user']->id,
			$handData,
			$deckData,
		));
		$uGameDataDb->execute(); //クエリ実行

		$uGameDataDb->reset(); //クエリリセット

//		if(is_null($this->view_data['user'])){
//			Response::redirect('top/index/1');
//		}

		// SESSIONに格納
		session_start();
		$_SESSION['user_id'] = $this->view_data['user']->id;
		
		//ビュー表示
		Response::redirect('field');
	}
}

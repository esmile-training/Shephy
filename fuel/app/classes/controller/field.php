<?php

class Controller_Field extends Controller_Base_Game
{
	public function action_index()
	{
		//フィールドデータ取得
		$this->view_data['GameData'] = Model_Field::find('first', array(
			'where' => array(
				'uId' => $this->view_data['user']->id,
			)
		));
		
		View_Wrap::contents('field', $this->view_data);
	}
	public function action_card()
	{
		$param = $_POST['card_id'];
		
		$GameData = Model_Field::find('first', array(
			'where' => array(
				'uId' => $this->view_data['user']->id,
			)
		));
		
		// 使ったカードを手札から削除する
		// カンマで区切られた手札のデータを配列化
		$hand = explode(',', $GameData["hand"]);
		// 使用したカードを手札から削除
		unset($hand[array_search($param, $hand)]);
		// 削除された要素を詰める
		$hand = array_merge($hand);

		// 配列になっている手札データを文字列化
		$handData = "";
		foreach ($hand as $handId){
			// カードのidを文字列として連結して格納
			$handData = $handData.$handId;
			if($handId != $hand[(count($hand)-1)]){
				$handData = $handData.',';
			}
		}

		$deckData = "";
		// デッキにカードデータがあればデッキからカードを1枚手札に加える
		if($GameData["deck"] != ""){
			// カンマで区切られたデッキのデータを配列化
			$deck = explode(',', $GameData["deck"]);
			// 手札にするカード1枚をランダム選択
			$deckValue = rand(0,(count($deck)-1));
			// カードのidを文字列として連結して格納
			$handData = $handData.','.$deck[$deckValue];
			// 選択されたカードデータを削除
			unset($deck[$deckValue]);
			// 削除された要素を詰める
			$deck = array_merge($deck);

			// 配列になっているデッキデータを文字列化
			foreach ($deck as $deckId){
				// カードのidを文字列として連結して格納
				$deckData = $deckData.$deckId;
				// 最後のカード以外はカンマで区切る
				if($deckId != $deck[(count($deck)-1)]){
					$deckData = $deckData.',';
				}
			}
		}

		// 使用したカードを墓地へ送る
		$cemeteryData = $GameData["cemetery"];
		// 使用したカードのidを文字列として連結して格納
		if($cemeteryData == ""){
			// 1枚目の場合はカンマを付けずに格納
			$cemeteryData = $param;
		}
		else{
			// 2枚目以降の場合は初めにカンマを入れて区切って格納
			$cemeteryData = $cemeteryData.",".$param;
		}
		
		// 手札がない場合
		// 墓地のカードをデッキにして手札を5枚にする処理
		if($handData == ""){
			// カンマで区切られた墓地のカードを配列化してデッキにする
			$deck = explode(',', $cemeteryData);
			// 墓地のカードを空にする
			$cemeteryData = "";
			$handMin = 1;
			$handMax = 5;
			// 手札データの生成
			for($handCounter = $handMin; $handCounter <= $handMax; $handCounter++){
				// 手札にするカード1枚をランダム選択
				$deckValue = rand(0,(count($deck)-1));
				// カードのidを文字列として連結して格納
				$handData = $handData.$deck[$deckValue];
				// 5枚目の手札以外はidの後にカンマを入れて区切る
				if($handCounter != $handMax){
					$handData = $handData.",";
				}
				// 選択されたカードデータをデッキから削除
				unset($deck[$deckValue]);
				// 削除された要素を詰める
				$deck = array_merge($deck);
			}

			// 配列になっているデッキデータを文字列化
			$deckData = "";
			foreach ($deck as $deckId){
				// カードのidを文字列として連結して格納
				$deckData = $deckData.$deckId;
				// 最後のカード以外はカンマで区切る
				if($deckId != $deck[(count($deck)-1)]){
					$deckData = $deckData.',';
				}
			}
		}

		// ゲームデータをupdate
		$uGameDataDb = DB::update();
		$uGameDataDb->table('uGameData');
		// カラム名と値をセット
		$uGameDataDb->set(array(
			'hand' => $handData,
			'deck' => $deckData,
			'cemetery' => $cemeteryData,
		   )
		);
		$uGameDataDb->where('uId', '=', $this->view_data['user']->id);
		$uGameDataDb->execute(); //クエリ実行

		$uGameDataDb->reset(); //クエリリセット
		
		Response::redirect('field');
	}
}
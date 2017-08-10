<style type="text/css">
	#background {
		position: relative;
		text-align: center;
	}
	#menu_img{
		position: absolute;
		top: 3%;
		right: 3%;
		width: 15%;
	}
	#deck_img {
		position: absolute;
		top: 38%;
		right: 8%;
		width: 10%;
	}
	#monsters{
		position: absolute;
		top: 5%;
		left: 5%;
		height: 120px;
		width: 660px;
	}
	#monster1_img {
		position: absolute;
		top: 0px;
		left: 0px;
		height: 100%;
		width: 90px;
	}
	#monster3_img {
		position: absolute;
		top: 0px;
		left: 95px;
		height: 100%;
		width: 90px;
	}
	#monster10_img {
		position: absolute;
		top: 0px;
		left: 190px;
		height: 100%;
		width: 90px;
	}
	#monster30_img {
		position: absolute;
		top: 0px;
		left: 285px;
		height: 100%;
		width: 90px;
	}
	#monster100_img {
		position: absolute;
		top: 0px;
		left: 380px;
		height: 100%;
		width: 90px;
	}
	#monster300_img {
		position: absolute;
		top: 0px;
		left: 475px;
		height: 100%;
		width: 90px;
	}
	#monster1000_img {
		position: absolute;
		top: 0px;
		left: 570px;
		height: 100%;
		width: 90px;
	}
	#field {
		position: absolute;
		top: 30%;
		left: 5%;
		height: 120px;
		width: 660px;
	}
	#field1 {
		position: absolute;
		top: 0px;
		left: 0px;
		height: 100%;
		width: 90px;
	}
	#field2 {
		position: absolute;
		top: 0px;
		left: 95px;
		height: 100%;
		width: 90px;
	}
	#field3 {
		position: absolute;
		top: 0px;
		left: 190px;
		height: 100%;
		width: 90px;
	}
	#field4 {
		position: absolute;
		top: 0px;
		left: 285px;
		height: 100%;
		width: 90px;
	}
	#field5 {
		position: absolute;
		top: 0px;
		left: 380px;
		height: 100%;
		width: 90px;
	}
	#field6 {
		position: absolute;
		top: 0px;
		left: 475px;
		height: 100%;
		width: 90px;
	}
	#field7 {
		position: absolute;
		top: 0px;
		left: 570px;
		height: 100%;
		width: 90px;
	}
	#hand {
		position: absolute;
		top: 60%;
		left: 5%;
		height: 180px;
		width: 980px;
	}
	#hand1 {
		position: absolute;
		top: 0px;
		left: 0px;
		height: 100%;
		width: 135px;
	}
	#hand2 {
		position: absolute;
		top: 0px;
		left: 140px;
		height: 100%;
		width: 135px;
	}
	#hand3 {
		position: absolute;
		top: 0px;
		left: 280px;
		height: 100%;
		width: 135px;
	}
	#hand4 {
		position: absolute;
		top: 0px;
		left: 420px;
		height: 100%;
		width: 135px;
	}
	#hand5 {
		position: absolute;
		top: 0px;
		left: 560px;
		height: 100%;
		width: 135px;
	}
	.card_image{
		position: absolute;
		width: 100%;
	}
	#button{
		position: absolute;
		bottom: 5%;
		height: 10%;
	}
	#cemetery_img{
		width: 100%;
	}
	#exclusion_img{
		width: 100%;
	}
</style>

<?php $cemeteryData = explode(',', $GameData->cemetery);?>
<?php $exclusionData = explode(',', $GameData->exclusion);?>

<div id="background">
	<?= Asset::img(	'admin/field.png',array('id'=>'background')) ?>
</div>

<?php //メニューボタン ?>
<div>
	<?= Asset::img('admin/menu.png',
			array('id'=>'menu_img')
	) ?>
</div>

<?php //モンスター置き場 ?>
<div id="monsters">
<?php foreach(explode(',', $GameData->monster) as $monster): ?>
	<?= Asset::img( 'monster/'.$monster.'.png',
		array('id'=>'monster'.(int)($monster/10).'_img')
	) ?>
<?php endforeach; ?>
</div>

<?php //フィールド ?>
<div id="field">
<?php $fieldCounter = 1;?>
<?php foreach(explode(',', $GameData->field) as $field): ?>
	<?php if($field != 0){ ?>
		<?= Asset::img( 'monster/'.$field.'.png',array('id'=>'field'.$fieldCounter)) ?>
	<?php } ?>
	<?php $fieldCounter++;?>
<?php endforeach; ?>
</div>

<?php //手札 ?>
<div id="hand">
<?php $handCounter = 1;?>
<?php foreach(explode(',', $GameData->hand) as $hand): ?>
	<?php if($hand != 0){ ?>
		<a id="hand<?=$handCounter?>" class="modal_btn hand image_change" value="<?=$hand?>">
			<?= Asset::img( 'card/'.$hand.'.png',array('class'=>'card_image')) ?>
		</a>
	<?php } ?>
	<script type="text/javascript">
		$("#hand<?=$handCounter?>").click(function(){
			// valueの取得
			var getValue = $(this).attr('value');

			var afterImg = "http://esmile-sys.sakura.ne.jp/Shephy/gojo/public/assets/img/card/" + getValue + ".png";

			document.getElementById("hand_card_image").src = afterImg;
			
			document.getElementById("value_strage").value = getValue;
		});
	</script>
	<?php $handCounter++;?>
<?php endforeach; ?>
</div>

<?php //デッキ ?>
<div>
	<p>
		<?php if($GameData->deck != "")
			{	?>
				<?= Asset::img('admin/deck.png',
						array('id'=>'deck_img')
				) ?>
		<?php }	?>
	</p>
</div>

<?php //墓地、除外ボタン ?>
<table id="button">
	<tr>
		<td width="76%"></td>
		<td width="10%">
			<p>
				<?php $cemetery_counter = explode(',', $GameData->cemetery);?>
				<a id="cemetery" class="modal_btn cemetery " value="<?= count($cemetery_counter) ?>">
					<?= Asset::img('admin/cemetery.png',
							array('id'=>'cemetery_img')
					) ?>
				</a>
			</p>
		</td>
		<td width="1%"></td>
		<td width="10%">
			<p>
				<a class="modal_btn exclusion">
					<?= Asset::img('admin/exclusion.png',
							array('id'=>'exclusion_img')
					) ?>
				</a>
			</p>
		</td>
		<td width="3%"></td>
	</tr>
</table>

<script type="text/javascript">
	$("#cemetery").click(function(){
		// valueの取得	
		var value = $("#cemetery").attr('value');
		
		var getWidth = $("#cemetery_list").attr('value');

		var width =(getWidth * value) + "px";
		
		$('#cemetery_list').css('width',width);
	});
</script>

<?php
/*
 * ポップアップの呼び出し
 * 'name' => 'ポップアップのファイル名'
 * 'size' => 'ポップアップのサイズ(big,normal,small)'
 * 'value' => 引き渡しデータ
 */ ?>
<?= View::forge('popup/wrap', array('name' => 'hand', 'size' => 'normal')); ?>
<?= View::forge('popup/wrap', array('name' => 'cemetery', 'size' => 'big', 'popup_data' => $cemeteryData)); ?>
<?= View::forge('popup/wrap', array('name' => 'exclusion', 'size' => 'small', 'popup_data' => $exclusionData)); ?>
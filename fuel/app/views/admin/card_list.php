<?php //CSS  ?>
<?= Asset::css("admin/screen_size_max.css"); ?>
<style type="text/css">
	#card_img {
		width: 100px;
	}
	.card_list {
		border-collapse: collapse;
	}
	.card_list td {
		border:1px #FFF solid;
		padding: 5px;
	}
</style>

<?php //カードリスト ?>
<table class="card_list">
	<?php foreach($card_mst as $card): ?>
		<tr>
			<td>
				<?= $card['id'] ?>
			</td>
			<td>
				<?= $card['name'] ?>
			</td>
			<td style="">
				<?= Asset::img( 'card/'.$card['id'].'.png',
						array('id'=>'card_img')
				) ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
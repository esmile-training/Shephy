<?php //CSS  ?>
<?= Asset::css("admin/screen_size_max.css"); ?>
<style type="text/css">
	#monster_img {
		width: 75px;
	}
	.monster_list {
		border-collapse: collapse;
	}
	.monster_list td {
		border:1px #FFF solid;
		padding: 5px;
	}
</style>

<?php //敵リスト ?>
<table class="monster_list">
	<?php foreach($monster_mst as $monster): ?>
		<tr>
			<td>
				<?= (int)($monster['id']/10) ?>
			</td>
			<td>
				<?= $monster['name'] ?>
			</td>
			<td style="">
				<?= Asset::img( 'monster/'.$monster['id'].'.png',
						array('id'=>'monster_img')
				) ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
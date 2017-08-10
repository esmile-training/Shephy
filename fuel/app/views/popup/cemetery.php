<style type="text/css">
	#scroll_bar{
		position: absolute;
		top: 0%;
		height: 95%;
		width: 100%;
		overflow-x:scroll;
	}
	#cemetery_card_img{
		position: absolute;
		height: 100%;
	}

</style>

<?php if($popup_data[0]!=""){?>
	<div id="scroll_bar">
		<table id="cemetery_list" style="position:absolute; height: 100%; width:350px;" value="350">
			<tr>
				<?php foreach ($popup_data as $imgId) {?>
					<td>
						<div style="width: 100%; height: 100%;">
							<?= Asset::img('card/'.$imgId.'.png',array('id'=>'cemetery_card_img')) ?>
						</div>
					</td>
				<?php }?>
			</tr>
		</table>
	</div>
<?php }?>
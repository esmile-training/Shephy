<?php //ログインフォーム ?>
<?= Form::open(array('action' => 'top/logIn', 'method' => 'post')); ?>
	<table>
		<tr>
			<td>UserName</td>
			<td>
				<?= Form::input('name',  '', array(	'style' => 'padding:3px;' )); ?>
			</td>
		</tr>
		<tr>
			<td>Password</td>
			<td>
				<?= Form::input('password', '', array( 'type'=>'password', 'style' => 'padding:3px;')); ?>
			</td>
		</tr>
	</table>
	<div>
		<?= Form::button(null, 'Log in', array('type' => 'submit', 'style' => 'padding: 2px;')); ?>
	</div>
<?=  Form::close(); ?>

<?php if($error_msg): ?>
	<div>
		<?= $error_msg ?>
	</div>
<?php endif; ?>



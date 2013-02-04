<h3><?=$poll->topic;?></h3>
<table class="table">
	<?php foreach ($poll->options->find_all() as $option): ?>
		<tr>
			<td><?=$option->name;?></td>
			<td><?=$option->votes;?></td>
			<td class="bar">
				<div class="filled" style="width:<?=$option->percent;?>%;"></div>
			</td>
			<td>
				<form method="POST">
					<input type="hidden" name="option" value="<?=$option->id;?>">
					<button class="btn btn-mini">Vote</button>
				</form>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<a class="btn btn-link" href="/polls">&lt; Back to polls</a>

<ul class="nav nav-tabs nav-stacked">
	<?php foreach($polls as $poll): ?>
		<li>
			<!-- This is how a link to a single poll will look like -->
			<a href="/polls/poll/<?=$poll->id;?>"><?=$poll->topic;?>
				<div class="muted"><?=$poll->total_votes; ?> Votes</div>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
<a class="btn btn-block" href="/polls/add"><i class="icon-plus"></i> Add a Poll</a>

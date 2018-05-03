
<?php
breadcrumb::create([
	['label'=> 'Dashboard', 'url' => site_url('/')],
	['label'=> 'My Task']
]);

?>

<div class="my-3 p-3 bg-white rounded box-shadow" id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
<a href="<?= site_url('/mytasks/create');?>" class="btn btn-info ajax-link">Create Task</a>
<div class="clearfix">&nbsp;</div>
<div class="">
	<table class="table table-striped table-bordered table-sm">
		<thead>
			<tr>
				<th>No</th>
				<th>Name</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($model as $row) { ?>
					<tr>
						<td>No</td>
						<td><?= $row->name ?></td>
					</tr>	
			<?php	}
			?>
		</tbody>
	</table>
</div>
</div>


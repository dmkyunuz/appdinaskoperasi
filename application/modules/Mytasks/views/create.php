
	<?php
	breadcrumb::create([
		['label'=> 'Dashboard', 'url' => site_url('/')],
		['label'=> 'My Tasks', 'url' => site_url('/mytasks')],
		['label'=> 'Create']
	]);

	?>
	<div class="my-3 p-3 bg-white rounded box-shadow">
	<div class="col-lg-6">
		<form class="" method="post" action="">
			<div class="form-group">
				<label class="label-control" for="title">Title</label>
				<input type="text" class="form-control" name="title" id="title" placeholder="" autocomplete="off" value="" autofocus >
				
			</div>
			<div class="form-group">
				<label class="label-control" for="description">Desctiption</label>
				<textarea class="form-control" name="description" id="description"></textarea>
				
			</div>
			
			<button class="btn btn-success" name="save">Save</button>
			<button class="btn btn-info" name="saveandnew">Save And New</button>
			<button class="btn btn-danger" type="reset" id="cancelBtn">Cancel</button>
		</form>
	</div>
</div>
<script type="text/javascript">
	var cancelBtn = $("#cancelBtn");

	cancelBtn.click(function(e){
		CreateHistory('<?= site_url('/mytasks') ?>', 'My Task');
      	loadPage('<?= site_url('/mytasks') ?>');
	});
</script>
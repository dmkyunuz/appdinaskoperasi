
<div class="container-fluid  animated fadeIn">
    
    
<div class="my-3 p-3 bg-white rounded box-shadow" id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
	 <?php
	breadcrumb::create([
		['label'=> 'Dashboard', 'url' => site_url('/')],
		['label'=> 'Bentuk Koperasi']
	]);

	?>
	<button type="button" class="btn btn-info" data-title="Tambah Bentuk Koperasi" data-toggle="modal" data-remote="<?= site_url('/bentuk-koperasi/create');?>" data-target="#form-modal">Create User</button>
	<div class="clearfix">&nbsp;</div>
		<table class="table table-striped table-bordered table-sm">
			<thead>
				<tr>
					<th>No</th>
					<th>ID</th>
					<th>Bentuk Koperasi</th>
					<th>Kepanjangan</th>
					<th width="80px">#</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no = 1;
					foreach ($model as $row) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $row->kd_bk; ?></td>
							<td><?= $row->nama_bk; ?></td>
							<td><?= $row->kepanjangan; ?></td>
							<td>
								<button class="btn btn-success btn-sm" data-title="Edit Bentuk Koperasi" data-toggle="modal" data-remote="<?= site_url('/bentuk-koperasi/update');?>" data-target="#form-modal"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></button>
							</td>
						</tr>
				<?php	}
				?>
			</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
function openModal(){
	var formModal = $("#form-modal");
	formModal.modal('show');
}
function closeModal(){
	var formModal = $("#form-modal");
	formModal.modal('hide');
}

$('body').on('click', '[data-toggle="modal"]', function(){

	$($(this).data("target")+' .modal-body').load($(this).data("remote"));
	$($(this).data("target")+' .modal-header h4').text($(this).data("title"));

});  

$("body").off('click', "#cancelBtn").on('click', "#cancelBtn", function(){
	closeModal();
});
</script>
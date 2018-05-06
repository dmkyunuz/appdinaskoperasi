
<div class="container-fluid  animated fadeIn">
    
    
<div class="my-3 p-3 bg-white rounded box-shadow" id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
	 <?php
	breadcrumb::create([
		['label'=> 'Dashboard', 'url' => site_url('/')],
		['label'=> 'Kecamatan']
	]);

	?>

	<?=  Web::GetAlert('message') ?>
	<button type="button" class="btn btn-info" data-title="Tambah Kecamatan" data-toggle="modal" data-remote="<?= site_url('/Kecamatan/create');?>" data-target="#form-modal"><i class="fa fa-plus"></i> &nbsp;Tambah Kecamatan</button>

	<a class="btn btn-success" href="<?= site_url('/kecamatan');?>" ><i class="fa fa-refresh"></i> &nbsp;Refresh</a>
	<div class="clearfix">&nbsp;</div>
		<table class="table table-striped table-bordered table-sm" id="dataTable">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Kecamatan</th>
					<th>Kecamatan</th>
					<th width="80px">#</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no = 1;
					foreach ($model as $row) { ?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $row->kd_kecamatan; ?></td>
							<td><?= $row->nama_kecamatan; ?></td>
							<td>
								<button class="btn btn-success btn-sm" data-title="Edit Kecamatan" data-toggle="modal" data-remote="<?= site_url('/kecamatan/update/'.$row->kd_kecamatan);?>" data-target="#form-modal"><i class="fa fa-edit"></i></button>
								<a href="<?= site_url('/kecamatan/delete/'.$row->kd_kecamatan);?>" class="btn btn-danger btn-sm"><i class="fa fa-remove"></i></a>
							</td>
						</tr>
				<?php	}
				?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTable').DataTable();
});

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
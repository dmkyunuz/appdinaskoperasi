
<div class="container-fluid  animated fadeIn">
    <div style="width:50%;  position: absolute; bottom: 60px; top: 60px; overflow-y: scroll" >

    </div>
    <div style="width:30%;  position: absolute; right: 0; bottom: 60px; top: 60px; overflow-y: scroll" >

    </div>
    <div>
    	
    </div>
<!-- <?php
breadcrumb::create([
	['label'=> 'Dashboard', 'url' => site_url('/')],
	['label'=> 'Users']
]);

?> -->
<!-- <div class="my-3 p-3 bg-white rounded box-shadow" id="p0" data-pjax-container="" data-pjax-push-state data-pjax-timeout="1000">
<button type="button" class="btn btn-info" data-title="Create User" data-toggle="modal" data-remote="<?= site_url('/users/create');?>" data-target="#form-modal">Create User</button>
<div class="clearfix">&nbsp;</div>
<div class="">
	<table class="table table-striped table-bordered table-sm">
		<thead>
			<tr>
				<th>No</th>
				<th>Name</th>
				<th>Sex</th>
				<th>Username</th>
				<th>Email</th>
				<th>Phone</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i = 1;
				foreach ($model as $row) { ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $row->first_name ." ". $row->last_name ?></td>
						<td><?= $row->sex ?></td>
						<td><?= $row->username ?></td>
						<td><?= $row->email ?></td>
						<td><?= $row->phone ?></td>
						
					</tr>	
			<?php $i++;	}
			?>
		</tbody>
	</table>
</div>
</div> -->
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
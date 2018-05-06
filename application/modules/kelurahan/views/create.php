<div class="">
<form class="" method="post" action="<?= site_url('/kelurahan/create'); ?>" id="form-kelurahan">
	<fieldset>
		<div class='row'>
			<div class='col-sm-12'>
				<label>Kode</label>
				<div class='form-group'>
					<input class="form-control required" id="kd_kelurahan" name="kd_kelurahan" type="text" autocomplete="off" placeholder="Kode" readonly value="<?= $kd_kelurahan; ?>">
					
				</div>
			</div>
			<div class='col-sm-12'>
				<label>Nama Kecamatan</label>
				<div class='form-group'>
					<select class="form-control js-example-basic-single required" name="kd_kec" id="kd_kec">
						<option value="">Select Kecamatan</option>
						<?php
							foreach ($kecamatan as $kec) { ?>
								<option value="<?= $kec->kd_kecamatan?>"><?= $kec->nama_kecamatan?></option>	
						<?php	}
						?>
					</select>
					
				</div>
			</div>
			<div class='col-sm-12'>
				<label>Nama Kelurahan</label>
				<div class='form-group'>
					<input class="form-control required" id="nama_kelurahan" name="nama_kelurahan" type="text" autocomplete="off" placeholder="Bentuk Koperasi" />
					
				</div>
			</div>
		</div>		
	</fieldset>
	<div class="pull-right">
		<button type="submit" class="btn btn-info">Save</button>
		<button type="reset" class="btn btn-danger" id="cancel-btn">Cancel</button>
	</div>
</form>
</div>
<script type="text/javascript">
	$(document).ready(function() {
	    $('.js-example-basic-single').select2();
	});
	var formBentukKoperasi = $("#form-kelurahan");
	var cancelBtn = $("#cancel-btn");
	cancelBtn.click(function(){
		closeModal();
	})
	$.validator.addMethod("accept", function(value, element, param) {
		value = $.trim(value);
	  return value.match(new RegExp("." + param + "$"));
	});
	$.validator.addMethod("lastname", function(value, element, param) {
	  return value.match(new RegExp("." + param + "$"));
	}, 'Please enter valid name');
	var bentukKoperasiValidator = formBentukKoperasi.validate({
		rules : {
			nama_kelurahan : {
				required : true,
				minlength : 1,
				remote : {
					url : "<?= site_url('/kelurahan/unique-check')?>",
					type : 'POST',
					data : { 
						nama_kelurahan : function(){
							return $("#nama_kelurahan").val();
						}
					},

				}
			},
			kepanjangan : {
			}
		},
		errorPlacement: function(error, element) {
		    error.appendTo(element.parent('div'));
		},
		highlight: function(element) {
		    $(element).parent().addClass('has-error');
		  },
		  unhighlight: function(element) {
		    $(element).parent().removeClass('has-error');
		  },
		messages : {
			nama_kelurahan : {
				remote : 'Data already exist'
			},
			kepanjangan : {

			}
		},
		submitHandler : function(form){
			saveBentukKoperasi();
			return false;
		}
	});

	function saveBentukKoperasi()
	{
		$.ajax({
			type : 'POST',
			dataType : 'JSON',
			data : formBentukKoperasi.serialize(),
			url : formBentukKoperasi.attr('action'),
			success : function (response){
				if(response.status == 'success'){
					closeModal();
					loadPage('<?= site_url('/kelurahan') ?>');
				}
			}
		})
	}

	
</script>
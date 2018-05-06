<div class="">
<form class="" method="post" action="<?= site_url('/kecamatan/create'); ?>" id="form-kecamatan">
	<fieldset>
		<div class='row'>
			<div class='col-sm-12'>
				<label>Kode</label>
				<div class='form-group'>
					<input class="form-control required" id="kd_kecamatan" name="kd_kecamatan" type="text" autocomplete="off" placeholder="Kode" readonly value="<?= $kd_kecamatan; ?>">
					
				</div>
			</div>
			<div class='col-sm-12'>
				<label>Bentuk Koperasi</label>
				<div class='form-group'>
					<input class="form-control required" id="nama_kecamatan" name="nama_kecamatan" type="text" autocomplete="off" placeholder="Bentuk Koperasi" />
					
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
	var formBentukKoperasi = $("#form-kecamatan");
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
			nama_kecamatan : {
				required : true,
				minlength : 1,
				remote : {
					url : "<?= site_url('/kecamatan/unique-check')?>",
					type : 'POST',
					data : { 
						nama_kecamatan : function(){
							return $("#nama_kecamatan").val();
						}
					},

				}
			},
			kepanjangan : {
			}
		},
		messages : {
			nama_kecamatan : {
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
					loadPage('<?= site_url('/kecamatan') ?>');
				}
			}
		})
	}

	
</script>
<div class="">
<form class="" method="post" action="<?= site_url('/bentuk-koperasi/create'); ?>" id="form-bentuk-koperasi">
	<fieldset>
		<div class='row'>
			<div class='col-sm-12'>
				<label>Kode</label>
				<div class='form-group'>
					<input class="form-control required" id="kd_bk" name="kd_bk" type="text" autocomplete="off" placeholder="Kode" readonly value="<?= $kode_bk; ?>">
					
				</div>
			</div>
			<div class='col-sm-12'>
				<label>Bentuk Koperasi</label>
				<div class='form-group'>
					<input class="form-control required" id="nama_bk" name="nama_bk" type="text" autocomplete="off" placeholder="Bentuk Koperasi" />
					
				</div>
			</div>
		</div>		
		<div class='row'>
			<div class='col-sm-12'>
				<label>Kepanjangan</label>    
				<div class='form-group'>
					<input class="form-control required" id="kepanjangan" name="kepanjangan" type="text" autocomplete="off" value=""  placeholder="Kepanjangan" />
					
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
	var formBentukKoperasi = $("#form-bentuk-koperasi");
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
			nama_bk : {
				required : true,
				minlength : 1,
				remote : {
					url : "<?= site_url('/bentuk-koperasi/unique-check')?>",
					type : 'POST',
					data : { 
						nama_bk : function(){
							return $("#nama_bk").val();
						}
					},

				}
			},
			kepanjangan : {
			}
		},
		messages : {
			nama_bk : {
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
					loadPage('<?= site_url('/bentuk-koperasi') ?>');
				}
			}
		})
	}

	
</script>
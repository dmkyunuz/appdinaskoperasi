
	<!-- <?php
	breadcrumb::create([
		['label'=> 'Dashboard', 'url' => site_url('/')],
		['label'=> 'Users', 'url' => site_url('/users')],
		['label'=> 'Create']
	]);

	?> -->
<div class="">
<form class="" method="post" action="<?= site_url('/users/create'); ?>" id="form-user">
	<fieldset>
		<div class='row'>
			<div class='col-sm-12'>    
				<div class='form-group'>
					<input class="form-control required" id="first_name" name="first_name" type="text" autocomplete="off" placeholder="First Name" />
					
				</div>
			</div>
		</div>		
		<div class='row'>
			<div class='col-sm-12'>    
				<div class='form-group'>
					<input class="form-control" id="last_name" name="last_name" type="text" autocomplete="off" value=""  placeholder="Last Name" />
					
				</div>
			</div>
		</div>	

		<div class='row'>
			<div class='col-sm-12'>    
				<div class='form-group'>
					<select name="sex" id="sex" class="form-control required">
						<?php
							$gender_array = ['' => 'Sex', 'M' => 'Male', 'F' => 'Female'];

							foreach ($gender_array as $value => $label) : ?>

								<option value="<?= $value; ?>" ><?= $label; ?></option>

						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>			
		<div class='row'>
			<div class='col-sm-12'>    
				<div class='form-group'>
					<input class="form-control required" id="email" name="email" type="email" autocomplete="off" value=""  placeholder="Email" />
				</div>
			</div>
		</div>				
		<div class='row'>
			<div class='col-sm-12'>    
				<div class='form-group'>
					<input class="form-control required" id="phone" name="phone" type="text" autocomplete="off" value=""  placeholder="Phone" />
					
				</div>
			</div>
		</div>		
		<div class='row'>
			<div class='col-sm-12'>    
				<div class='form-group'>
					<input class="form-control required" id="username" name="username" type="text" autocomplete="off" value=""  placeholder="Username" />
				</div>
			</div>
		</div>			
		<div class='row'>
			<div class='col-sm-12'>    
				<div class='form-group'>
					<input class="form-control required" id="password" name="password" type="password" autocomplete="off" value=""  placeholder="Password" />
				</div>
			</div>
		</div>		
		<div class='row'>
			<div class='col-sm-12'>    
				<div class='form-group'>
					<input class="form-control required" id="repeat_password" name="repeat_password" type="password" autocomplete="off" value=""  placeholder="Repeat Password" />
				</div>
			</div>
		</div>
	</fieldset>
	<div class="pull-right">
		<button type="submit" class="btn btn-info">Save</button>
		<button type="submit" class="btn btn-success">Save And New</button>
		<button type="reset" class="btn btn-danger" id="cancel-btn">Cancel</button>
	</div>
</form>
</div>
<script type="text/javascript">
	var formUser = $("#form-user");
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
	var userCreateValidator = formUser.validate({
		rules : {
			first_name : {
				required : true,
				accept: "[a-zA-Z0-9.]+",
				minlength : 1,
				maxlength : 70,
			},
			last_name : {
				maxlength : 70,
			},
			email : {
				email : true,
			},
			phone : {
				digits : true,
			},
			username : {
				required : true,
				minlength : 5,
				maxlength : 15,
			},
			password : {
				required : true,
				minlength : 5,
			},
			repeat_password : {
				required : true,
				equalTo : "#password",
			}
		},
		messages : {
			first_name : {
				required : 'Please enter first name',
				accept : 'Please enter valid name',
			},
			last_name : {
			}
		},
		submitHandler : function(form){
			saveUser();
			return false;
		}
	});

	function saveUser()
	{
		$.ajax({
			type : 'POST',
			dataType : 'JSON',
			data : formUser.serialize(),
			url : formUser.attr('action'),
			success : function (response){
				if(response.status == 'success'){
					closeModal();
					loadPage('<?= site_url('/users') ?>');
				}
			}
		})
	}

	
</script>
<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
		<form action="" id="manage-referrer">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
            <div class="col-md-6 border-right">
                <div class="form-group">
					<label for="" class="control-label">Name</label>
					<input type="text" class="form-control form-control-sm" name="fullname" value="<?php echo isset($fullname) ? $fullname : '' ?>">
				</div>
                <div class="form-group">
					<label for="" class="control-label">Phone Number</label>
					<input type="text" class="form-control form-control-sm" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
				</div>
                <div class="form-group">
					<label for="" class="control-label">Voucher Number</label>
					<input type="text" class="form-control form-control-sm" name="voucher" value="<?php echo isset($voucher) ? $voucher : '' ?>">
				</div>
                <div class="form-group">
					<label for="" class="control-label">Area Assigned</label>
					<select name="area" id="type" class="custom-select custom-select-sm">
                    <?php
                        foreach ($myareas as $areaselect) {
                            echo "<option value=$areaselect isset($area) && $area == $areaselect ? 'selected' : '' >$areaselect</option>";
                        }
                    ?>
					</select>
				</div>
                <?php if($_SESSION['login_type'] == 1): ?>
                <div class="form-group">
                    <label for="" class="control-label">User Role</label>
                    <select name="type" id="type" class="custom-select custom-select-sm">
                        <option value="2" <?php echo isset($type) && $type == 2 ? 'selected' : '' ?>>Referrer</option>
                        <option value="1" <?php echo isset($type) && $type == 1 ? 'selected' : '' ?>>Admin</option>
                    </select>
                </div>
                <?php else: ?>
                <input type="hidden" name="type" value="2">
                <?php endif; ?>
            </div>
            <div class="col-md-6">	
                <div class="form-group">
					<label for="" class="control-label">Registration ID</label>
					<input type="text" class="form-control form-control-sm" name="reg_id" required value="<?php echo isset($reg_id) ? $reg_id : '' ?>">
                    <small id="#msg"></small>
				</div>
                <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?>>
                    <small><i><?php echo isset($id) ? "Leave this blank if you don't want to change you password":'' ?></i></small>
                </div>
                <div class="form-group">
                    <label class="label control-label">Confirm Password</label>
                    <input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? 'required' : '' ?>>
                    <small id="pass_match" data-status=''></small>
                </div>
            </div>
            </form>
            </div>
        </div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-referrer">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=referrer_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
    $('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
	$('#manage-referrer').submit(function(e){
		e.preventDefault()
		start_load()
        $('#msg').html('')
		if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
			if($('#pass_match').attr('data-status') != 1){
				if($("[name='password']").val() !=''){
					$('[name="password"],[name="cpass"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}
		$.ajax({
			url:'ajax.php?action=save_referrer',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=referrer_list'
					},2000)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Registration ID already exists.</div>");
					$('[name="reg_id"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
</script>
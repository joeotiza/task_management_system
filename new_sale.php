<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-sale">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <input type="hidden" name="referrer_id" value="<?php echo isset($referrer_id) ? $referrer_id : $_SESSION['login_id'] ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Referee Phone Number</label>
					<input type="text" class="form-control form-control-sm" name="referee_phone" value="<?php echo isset($referee_phone) ? $referee_phone : '' ?>">
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Referee Name</label>
					<input type="text" class="form-control form-control-sm" name="referee_name" value="<?php echo isset($referee_name) ? $referee_name : '' ?>">
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
                    <label for="">Area</label>
					<select name="area" id="area" class="custom-select custom-select-sm">
                        <?php
                        foreach ($myareas as $areaselect) {
                            echo "<option value=$areaselect isset($area) && $area == $areaselect ? 'selected' : '' >$areaselect</option>";
                        }
                        ?>
					</select>
				</div>
			</div>
		</div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-sale">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=sale_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
	$('#manage-sale').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_sale',
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
						location.href = 'index.php?page=sale_list'
					},2000)
				}
			}
		})
	})
</script>
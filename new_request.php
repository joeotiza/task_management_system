<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="" id="manage-request">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Project</label>
					<input type="text" class="form-control form-control-sm" name="project_name" value="<?php echo isset($project_name) ? $project_name : '' ?>">
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Requested Delivery Date</label>
					<input type="text" class="form-control form-control-sm" name="delivery_date" value="<?php echo isset($delivery_date) ? $delivery_date : '' ?>">
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Motivation for Request</label>
					<input type="text" class="form-control form-control-sm" name="motivation" value="<?php echo isset($motivation) ? $motivation : '' ?>">
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Special Order Instructions (If Any)</label>
					<input type="text" class="form-control form-control-sm" name="instructions" value="<?php echo isset($instructions) ? $instructions : '' ?>">
				</div>
			</div>
          	<div class="col-md-6">
				<div class="form-group">
					<label for="">Status</label>
					<select name="status" id="status" class="custom-select custom-select-sm">
						<option value="Available" <?php echo isset($status) && $status == "Available" ? 'selected' : '' ?>>Available</option>
						<option value="Unavailable" <?php echo isset($status) && $status == "Unavailable" ? 'selected' : '' ?>>Unavailable</option>
						<option value="Discontinued" <?php echo isset($status) && $status == "Discontinued" ? 'selected' : '' ?>>Discontinued</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Price</label>
					<input type="text" class="form-control form-control-sm" name="price" value="<?php echo isset($price) ? $price : '' ?>">
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Items</label>
					<input type="text" class="form-control form-control-sm" name="items" value="<?php echo isset($items) ? $items : '' ?>">
				</div>
			</div>
		</div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" form="manage-request">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=request_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
	$('#manage-item').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_request',
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
						location.href = 'index.php?page=request_list'
					},2000)
				}
			}
		})
	})
</script>
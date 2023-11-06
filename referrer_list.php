<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_referrer"><i class="fa fa-plus"></i> Add New Referrer</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Name</th>
						<th>Mobile Number</th>
						<th>Registration ID</th>
						<th>Area assigned</th>
                        <th>Voucher</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					// $type = array('',"Admin","Project Manager","Employee");
					$qry = $conn->query("SELECT * FROM referrer order by `fullname` asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?php echo $i++ ?></th>
						<td><?php echo ucwords($row['fullname']) ?></td>
						<td><?php echo $row['phone'] ?></td>
						<td><b><?php echo $row['reg_id'] ?></b></td>
						<td><?php echo $row['area'] ?></td>
                        <td><?php echo $row['voucher'] ?></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu">
		                      <a class="dropdown-item view_referrer" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_referrer&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_referrer" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
		$('.view_referrer').click(function(){
			uni_modal("<i class='fa fa-id-card'></i> Referrer Details","view_referrer.php?id="+$(this).attr('data-id'))
		})
		$('.delete_referrer').click(function(){
			_conf("Are you sure to delete this Referrer?","delete_referrer",[$(this).attr('data-id')])
		})
	})
	function delete_referrer($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_referrer',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
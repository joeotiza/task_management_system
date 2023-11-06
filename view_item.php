<?php
include 'db_connect.php';
$stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
$qry = $conn->query("SELECT * FROM items where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
// $tprog = $conn->query("SELECT * FROM task_list where project_id = {$id}")->num_rows;
// $cprog = $conn->query("SELECT * FROM task_list where project_id = {$id} and status = 3")->num_rows;
// $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
// $prog = $prog > 0 ?  number_format($prog,2) : $prog;
// $prod = $conn->query("SELECT * FROM user_productivity where project_id = {$id}")->num_rows;
// if($status == 0 && strtotime(date('Y-m-d')) >= strtotime($start_date)):
// if($prod  > 0  || $cprog > 0)
//   $status = 2;
// else
//   $status = 1;
// elseif($status == 0 && strtotime(date('Y-m-d')) > strtotime($end_date)):
// $status = 4;
// endif;
// $manager = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where id = $manager_id");
// $manager = $manager->num_rows > 0 ? $manager->fetch_array() : array();
?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-md-12">
			<div class="callout callout-info">
				<div class="col-md-12">
					<div class="row">
						<div class="col-sm-6">
							<dl>
								<dt><b class="border-bottom border-primary">Item</b></dt>
								<dd><?php echo ucwords($name) ?></dd>
								<dt><b class="border-bottom border-primary">Description</b></dt>
								<dd><?php echo html_entity_decode($description) ?></dd>
							</dl>
						</div>
						<div class="col-md-6">
							<dl>
								<dt><b class="border-bottom border-primary">Price</b></dt>
								<dd><?php echo($price) ?></dd>
							</dl>
							<dl>
								<dt><b class="border-bottom border-primary">Status</b></dt>
								<dd><?php echo($status) ?></dd>
							</dl>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

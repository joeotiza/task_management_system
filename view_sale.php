<?php
include 'db_connect.php';
$stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
$qry = $conn->query("SELECT `sales`.`id` as `id`, `referrer`.`reg_id`, `referrer`.`voucher`,
`referrer`.`fullname` as `referrer_name`, `sales`.`referee_phone`, `referrer`.`phone`,
`sales`.`referee_name`, `referrer`.`area` as `area`,
`sales`.`area` as `area1`, `sales`.`date`
FROM `sales`
LEFT JOIN `referrer`
ON `referrer`.`id`=`sales`.`referrer_id` where `sales`.`id` = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-md-12">
			<div class="callout callout-info">
				<div class="col-md-12">
					<div class="row">
						<div class="col-sm-6">
							<dl>
                                <dt><b class="border-bottom border-primary">Referrer Registration ID</b></dt>
								<dd><?php echo ($reg_id) ?></dd>
								<dt><b class="border-bottom border-primary">Referrer Name</b></dt>
								<dd><?php echo ucwords($referrer_name) ?></dd>
                                <dt><b class="border-bottom border-primary">Referrer's Voucher Number</b></dt>
								<dd><?php echo ($voucher) ?></dd>
								<dt><b class="border-bottom border-primary">Referrer Area</b></dt>
								<dd><?php echo ($area) ?></dd>
                                <dt><b class="border-bottom border-primary">Referrer's Phone Number</b></dt>
								<dd><?php echo ($phone) ?></dd>
							</dl>
						</div>
						<div class="col-md-6">
							<dl>
                                <dt><b class="border-bottom border-primary">Referee's Name</b></dt>
								<dd><?php echo($referee_name) ?></dd>
                                <dt><b class="border-bottom border-primary">Referee's Phone Number</b></dt>
								<dd><?php echo($referee_phone) ?></dd>
								<dt><b class="border-bottom border-primary">Referee's Area</b></dt>
								<dd><?php echo($area1) ?></dd>
							</dl>
							<dl>
								<dt><b class="border-bottom border-primary">Date Recorded</b></dt>
								<dd><?php echo($date) ?></dd>
							</dl>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

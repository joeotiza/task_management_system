<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
            <button class="btn btn-flat btn-sm bg-gradient-success btn-success" id="print"><i class="fa fa-print"></i> Print</button>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_sale"><i class="fa fa-plus"></i> Make New Sale</a>
			</div>
		</div>
		<div class="card-body">
            <div class="table-responsive" id="printable">
                <table class="table tabe-hover table-condensed" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                        <col width="20%">
                        <col width="20%">
                        <col width="15%">
                        <col width="5%">
                        <col width="10%">
                        <col width="5%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Referrer Registration ID</th>
                            <th>Referrer Voucher Number</th>
                            <th>Name of Referrer</th>
                            <th>Name of Referee</th>
                            <th>Referee Phone Number</th>
                            <th>Area</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        // $stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
                        // $where = "";
                        if($_SESSION['login_type'] == 2){
                            $where = " WHERE `referrer`.`id` = '{$_SESSION['login_id']}' ";
                        }elseif($_SESSION['login_type'] == 1){
                            $where = "";
                        }
                        $qry = $conn->query("SELECT `sales`.`id` as `id`, `referrer`.`reg_id`, `referrer`.`voucher`,
                        `referrer`.`fullname` as `referrer_name`, `sales`.`referee_phone`,
                        `sales`.`referee_name`, `referrer`.`area` as `area`,
                        `sales`.`area` as `area1`, `sales`.`date`
                        FROM `sales`
                        LEFT JOIN `referrer`
                        ON `referrer`.`id`=`sales`.`referrer_id` ".$where." order by `date` desc");
                        while($row= $qry->fetch_assoc()):
                            // $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                            // unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                            // $desc = strtr(html_entity_decode($row['description']),$trans);
                            // $desc=str_replace(array("<li>","</li>"), array("",", "), $desc);

                            // $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows;
                            // $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows;
                            // $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
                            // $prog = $prog > 0 ?  number_format($prog,2) : $prog;
                            // $prod = $conn->query("SELECT * FROM user_productivity where project_id = {$row['id']}")->num_rows;
                            // if($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
                            // if($prod  > 0  || $cprog > 0)
                            //   $row['status'] = 2;
                            // else
                            //   $row['status'] = 1;
                            // elseif($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])):
                            // $row['status'] = 4;
                            // endif;
                        ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><b><?php echo ($row['reg_id']) ?></b></td>
                            <td><b><?php echo ($row['voucher']) ?></b></td>
                            <td><?php echo ucwords($row['referrer_name']) ?></td>
                            <td><?php echo ucwords($row['referee_name']) ?></td>
                            <td><?php echo ($row['referee_phone']) ?></td>
                            <td><?php echo ($row['area1']) ?></td>
                            <td><?php echo ($row['date']) ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Action
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item view_sale" href="./index.php?page=view_sale&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">View</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="./index.php?page=edit_sale&id=<?php echo $row['id'] ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_sale" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                                </div>
                            </td>
                        </tr>	
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
		</div>
	</div>
</div>
<style>
	table p{
		margin: unset !important;
	}
	table td{
		vertical-align: middle !important
	}
</style>
<script>
    $('#print').click(function(){
		start_load()
		var _h = $('head').clone()
		var _p = $('#printable').clone()
		var _d = "<p class='text-center'><b>Sales Report as of (<?php echo date("F d, Y") ?>)</b></p>"
		_p.prepend(_d)
		_p.prepend(_h)
		var nw = window.open("","","width=900,height=600")
		nw.document.write(_p.html())
		nw.document.close()
		nw.print()
		setTimeout(function(){
			nw.close()
			end_load()
		},750)
	})
	$(document).ready(function(){
		$('#list').dataTable()
        $('.delete_sale').click(function(){
	        _conf("Are you sure to delete this sale?","delete_sale",[$(this).attr('data-id')])
	    })
	})
    function delete_sale($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_sale',
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
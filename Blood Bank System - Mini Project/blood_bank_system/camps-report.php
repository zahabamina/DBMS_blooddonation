<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM camps, city, state, country WHERE city_id = camps_city AND state_id = camps_state AND camps_country = country_id";
	$rs=mysql_query($SQL) or die(mysql_error());
	global $SERVER_PATH;
?>
<script>
function delete_camps(camps_id)
{
	if(confirm("Do you want to delete the camps?"))
	{
		this.document.frm_camps.camps_id.value=camps_id;
		this.document.frm_camps.act.value="delete_camps";
		this.document.frm_camps.submit();
	}
}
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
		<div class="contact">
				<h4 class="heading colr">Camps Reports</h4>
			<form name="frm_camps" action="lib/camps.php" method="post">
				<div class="static">
					<table style="width:100%">
					  <tbody>
					  <tr class="tablehead bold">
						<td scope="col">Sr. No.</td>
						<td scope="col">Name</td>
						<td scope="col">Mobile</td>
						<td scope="col">City</td>
						<td scope="col">State</td>
						<td scope="col">Country</td>
						<td scope="col">Action</td>
					  </tr>
					<?php 
					$sr_no=1;
					while($data = mysql_fetch_assoc($rs))
					{
					?>
					  <tr>
						<td style="text-align:center; font-weight:bold;"><?=$sr_no++?></td>
						<td><?=$data[camps_name]?></td>
						<td><?=$data[camps_mobile]?></td>
						<td><?=$data[city_name]?></td>
						<td><?=$data[state_name]?></td>
						<td><?=$data[country_name]?></td>
						<td style="text-align:center"><a href="camps.php?camps_id=<?php echo $data[camps_id] ?>">Edit</a> | <a href="Javascript:delete_camps(<?=$data[camps_id]?>)">Delete</a> </td>
					  </tr>
					<?php } ?>
					</tbody>
					</table>
				</div>
				<input type="hidden" name="act" />
				<input type="hidden" name="camps_id" />
			</form>
		</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 

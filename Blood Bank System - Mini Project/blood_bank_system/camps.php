<?php 
	include_once("includes/header.php"); 
	if($_REQUEST[camps_id])
	{
		$SQL="SELECT * FROM camps WHERE camps_id = $_REQUEST[camps_id]";
		$rs=mysql_query($SQL) or die(mysql_error());
		$data=mysql_fetch_assoc($rs);
	}
?> 
<script>

jQuery(function() {
	jQuery( "#camps_dob" ).datepicker({
	  changeMonth: true,
	  changeYear: true,
	   yearRange: "-65:-10",
	   dateFormat: 'd MM,yy'
	});
	jQuery('#frm_camps').validate({
		rules: {
			camps_confirm_password: {
				equalTo: '#camps_password'
			}
		}
	});
});
function validateForm(obj) {
	if(validateEmail(obj.camps_email.value))
		return true;
	jQuery('#error-msg').show();
	return false;
}
</script>
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1">
			<div class="contact">
				<h4 class="heading colr">Donation Camps Registration</h4>
				<?php
				if($_REQUEST['msg']) { 
				?>
				<div class="msg"><?=$_REQUEST['msg']?></div>
				<?php
				}
				?>
				<div class="msg" style="display:none" id="error-msg">Enter valid EmailID !!!</div>
				<form action="lib/camps.php" enctype="multipart/form-data" method="post" name="frm_camps" onsubmit="return validateForm(this)">
					<ul class="forms">
						<li class="txt">Camp Name</li>
						<li class="inputfield"><input name="camps_name" type="text" class="bar" required value="<?=$data[camps_name]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Contact</li>
						<li class="inputfield"><input name="camps_mobile" type="text" class="bar" required value="<?=$data[camps_mobile]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Address Line 1</li>
						<li class="inputfield"><input name="camps_add1" type="text" class="bar" required value="<?=$data[camps_add1]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">Address Line 2</li>
						<li class="inputfield"><input name="camps_add2" type="text" class="bar" required value="<?=$data[camps_add2]?>"/></li>
					</ul>
					<ul class="forms">
						<li class="txt">City</li>
						<li class="inputfield">
							<select name="camps_city" class="bar" required/>
								<?php echo get_new_optionlist("city","city_id","city_name",$data[camps_city]); ?>
							</select>
						</li>
					</ul>
					<ul class="forms">
						<li class="txt">State</li>
						<li class="inputfield">
							<select name="camps_state" class="bar" required/>
								<?php echo get_new_optionlist("state","state_id","state_name",$data[camps_state]); ?>
							</select>
						</li>
					</ul>
					<ul class="forms">
						<li class="txt">Country</li>
						<li class="inputfield">
							<select name="camps_country" class="bar" required/>
								<?php echo get_new_optionlist("country","country_id","country_name",$data[camps_country]); ?>
							</select>
						</li>
					</ul>
					<div class="clear"></div>
					<ul class="forms">
						<li class="txt">&nbsp;</li>
						<li class="textfield"><input type="submit" value="Submit" class="simplebtn"></li>
						<li class="textfield"><input type="reset" value="Reset" class="resetbtn"></li>
					</ul>
					<input type="hidden" name="act" value="save_camps">
					<input type="hidden" name="avail_image" value="<?=$data[camps_image]?>">
					<input type="hidden" name="camps_id" value="<?=$data[camps_id]?>">
				</form>
			</div>
		</div>
		<div class="col2">
			<?php if($_REQUEST[camps_id]) { ?>
			<div class="contactfinder">
				<h4 class="heading colr">Profile of <?=$data['camps_name']?></h4>
				<div><img src="<?=$SERVER_PATH.'uploads/'.$data[camps_image]?>" style="width: 250px"></div><br>
			</div> 
			<?php } ?>
		</div>
		<div class="col2">
			<?php include_once("includes/sidebar.php"); ?> 
		</div>
	</div>
<?php
	if($_SESSION['camps_details']['camps_level_id'] != 1)
	{
?>
	<script>
		jQuery( "#camps_level_id" ).val(3);
		jQuery( "#camps_level" ).hide();
	</script>
<?php		
	}
?>
<?php include_once("includes/footer.php"); ?> 

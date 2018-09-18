<?php
	session_start();
	include_once("../includes/db_connect.php");
	include_once("../includes/functions.php");
	if($_REQUEST[act]=="save_camps")
	{
		save_camps();
		exit;
	}
	if($_REQUEST[act]=="delete_camps")
	{
		delete_camps();
		exit;
	}
	if($_REQUEST[act]=="get_report")
	{
		get_report();
		exit;
	}
	###Code for save camps#####
	function save_camps()
	{
		$R=$_REQUEST;
		/////////////////////////////////////
		$image_name = $_FILES[camps_image][name];
		$location = $_FILES[camps_image][tmp_name];
		if($image_name!="")
		{
			move_uploaded_file($location,"../uploads/".$image_name);
		}
		else
		{
			$image_name = $R[avail_image];
		}
		//die;
		if($R[camps_id])
		{
			$statement = "UPDATE `camps` SET";
			$cond = "WHERE `camps_id` = '$R[camps_id]'";
			$msg = "Data Updated Successfully.";
			$condQuery = "";
		}
		else
		{
			$statement = "INSERT INTO `camps` SET";
			$cond = "";
			$msg="Data saved successfully.";
		}
		$SQL=   $statement." 
				`camps_name` = '$R[camps_name]', 
				`camps_add1` = '$R[camps_add1]', 
				`camps_add2` = '$R[camps_add2]', 
				`camps_city` = '$R[camps_city]', 
				`camps_state` = '$R[camps_state]', 
				`camps_country` = '$R[camps_country]', 
				`camps_mobile` = '$R[camps_mobile]'". 
				 $cond;
		$rs = mysql_query($SQL) or die(mysql_error());
		if($_SESSION['login']!=1)
		{
			header("Location:../camps.php?msg=You are registered successfully.");
			exit;
		}
		header("Location:../camps-report.php?msg=$msg");
	}
#########Function for delete camps##########3
function delete_camps()
{
	$SQL="SELECT * FROM camps WHERE camps_id = $_REQUEST[camps_id]";
	$rs=mysql_query($SQL);
	$data=mysql_fetch_assoc($rs);
	
	/////////Delete the record//////////
	$SQL="DELETE FROM camps WHERE camps_id = $_REQUEST[camps_id]";
	mysql_query($SQL) or die(mysql_error());
	
	//////////Delete the image///////////
	if($data[camps_image])
	{
		unlink("../uploads/".$data[camps_image]);
	}
	header("Location:../camps-report.php?msg=Deleted Successfully.");
}
?>

<script type='text/javascript'>
function validation()
{
var a=form1.txtcat.value;
	var re = /^[a-z,A-Z]+$/i;
	if(form1.txtcat.value=="")
	{
		alert("Please Enter Category");
		form1.txtcat.focus();
		return false;
	}
	else
	{
		if(!re.test(form1.txtcat.value))
		{
			alert("Dont use special character or number in Name Field");
			form1.txtcat.focus();
			return false;
		}
		
	}
}
</script>
<?php
session_start();
include("admin_header.php");
include("conn.php");
if(isset($_POST['btninsert']))
{
	$cat1=$_POST['txtcat'];
	$res=mysql_query("select max(cat_id) from job_category");
	$cid=0;
	while($r=mysql_fetch_row($res))
	{
		$cid=$r[0];
	}
	$cid++;
	
	mysql_query("insert into job_category(`cat_id`,`cat_name`)values('$cid','$cat1')") or die("insertion failed");
	$message="Record Inserted Succesfull";
	echo"<script type='text/javascript'>";
	echo "alert('$message');";
	echo "window.location.href='admin_cat.php';";
	echo"</script>";
}

if(isset($_REQUEST['upid']))
{
	$cid1=$_REQUEST['upid'];
	$res1=mysql_query("select * from job_category where cat_id='$cid1'");
	$r1=mysql_fetch_row($res1);
	$cat1=$r1[1];
	
}


if(isset($_POST['btnclear']))
{
	header('Location: admin_cat.php');
}

if(isset($_POST['btnupdate']))
{
	$cid1=$_POST['txtcid'];
	$cat1=$_POST['txtcat'];
	
	mysql_query("update job_category set cat_name='$cat1' where cat_id='$cid1'")or die("update Failed");
	$message="Record Updated Succesfull";
	echo"<script type='text/javascript'>";
	echo "alert('$message');";
	echo "window.location.href='admin_cat.php';";
	echo"</script>";
}

if(isset($_REQUEST['did']))
{
	$cid2=$_REQUEST['did'];
	mysql_query("delete from job_category where cat_id='$cid2'");
	$message="Record Deleted";
	echo"<script type='text/javascript'>";
	echo "alert('$message');";
	echo "window.location.href='admin_cat.php';";
	echo"</script>";
}
?>
<div id="body">
  <div class="blog1">
    <h1>Manage Category</h1>
    <div>
      
		<form name="form1" method="post" id="form1" >
		<table width="500px" height="250px">
			<?php
			if(isset($_REQUEST['upid']))
			{
			?>
			<tr>
				<td>Category Id:</td>
				<td><input type="text" name="txtcid" readonly="readonly" value="<?php echo $cid1; ?>"></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td>Category Name:</td>
				<td><input type="text" name="txtcat" value="<?php echo $cat1; ?>"></td>
			</tr>
		
			<tr>
				<td colspan="2">
				<?php
				if(!isset($_REQUEST['upid']))
				{
				?>
					<input type="submit" name="btninsert" value="INSERT" style="width:80px; height:30px" onclick="return validation()" />
				<?php
				}else{
				?>
				<input type="submit" name="btnupdate" value="UPDATE" style="width:80px; height:30px" />
				<?php
				}
				?>
				<input type="submit" name="btnclear" value="CLEAR" style="width:80px; height:30px" /></td>
				
			</tr>
			
		</table>
		</form>
    </div>
    <ul>
    <br/>
   <?php
	$qur=mysql_query("select * from job_category");
	echo "<table border='1' width='480px'>
	<thead>
		<tr>
			<th>CATEGORY ID</th>
			<th>CATEGORY NAME</th>
			<th>UPDATE</th>
			<th>DELETE</th>
		</tr>
	</thead>";
	while($q=mysql_fetch_row($qur))
	{
		echo "<tr>";
		echo "<td>$q[0]</td>";
		echo "<td>$q[1]</td>";
		echo "<td><a href='admin_cat.php?upid=$q[0]'><img src='images/edit.ico' width='36px' height='36px'></a></td>";
		echo "<td><a href='admin_cat.php?did=$q[0]'><img src='images/delete.png'></a></td>";
		echo "</tr>";
	}
	echo "</table>";
   ?>
    </ul>
  </div>
</div>

<?php
include("footer.php");
?>
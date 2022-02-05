<script type='text/javascript'>
function validation()
{
var a=form1.txtscat.value;
	var re = /^[a-z,A-Z ]+$/i;
	if(form1.txtscat.value=="")
	{
		alert("Please Enter Category");
		form1.txtscat.focus();
		return false;
	}
	else
	{
		if(!re.test(form1.txtscat.value))
		{
			alert("Dont use special character or number in Name Field");
			form1.txtscat.focus();
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
	$catid=$_POST['selcat'];
	$scat=$_POST['txtscat'];
	$res=mysql_query("select max(sub_cat_id) from job_sub_cat");
	$scid=0;
	while($r=mysql_fetch_row($res))
	{
		$scid=$r[0];
	}
	$scid++;
	
	mysql_query("insert into job_sub_cat(`sub_cat_id`,`cat_id`,`sub_cat`)values('$scid','$catid','$scat')") or die("insertion failed");
	$message="Record Inserted Succesfull";
	echo"<script type='text/javascript'>";
	echo "alert('$message');";
	echo "window.location.href='admin_sub_cat.php';";
	echo"</script>";
}

if(isset($_REQUEST['upid']))
{
	$scid1=$_REQUEST['upid'];
	$res1=mysql_query("select * from job_sub_cat where sub_cat_id='$scid1'");
	$r1=mysql_fetch_row($res1);
	$cid1=$r1[1];
	$scat1=$r1[2];
	
}


if(isset($_POST['btnclear']))
{
	header('Location: admin_sub_cat.php');
}

if(isset($_POST['btnupdate']))
{
	$scid1=$_POST['txtscid'];
	$cid2=$_POST['selcat'];
	$scat1=$_POST['txtscat'];
	
	mysql_query("update job_sub_cat set cat_id='$cid2',sub_cat='$scat1' where sub_cat_id='$scid1'")or die("update Failed");
	$message="Record Updated Succesfull";
	echo"<script type='text/javascript'>";
	echo "alert('$message');";
	echo "window.location.href='admin_sub_cat.php';";
	echo"</script>";
}

if(isset($_REQUEST['did']))
{
	$scid2=$_REQUEST['did'];
	mysql_query("delete from job_sub_cat where sub_cat_id='$scid2'");
	$message="Record Deleted";
	echo"<script type='text/javascript'>";
	echo "alert('$message');";
	echo "window.location.href='admin_sub_cat.php';";
	echo"</script>";
}
?>
<div id="body">
  <div class="blog1">
    <h1>Manage Sub Category</h1>
    <div>
      
		<form name="form1" method="post" id="form1">
		<table width="500px" height="250px">
			<?php
			if(isset($_REQUEST['upid']))
			{
			?>
			<tr>
				<td>Sub Category Id:</td>
				<td><input type="text" name="txtscid" readonly="readonly" value="<?php echo $scid1; ?>"></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td>Select Category</td>
				<td><select id="selcat" name="selcat">
				<option value="0">--Select Category--</option>
				<?php
				$temp=mysql_query("select * from job_category");
				while($t=mysql_fetch_row($temp))
				{?>
					<option value="<?php echo $t[0]; ?>" <?php if($cid1==$t[0]) { echo "selected='selected'"; } ?>><?php echo $t[1];?></option>
				<?php
				}
				
				?>	
				</select>
				</td>
			</tr>
			<tr>
				<td>Sub Category Name:</td>
				<td><input type="text" name="txtscat" value="<?php echo $scat1; ?>"></td>
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
	$qur=mysql_query("select * from job_sub_cat");
	$pgsize=5;
	$total=mysql_num_rows($qur);
	$tot_page=ceil($total/$pgsize);
	$cpgno=1;
	if(isset($_REQUEST['pno']))
	{
		$cpgno=$_REQUEST['pno'];
	}
	$stops=($cpgno-1) * $pgsize;
	$qur1=mysql_query("select * from job_sub_cat limit $stops,$pgsize");
	echo "<table border='1' width='480px'>
	<thead>
		<tr>
			<th>SUB CATEGORY ID</th>
			<th>CATEGORY NAME</th>
			<th>SUB CATEGORY NAME</th>
			<th>UPDATE</th>
			<th>DELETE</th>
		</tr>
	</thead>";
	while($q=mysql_fetch_row($qur1))
	{
		echo "<tr>";
		echo "<td>$q[0]</td>";
		//echo "<td>$q[1]</td>";
		$temp2=mysql_query("select cat_name from job_category where cat_id='$q[1]'");
		$t2=mysql_fetch_row($temp2);
		echo "<td>$t2[0]</td>";
		echo "<td>$q[2]</td>";
		echo "<td><a href='admin_sub_cat.php?upid=$q[0]'><img src='images/edit.ico' width='36px' height='36px'></a></td>";
		echo "<td><a href='admin_sub_cat.php?did=$q[0]'><img src='images/delete.png'></a></td>";
		echo "</tr>";
	}
	echo "</table>";
	
	for($i=1;$i<=$tot_page;$i++)
	{
		echo "<a href=admin_sub_cat.php?pno=$i>$i</a>&nbsp;&nbsp;";
	}
   ?>
    </ul>
  </div>
</div>

<?php
include("footer.php");
?>
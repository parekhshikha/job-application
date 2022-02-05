<script type='text/javascript'>
function validation()
{
	if(form1.selcat.value=="0")
	{
		alert("Please Select Sub Category");
		form1.selcat.focus();
		return false;
	}
	
	var a=form1.txtjname.value;
	var re = /^[a-z,A-Z ]+$/i;
	if(form1.txtjname.value=="")
	{
		alert("Please Enter Job Name");
		form1.txtjname.focus();
		return false;
	}
	else
	{
		if(!re.test(form1.txtjname.value))
		{
			alert("Dont use special character or number in Job Name Field");
			form1.txtjname.focus();
			return false;
		}
		
	}
	
	var a=form1.txtcity.value;
	var re = /^[a-z,A-Z ]+$/i;
	if(form1.txtcity.value=="")
	{
		alert("Please Enter City");
		form1.txtcity.focus();
		return false;
	}
	else
	{
		if(!re.test(form1.txtcity.value))
		{
			alert("Dont use special character or number in City Field");
			form1.txtcity.focus();
			return false;
		}
		
	}
	
	
	if(form1.txtdesc.value=="")
	{
		alert("Please Enter Job Description");
		form1.txtdesc.focus();
		return false;
	}
}
</script>
<?php
session_start();
include("emp_header.php");
include("conn.php");
$email=$_SESSION['cmpemail'];
$temp=mysql_query("select * from company_regis where email_id='$email'");
$t=mysql_fetch_row($temp);
$compid=$t[0];
if(isset($_POST['btninsert']))
{
	$catid=$_POST['selcat'];
	$name=$_POST['txtjname'];
	$city=$_POST['txtcity'];
	$desc=$_POST['txtdesc'];
	$pack=$_POST['txtpack'];
	$res=mysql_query("select max(job_id) from job_detail");
	$jid=0;
	while($r=mysql_fetch_row($res))
	{
		$jid=$r[0];
	}
	$jid++;
	$query="insert into job_detail(`job_id`,`job_name`,`sub_cat_id`,`city`,`company_id`,`job_description`,`salary`)values('$jid','$name','$catid','$city','$compid','$desc','$pack')";
	mysql_query("insert into job_detail(`job_id`,`job_name`,`sub_cat_id`,`city`,`company_id`,`job_description`,`salary`)values('$jid','$name','$catid','$city','$compid','$desc','$pack')") or die("insertion failed $query");
	$message="Record Inserted Succesfull";
	echo"<script type='text/javascript'>";
	echo "alert('$message ');";
	echo "window.location.href='emp_manage_jobs.php';";
	echo"</script>";
}

if(isset($_REQUEST['upid']))
{
	$jid1=$_REQUEST['upid'];
	$res1=mysql_query("select * from job_detail where job_id='$jid1'");
	$r1=mysql_fetch_row($res1);
	$jname=$r1[1];
	$cid1=$r1[2];
	$city=$r1[3];
	$desc1=$r1[5];
	$pack=$r1[6];
}


if(isset($_POST['btnclear']))
{
	header('Location: emp_manage_jobs.php');
}

if(isset($_POST['btnupdate']))
{
	$jid1=$_REQUEST['upid'];
	$catid=$_POST['selcat'];
	$name=$_POST['txtjname'];
	$city=$_POST['txtcity'];
	$desc=$_POST['txtdesc'];
	$pack=$_POST['txtpack'];
	mysql_query("update job_detail set sub_cat_id='$catid',job_name='$name',city='$city',job_description='$desc',salary='$pack' where job_id='$jid1'")or die("update Failed");
	$message="Record Updated Succesfull";
	echo"<script type='text/javascript'>";
	echo "alert('$message');";
	echo "window.location.href='emp_manage_jobs.php';";
	echo"</script>";
}

if(isset($_REQUEST['did']))
{
	$jid2=$_REQUEST['did'];
	mysql_query("delete from job_detail where job_id='$jid2'");
	$message="Record Deleted";
	echo"<script type='text/javascript'>";
	echo "alert('$message');";
	echo "window.location.href='emp_manage_jobs.php';";
	echo"</script>";
}
?>
<div id="body">
  <div class="blog1">
    <h1>Manage Job Detail</h1>
    <div>
      
		<form name="form1" method="post" id="form1">
		<table width="500px" height="250px">
			<?php
			if(isset($_REQUEST['upid']))
			{
			?>
			<tr>
				<td>Job Id:</td>
				<td><input type="text" name="txtjid" readonly="readonly" value="<?php echo $jid1; ?>"></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td>Select Sub Category</td>
				<td><select id="selcat" name="selcat">
				<option value="0">--Select Sub Category--</option>
				<?php
				$temp=mysql_query("select * from job_sub_cat");
				while($t=mysql_fetch_row($temp))
				{?>
					<option value="<?php echo $t[0]; ?>" <?php if($cid1==$t[0]) { echo "selected='selected'"; } ?>><?php echo $t[2];?></option>
				<?php
				}
				
				?>	
				</select>
				</td>
			</tr>
			<tr>
				<td>Job Name:</td>
				<td><input type="text" name="txtjname" value="<?php echo $jname; ?>" style="width:220px;"></td>
			</tr>
			<tr>
				<td>Job City:</td>
				<td><input type="text" name="txtcity" value="<?php echo $city; ?>" style="width:220px;"></td>
			</tr>
			<tr>
				<td>Job Description:</td>
				<td><textarea name="txtdesc" rows="5" cols="25"><?php echo $desc1; ?></textarea></td>
			</tr>
			<tr>
				<td>Annual Package:</td>
				<td><input type="text" name="txtpack" value="<?php echo $pack; ?>" style="width:220px;"></td>
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
		 <?php
	$qur=mysql_query("select * from job_detail where company_id='$compid'");
	$pgsize=5;
	$total=mysql_num_rows($qur);
	$tot_page=ceil($total/$pgsize);
	$cpgno=1;
	if(isset($_REQUEST['pno']))
	{
		$cpgno=$_REQUEST['pno'];
	}
	$stops=($cpgno-1) * $pgsize;
	$qur1=mysql_query("select * from job_detail where company_id='$compid' limit $stops,$pgsize");
	echo "<table border='1' width='900px'>
	<thead>
		<tr>
			<th>JOB ID</th>
			<th>JOB NAME</th>
			<th>SUB CATEGORY NAME</th>
			<th>CITY</th>
			<th>COMPANY NAME</th>
			<th>JOB DESCRIPTION</th>
			<th>UPDATE</th>
			<th>DELETE</th>
		</tr>
	</thead>";
	while($q=mysql_fetch_row($qur1))
	{
		echo "<tr>";
		echo "<td>$q[0]</td>";
		echo "<td>$q[1]</td>";
		$temp2=mysql_query("select sub_cat from job_sub_cat where sub_cat_id='$q[2]'");
		$t2=mysql_fetch_row($temp2);
		echo "<td>$t2[0]</td>";
		//echo "<td>$q[2]</td>";
		echo "<td>$q[3]</td>";
		//echo "<td>$q[4]</td>";
		$temp3=mysql_query("select company_name from company_regis where company_id='$q[4]'");
		$t3=mysql_fetch_row($temp3);
		echo "<td>$t3[0]</td>";
		echo "<td>$q[5]</td>";
		echo "<td><a href='emp_manage_jobs.php?upid=$q[0]'><img src='images/edit.ico' width='36px' height='36px'></a></td>";
		echo "<td><a href='emp_manage_jobs.php?did=$q[0]'><img src='images/delete.png'></a></td>";
		echo "</tr>";
	}
	echo "</table>";
	
	for($i=1;$i<=$tot_page;$i++)
	{
		echo "<a href=emp_manage_jobs.php?pno=$i>$i</a>&nbsp;&nbsp;";
	}
   ?>
    </div>
    <ul>
    <br/>
  
    </ul>
	 
  </div>
 
</div>

<?php
include("footer.php");
?>
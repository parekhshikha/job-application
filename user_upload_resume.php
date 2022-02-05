<?php
session_start();
include("user_header.php");
include("conn.php");
$email=$_SESSION['usremail'];
$res=mysql_query("select * from user_regis where email_id='$email'");
$r=mysql_fetch_row($res);
$fname=$r[0];
if(isset($_POST['btnsubmit']))
{
	$tmpname=$_FILES['resume']['tmp_name'];
	$apath="bio/".rand().".jpg";
	if($_FILES['resume']['size']>0)
	{
		move_uploaded_file($tmpname,$apath);
		$res1=mysql_query("select * from resume_master where email_id='$email'");
		if(mysql_num_rows($res1)>0)
		{
			$r1=mysql_fetch_row($res1);
			mysql_query("update resume_master set resume_path='$apath' where resume_id='$r1[0]'");
			$message1="Resume Uploaded Succesfully";
			echo"<script type='text/javascript'>";
			echo "alert('$message1');";
			echo "window.location.href='user_upload_resume.php'";
			echo "</script>";
		}else{
			$res2=mysql_query("select max(resume_id) from resume_master");
			$rid=0;
			while($r2=mysql_fetch_row($res2))
			{
				$rid=$r2[0];
			}
			$rid++;
			
			mysql_query("insert into resume_master(`resume_id`,`email_id`,`resume_path`)values('$rid','$email','$apath')");
			$message1="Resume Uploaded Succesfully";
			echo"<script type='text/javascript'>";
			echo "alert('$message1');";
			echo "window.location.href='user_upload_resume.php'";
			echo "</script>";
		}
	}
}

?>
<div id="body">
  <div class="blog">
    <h1>Upload Your Resume</h1>
    <div>
      
		<form name="form1" method="post" enctype="multipart/form-data">
		<table width="500px" height="250px" >
			<tr>
				<td>Upload Your Resume</td>
				<td><input type="file" name="resume"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="btnsubmit" value="SUBMIT" /></td>
			</tr>
			
		</table>
		</form>
    </div>
   
  
      <?php
		$qur2=mysql_query("select * from resume_master");
		if(mysql_num_rows($qur2)>0)
		{
			echo "<table border=1' width='250'>
			<thead>
			<tr>
				<th scope='col' class='rounded-company'>Resume ID</th>
				<th scope='col' class='rounded'>Resume Name</th>
				<th scope='col' class='rounded'>DOWNLOAD</th>	
			</tr>
			</thead>";
			while($q2=mysql_fetch_row($qur2))
			{
				echo "<tr>";
				echo "<td>$q2[0]</td>";
				echo "<td>$q2[2]</td>";
				echo "<td><a href='$q2[2]'>DOWNLOAD</a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
	  ?>
	  <br/>
	  <br/>
	  <br/>
   
  </div>
</div>

<?php
include("footer.php");
?>
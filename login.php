<?php
session_start();
include("header.php");
include("conn.php");


if(isset($_POST['btnlogin']))
{
	
	$email=$_POST['txtemail'];
	$pwd=$_POST['txtpwd'];
	$user=$_POST['seluser'];
	$res1=mysql_query("select * from admin_login where user_id='$email' and pwd='$pwd'");
	if(mysql_num_rows($res1)>0)
	{
		$_SESSION['user']=$email;
		$message="Admin Login Succesfull";
		echo"<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href='admin_cat.php';";
		echo"</script>";
	}else{
		if($user=="1")
		{
			$res=mysql_query("select * from user_regis where email_id='$email' and pwd='$pwd'");
			if(mysql_num_rows($res)>0)
			{
				
				$_SESSION['usremail']=$email;
				
				if(isset($_GET['jid']))
				{
					$jid=$_GET['jid'];
					$temp=mysql_query("select * from apply where email_id='$email' and job_id='$jid'");
					if(mysql_num_rows($temp)>0)
					{
						$message="Already Applied for this Job";
						echo"<script type='text/javascript'>";
						echo "alert('$message');";
						echo "window.location.href='jobs.php'";
						echo"</script>";
					}else{
						$temp1=mysql_query("select max(apply_id) from apply");
						$aid=0;
						while($t1=mysql_fetch_row($temp1))
						{
							$aid=$t1[0];
						}
						$aid++;
						$date1=date('Y-m-d');
						mysql_query("insert into apply(`apply_id`,`email_id`,`job_id`,`apply_date`)values('$aid','$email','$jid','$date1')") or die("failed");
						$message="Applied Successfull";
						echo"<script type='text/javascript'>";
						echo "alert('$message');";
						echo "window.location.href='jobs.php'";
						echo"</script>";
					}
				}
				else{
					$message="User Login Succesfull";
					echo"<script type='text/javascript'>";
					echo "alert('$message');";
					echo "window.location.href='jobs.php'";
					echo"</script>";
				}
				
			}else{
				$message="Check email Id and pwd";
				echo"<script type='text/javascript'>";
				echo "alert('$message');";
				echo"</script>";
			}
		}else if($user=="2")
		{
			$res=mysql_query("select * from company_regis where email_id='$email' and pwd='$pwd'");
			if(mysql_num_rows($res)>0)
			{
				$_SESSION['cmpemail']=$email;
				$message="Company Login Succesfull";
				echo"<script type='text/javascript'>";
				echo "alert('$message');";
				echo "window.location.href='emp_manage_jobs.php';";
				echo"</script>";
			}else{
				$message="Check email Id and pwd";
				echo"<script type='text/javascript'>";
				echo "alert('$message');";
				echo"</script>";
			}
		}else{
			$message="Please Select USER";
			echo"<script type='text/javascript'>";
			echo "alert('$message');";
			echo"</script>";
		}
	}
}
?>
<div id="body">
  <div class="blog">
    <h1>Login</h1>
    <div>
      
		<form name="form1" method="post" >
		<table width="500px" height="250px">
			<tr>
				<td>Email Id:</td>
				<td><input type="text" name="txtemail"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="txtpwd"></td>
			</tr>
			<tr>
				<td>Select User:</td>
				<td><select name="seluser">
				<option value="0">--Select User--</option>
				<option value="1">User</option>
				<option value="2">Company</option>
				</select></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="btnlogin" value="LOGIN" /></td>
				
			</tr>
			<tr>
				<td colspan="2"><a href="selectregis.php">SIGN UP</a></td>
				
			</tr>
		</table>
		</form>
    </div>
    <ul>
  
      <img src="images/abt2.jpg" />
	  <br/>
	  <br/>
	  <br/>
    </ul>
  </div>
</div>

<?php
include("footer.php");
?>
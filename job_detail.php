<?php
session_start();
if(!isset($_SESSION['usremail']))
{
include("header.php");
}else{
include("user_header.php");
}

include("conn.php");
$email=$_SESSION['usremail'];

if(isset($_REQUEST['jid']))
{
	$jid=$_REQUEST['jid'];
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
?>
<div id="body">
  <div class="blog">
    <h1>Search Your Job</h1>
    <div>
      <h2>Job Detail</h2>
      <?php
	  
		$scid=$_GET['scid'];
	  
		$res=mysql_query("select * from job_detail where sub_cat_id='$scid'");
		echo "<ul1>";
		
		while($r=mysql_fetch_row($res))
		{
			
			$res1=mysql_query("select company_name from company_regis where company_id='$r[4]'");
			$r1=mysql_fetch_row($res1);
			if(isset($_SESSION['usremail']))
			{
				echo "<li><b>$r[1]<br/>Company Name:</b><font size='+1'>$r1[0]</font>
			<br/><b>City: </b>$r[3]<br/>
			<b>Salary Per Annum:</b>Rs. $r[6] /-<br/>
			<b>Description:</b>$r[5]<br/>
			<div align='right'><a href='job_detail.php?jid=$r[0]'><img src='images/apply1.png' Height='50px' Width='150px'></a>
			</div>
			</li>";
			}else{
			echo "<li><b>$r[1]<br/>Company Name:</b><font size='+1'>$r1[0]</font>
			<br/><b>City: </b>$r[3]<br/>
			<b>Salary Per Annum:</b>Rs. $r[6] /-<br/>
			<b>Description:</b>$r[5]<br/>
			<div align='right'><a href='login.php?jid=$r[0]'><img src='images/apply1.png' Height='50px' Width='150px'></a>
			</div>
			</li>";
			}
		}
		
		echo "</ul1>";
	  ?>
        
       
    </div>
   
    <ul>
	
	
     <img src="images/search1.jpg" width="230px" height="250px">
	 
    </ul>
  </div>
 
</div>
<?php
include("footer.php");
?>

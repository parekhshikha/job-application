<?php
session_start();
include("admin_header.php");
include("conn.php");

?>
<div id="body">
  <div class="blog1">
    <h1>Company Wise Job Detail</h1>
     <div>
		<form name="form1" method="post" id="form1" >
		<br/>
		   <?php
	  
	  $jid=$_GET['jid'];
	  $res1=mysql_query("select * from job_detail where job_id='$jid'");
	  $r1=mysql_fetch_row($res1);
	  echo "<h2>$r1[1]</h2><br/>";
	  $res=mysql_query("select j.job_name,a.apply_date,u.full_name,u.address,u.city,u.state,u.mob_no,u.email_id,r.resume_path from apply a,job_detail j,user_regis u,resume_master r where a.job_id='$jid' and a.job_id=j.job_id and a.email_id=u.email_id and u.email_id=r.email_id");
	if(mysql_num_rows($res)>0)
	{
		
		echo "<table border='1' width='800px' >
		<thead>
			<tr>
				
				<th>FULL NAME</th>
				<th>ADDRESS</th>
				<th>CITY</th>
				<th>STATE</th>
				<th>MOBILE NO</th>
				<th>EMAIL ID</th>
				<th>APPLY DATE</th>
				<th>DOWNLOAD RESUME</th>
			</tr>
		</thead>";
		while($r=mysql_fetch_row($res))
		{
			echo "<tr>";
			
			
			echo "<td>$r[2]</td>";
			echo "<td>$r[3]</td>";
			echo "<td>$r[4]</td>";
			echo "<td>$r[5]</td>";
			echo "<td>$r[6]</td>";
			echo "<td>$r[7]</td>";
			echo "<td>$r[1]</td>";
			echo "<td><a href='$r[8]'>Download Resume</a></td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	  ?>
   </div>
		</form>
   
  </div>
</div>

<?php
include("footer.php");
?>
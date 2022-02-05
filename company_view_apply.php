<?php
session_start();

include("emp_header.php");

include("conn.php");
$email=$_SESSION['cmpemail'];
$temp=mysql_query("select * from company_regis where email_id='$email'");
$t=mysql_fetch_row($temp);
$compid=$t[0];
?>
<div id="body">
  <div class="blog">
    <h1>Apply Detail</h1>
    <div>
      <br/><br/><br/>
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
			<th>View Apply Detail</th>
			
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
		echo "<td><a href='company_view_applied.php?jid=$q[0]'>View Applied Detail</a></td>";
		
		echo "</tr>";
	}
	echo "</table>";
	
	for($i=1;$i<=$tot_page;$i++)
	{
		echo "<a href=emp_manage_jobs.php?pno=$i>$i</a>&nbsp;&nbsp;";
	}
   ?>
        <br/><br/><br/>
       
    </div>
   
   
  </div>
 
</div>
<?php
include("footer.php");
?>

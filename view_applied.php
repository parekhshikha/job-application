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
?>
<div id="body">
  <div class="blog">
    <h1>Apply Detail</h1>
    <div>
      <br/><br/><br/>
      <?php
	  $res=mysql_query("select a.apply_id,j.job_name,c.company_name,j.job_description,j.salary,a.apply_date from apply a,job_detail j,company_regis c where a.email_id='$email' and a.job_id=j.job_id and j.company_id=c.company_id order by a.apply_id desc");
	if(mysql_num_rows($res)>0)
	{
		echo "<table border='1' width='800px' >
		<thead>
			<tr>
				<th>APPLY ID</th>
				<th>JOB NAME</th>
				<th>COMPANY NAME</th>
				<th>DESCRIPTION</th>
				<th>SALARY</th>
				<th>APPLY DATE</th>
			</tr>
		</thead>";
		while($r=mysql_fetch_row($res))
		{
			echo "<tr>";
			echo "<td>$r[0]</td>";
			echo "<td>$r[1]</td>";
			echo "<td>$r[2]</td>";
			echo "<td>$r[3]</td>";
			echo "<td>$r[4]</td>";
			echo "<td>$r[5]</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	  ?>
        <br/><br/><br/>
       
    </div>
   
   
  </div>
 
</div>
<?php
include("footer.php");
?>

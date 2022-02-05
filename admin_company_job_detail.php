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
	$qur=mysql_query("select * from company_regis");
	echo "<table border='1' width='880px'>
	<thead>
		<tr>
			<th>COMPANY ID</th>
			<th>COMPANY NAME</th>
			<th>ADDRESS</th>
			<th>CITY</th>
			<th>STATE</th>
			<th>MOBILE NO</th>
			<th>EMAIL ID</th>
			
			<th>VIEW UPLOAD JOBS</th>
		</tr>
	</thead>";
	while($q=mysql_fetch_row($qur))
	{
		echo "<tr>";
		echo "<td>$q[0]</td>";
		echo "<td>$q[1]</td>";
		echo "<td>$q[2]</td>";
		echo "<td>$q[3]</td>";
		echo "<td>$q[4]</td>";
		echo "<td>$q[5]</td>";
		echo "<td>$q[6]</td>";
		echo "<td><a href='admin_view_jobs.php?cid=$q[0]'>VIEW UPLOAD JOBS</a></td>";
		

		echo "</tr>";
	}
	echo "</table>";
   ?>
   </div>
		</form>
   
  </div>
</div>

<?php
include("footer.php");
?>
<?php
session_start();
include("admin_header.php");
include("conn.php");

?>
<div id="body">
  <div class="blog1">
    <h1>User Detail</h1>
     <div>
		<form name="form1" method="post" id="form1" >
		<br/><br/><br/><br/>
		   <?php
	  
	 
	 
	  $res=mysql_query("select * from user_regis");
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
			
			echo "<td>$r[7]</td>";
			
			
			echo "</tr>";
		}
		echo "</table>";
	}
	  ?><br/><br/><br/><br/>
   </div>
		</form>
   
  </div>
</div>

<?php
include("footer.php");
?>
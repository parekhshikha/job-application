
<?php
session_start();
include("admin_header.php");
include("conn.php");

?>
<div id="body">
  <div class="blog">
    <h1>Reports</h1>
    <div>
    
		<form name="form1" method="post" id="form1" >
		<table width="500px" height="250px">
			<tr>
				<td><a href="admin_company_job_detail.php">Company Wise Job Detail</a></td>
			</tr>
			<tr>
				<td><a href="admin_apply_job_detail.php">User Applied Job Detail</a></td>
			</tr>
			<tr>
				<td><a href="admin_regis_user.php">Registered User</a></td>
			</tr>
			
		</table>
		</form>
    </div>
    <ul>
    <br/>
   
    </ul>
  </div>
</div>

<?php
include("footer.php");
?>
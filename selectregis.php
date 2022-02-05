<?php
session_start();
include("header.php");
include("conn.php");



?>
<div id="body">
  <div class="blog">
    <h1>Select Registration Type</h1>
    <div>
      
		<form name="form1" method="post" >
		<table width="500px" height="250px">
			<tr>
				<td><a href="company_regis.php">Company Registration</a></td>
			</tr>
			<tr>
				<td><a href="regis.php">User Registration</a></td>
			</tr>
			
		</table>
		</form>
    </div>
    <ul>
    <br/>
    <br/>
      <img src="images/abt2.jpg" />
    </ul>
  </div>
</div>

<?php
include("footer.php");
?>
<?php
session_start();
if(!isset($_SESSION['usremail']))
{
include("header.php");
}else{
include("user_header.php");
}
include("conn.php");
?>
<div id="body">
  <div class="blog">
    <h1>Search Your Job</h1>
    <div>
      <h2>Job Category</h2>
      <?php
	  $res=mysql_query("select * from job_category");
	  echo "<ul>";
	  while($r=mysql_fetch_row($res))
	  {
		echo "<li><b><a href='jobs.php?cid=$r[0]'>$r[1]</a></b></li>";
		
		if((isset($_REQUEST['cid'])) && ($_REQUEST['cid']==$r[0]))
		{
			$cid=$_GET['cid'];
			$res1=mysql_query("select * from job_sub_cat where cat_id='$cid'");
			echo "<ul>";
			while($r1=mysql_fetch_row($res1))
			{
				echo "<li><a href='job_detail.php?cid=$r[0]&scid=$r1[0]'>$r1[2]</a></li>";
			}
			echo "</ul>";
		}
	  }
	  echo "</ul>";
	  ?>
        
       
    </div>
   
    <ul>
	
	
     <img src="images/search1.jpg" width="300px" height="250px">
	 
    </ul>
  </div>
 
</div>
<?php
include("footer.php");
?>

<script type='text/javascript'>
function validation()
{
	var a=form1.txtname.value;
	var re = /^[a-z,A-Z ]+$/i;
	if(form1.txtname.value=="")
	{
		alert("Please Enter Name");
		form1.txtname.focus();
		return false;
	}
	else
	{
		if(!re.test(form1.txtname.value))
		{
			alert("Dont use special character or number in Name Field");
			form1.txtname.focus();
			return false;
		}
		
	}
	
	if(form1.txtadd.value=="")
	{
		alert("plz enter address first");
		form1.txtadd.focus();
		return false;
	}
	
	a=form1.txtcity.value;
	var re = /^[a-z,A-Z ]+$/i;
	if(form1.txtcity.value=="")
	{
		alert("plz enter value in city");
		form1.txtcity.focus();
		return false;
	}
	else
	{
		if(!re.test(form1.txtcity.value))
		{
			alert("Dont use special character or number in city");
			form1.txtcity.focus();
			return false;
		}
		
		
	}
	
	a=form1.txtstate.value;
	var re = /^[a-z,A-Z ]+$/i;
	if(form1.txtstate.value=="")
	{
		alert("plz enter value in state");
		form1.txtstate.focus();
		return false;
	}
	else
	{
		if(!re.test(form1.txtstate.value))
		{
			alert("Dont use special character or number in state");
			form1.txtstate.focus();
			return false;
		}
		
	}
	
	a=form1.txtmobno.value;
	if(form1.txtmobno.value=="")
	{
		alert("plz enter a value in phone");
		form1.txtmobno.focus();
		return false;
	}
	else if(a.length!=10)
	{
		alert("plz enter phone number 10 character long");
		form1.txtmobno.focus();
		return false;
	}
	else
	{
		for(i=0;i<=a.length-1;i++)
		{
			if(isNaN(a.charAt(i)))
			{
				alert("dont use character in phone number");
				return false;
				break;
			}
		}
	}
	
	a=form1.txtemail.value;
	if(form1.txtemail.value=="")
	{
		alert("plz enter email id");
		form1.txtemail.focus();
		return false;
	}
	else if(a.indexOf("@",0)==-1)
	{
		alert("Enter valid email id");
		form1.txtemail.focus();
		return false;
	}else if(a.indexOf(".",0)==-1)
	{
		alert("enter valid emailid");
		form1.txtemail.focus();
		return false;
	}
	
	var b=form1.txtpwd.value;
	if(form1.txtpwd.value=="")
	{
		alert("Please enter password");
		form1.txtpwd.focus();
		return false;
	}
	else if(b.length<6)
	{
		alert("Please enter more than 6 characters");
		form1.txtpwd.focus();
		return false;
	}
	else if(b.length>10)
	{
		alert("Please enter less than 10 characters");
		form1.txtpwd.focus();
		return false;
	}
	
	var d=form1.txtcpwd.value;
	var e=form1.txtpwd.value;
	if(d!=e)
	{
		alert("your Confirm password is not match with password");
		form1.txtcpwd.value="";
		form1.txtcpwd.focus();
		return false;
	}
	
}
</script>
<?php
session_start();
include("header.php");
include("conn.php");

if(isset($_POST['btnregis']))
{
	$name=$_POST['txtname'];
	$add=$_POST['txtadd'];
	$city=$_POST['txtcity'];
	$state=$_POST['txtstate'];
	$mno=$_POST['txtmobno'];
	$email=$_POST['txtemail'];
	$pwd=$_POST['txtpwd'];
	$date1=date('Y-m-d');
	$res=mysql_query("select * from company_regis where email_id='$email'");
	if(mysql_num_rows($res)>0)
	{
		$message="Email Id Already Exists";
		echo"<script type='text/javascript'>";
		echo "alert('$message');";
		echo"</script>";
	}else{
		$res1=mysql_query("select max(company_id) from company_regis");
		$cid=0;
		while($r1=mysql_fetch_row($res1))
		{
			$cid=$r1[0];
		}
		$cid++;
		mysql_query("insert into company_regis(`company_id`,`company_name`,`address`,`city`,`state`,`mobile_no`,`email_id`,`pwd`,`regis_date`)values('$cid','$name','$add','$city','$state','$mno','$email','$pwd','$date1')") or die("Registration Failed");
		$message="Registered";
		echo"<script type='text/javascript'>";
		echo "alert('$message');";
		echo "window.location.href='login.php';";
		echo"</script>";
		
	}
	
}

?>
<div id="body">
  <div class="blog">
    <h1>Company Registration</h1>
    <div>
      <p></p>
		<form name="form1" method="post" >
		<table width="500px" height="350px">
			<tr>
				<td>Company Name:</td>
				<td><input type="text" name="txtname"></td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><textarea name="txtadd" cols="16"></textarea></td>
				
			</tr>
			<tr>
				<td>City:</td>
				<td><input type="text" name="txtcity"></td>
			</tr>
			<tr>
				<td>State:</td>
				<td><input type="text" name="txtstate"></td>
			</tr>
			<tr>
				<td>Mobile No:</td>
				<td><input type="text" name="txtmobno"></td>
			</tr>
			<tr>
				<td>Email ID:</td>
				<td><input type="text" name="txtemail" class="emaillower"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="txtpwd"></td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td><input type="password" name="txtcpwd"></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="btnregis" value="REGISTER" onclick="return validation()"/></td>
				
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
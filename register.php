<?php
ob_start();
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php require_once('connections/Project01.php'); ?>
<?php
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "register.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Recordset3 = 10;
$pageNum_Recordset3 = 0;
if (isset($_GET['pageNum_Recordset3'])) {
  $pageNum_Recordset3 = $_GET['pageNum_Recordset3'];
}
$startRow_Recordset3 = $pageNum_Recordset3 * $maxRows_Recordset3;

mysql_select_db($database_Project01, $Project01);
$query_Recordset3 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl, linkinfo.linkType, linkinfo.linkSource, linkinfo.linkDate FROM linkinfo WHERE linkinfo.linkType = 1 ORDER BY linkinfo.linkDate DESC";
$query_limit_Recordset3 = sprintf("%s LIMIT %d, %d", $query_Recordset3, $startRow_Recordset3, $maxRows_Recordset3);
$Recordset3 = mysql_query($query_limit_Recordset3, $Project01) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);

if (isset($_GET['totalRows_Recordset3'])) {
  $totalRows_Recordset3 = $_GET['totalRows_Recordset3'];
} else {
  $all_Recordset3 = mysql_query($query_Recordset3);
  $totalRows_Recordset3 = mysql_num_rows($all_Recordset3);
}
$totalPages_Recordset3 = ceil($totalRows_Recordset3/$maxRows_Recordset3)-1;
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="register.php?variable=1";
  $loginUsername = $_POST['userName'];
  $LoginRS__query = sprintf("SELECT userName FROM userinfo WHERE userName=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_Project01, $Project01);
  $LoginRS=mysql_query($LoginRS__query, $Project01) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO userinfo (userName, userPass, firstName, lastName, emailAddress, country) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['userName'], "text"),
                       GetSQLValueString($_POST['userPass'], "text"),
                       GetSQLValueString($_POST['firstName'], "text"),
                       GetSQLValueString($_POST['lastName'], "text"),
                       GetSQLValueString($_POST['emailAddress'], "text"),
                       GetSQLValueString($_POST['country'], "text"));

  mysql_select_db($database_Project01, $Project01);
  $Result1 = mysql_query($insertSQL, $Project01) or die(mysql_error());

  $insertGoTo = "members.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_Project01, $Project01);
$query_Recordset1 = "SELECT iso, printable_name FROM countryinfo ORDER BY name ASC";
$Recordset1 = mysql_query($query_Recordset1, $Project01) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_Project01, $Project01);
$query_Recordset2 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl FROM linkinfo WHERE linkinfo.linkType = 0";
$Recordset2 = mysql_query($query_Recordset2, $Project01) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Your description goes here" />
    <meta name="keywords" content="your,keywords,goes,here" />
    <meta name="author" content="Your Name" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen,projection" />
    <link rel="shortcut icon" href="images/siteicon.ico" type="image/x-icon" />
    <title>kraftwerk@home</title>
    <script type="text/javascript">
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
    </script>
    </head>

    <body onsubmit="MM_validateForm('userName','','R','userPass','','R','firstName','','R','lastName','','R','emailAddress','','NisEmail');return document.MM_returnValue">
<div id="wrap">
      <div id="header"> <img id="frontphoto" src="images/Home/front.jpg" width="960" height="75" alt="binary code banner" /> </div>
      <div id="leftside">
    <h2 class="hide">Menu:</h2>
    <ul class="avmenu">
          <li><a href="index.php">Home</a></li>
          <li><a href="discography.php">Discography</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="media.php">Media</a></li>
          <li><a href="admin/admin.php">Admin</a></li>
        </ul>
    <div class="links">
          <h3>Links:</h3>
          <ul>
        <?php do { ?>
          <li><a href="<?php echo $row_Recordset2['linkUrl']; ?>"><?php echo $row_Recordset2['linkHeader']; ?></a></li>
          <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
      </ul>
        </div>
		   <p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
  		</p>
         <p>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img style="border:0;width:88px;height:31px"
            src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" />
    </a>
	</p>
  </div>
  	  <div id="rightside">
	<div class="announce">
         <?php
			if(isset($_SESSION['MM_Username'])){
		?>
        <h2>Signed In:</h2>
        <p>Welcome <strong><?php echo $_SESSION['MM_Username']?></strong>, you may now access our audio or admin pages.<br />	<a href="<?php echo $logoutAction ?>">Log out</a></p>
        <?php } else { ?>
<h2>Sign In:</h2>
     <p><a href="members.php">Sign in</a> or <a href="register.php">register</a> as a member to access our audio page.</p>
	<? } ?>

      </div>
		<div class="announce">
			<h2>News:</h2>
			<?php do { ?>
			    <p><strong><?php echo $row_Recordset3['linkDate']; ?> </strong><?php echo $row_Recordset3['linkHeader']; ?> <a href="<?php echo $row_Recordset3['linkUrl']; ?>"><?php echo $row_Recordset3['linkSource']; ?></a></p>
			    <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
            
			
		</div>
	
		
  </div>
      <div id="content">
    <hr />
    <h2 align="center">Sign-Up Page</h2>
    <hr />
    <div class="register">
          <?php
  		if(isset($_GET["variable"]))
		{
	  	 if($_GET["variable"]=1)
		 {
			echo "<strong>Username Already Taken. Try Again!</strong>"; 
		 }
		}
	?>
          <form action="<?php echo $editFormAction; ?>" method="post" id="form1" onsubmit="MM_validateForm('userName','','R','userPass','','R','firstName','','R','lastName','','R','emailAddress','','RisEmail');return document.MM_returnValue">
        <table>
              <tr valign="baseline">
            <td align="right">Username:</td>
            <td><input name="userName" type="text" id="userName" value="" size="32" /></td>
          </tr>
              <tr valign="baseline">
            <td align="right">Password:</td>
            <td><input name="userPass" type="password" id="userPass" value="" size="32" /></td>
          </tr>
              <tr valign="baseline">
            <td align="right">First Name:</td>
            <td><input name="firstName" type="text" id="firstName" value="" size="32" /></td>
          </tr>
              <tr valign="baseline">
            <td align="right">Last Name:</td>
            <td><input name="lastName" type="text" id="lastName" value="" size="32" /></td>
          </tr>
              <tr valign="baseline">
            <td align="right">Email Address:</td>
            <td><input name="emailAddress" type="text" id="emailAddress" value="" size="32" /></td>
          </tr>
              <tr valign="baseline">
            <td align="right">Country:</td>
            <td><select name="country">
                <?php 
do {  
?>
                <option value="<?php echo $row_Recordset1['printable_name']?>" <?php if (!(strcmp($row_Recordset1['printable_name'], $row_Recordset1['printable_name']))) {echo "SELECTED";} ?>><?php echo $row_Recordset1['printable_name']?></option>
                <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
?>
              </select></td>
          </tr>
              <tr> </tr>
              <tr valign="baseline">
            <td align="right">&nbsp;</td>
            <td><input type="submit" value="Join" /></td>
          </tr>
            </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
        </div>
    <hr />
    <h3> Please log-on after registering to enjoy our playlist </h3>
    <hr />
  </div>
    </div>
<div id="footer">
      <p>&copy; 2012 James Coll - Munnki Productions</span><br />
    Designed using Php | MySQL | jquery | Lightbox </p>
    </div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

ob_end_flush();
?>

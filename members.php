<?php
ob_start();
if (!isset($_SESSION)) {
  session_start();
}
//blah
?>
<?php require_once('connections/Project01.php'); ?>
<?php
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

mysql_select_db($database_Project01, $Project01);
$query_Recordset2 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl FROM linkinfo WHERE linkinfo.linkType = 0";
$Recordset2 = mysql_query($query_Recordset2, $Project01) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

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
?>
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
	
  $logoutGoTo = "members.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "userLevel";
  $MM_redirectLoginSuccess = "index.php?success=1";
  $MM_redirectLoginFailed = "members.php?failed=1";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Project01, $Project01);
  	
  $LoginRS__query=sprintf("SELECT userName, userPass, userLevel FROM userinfo WHERE userName=%s AND userPass=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $Project01) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'userLevel');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
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

</head>

<body>
<div id="wrap">

	<div id="header">
		
		<img id="frontphoto" src="images/Home/front.jpg" width="960" height="75" alt="binary code banner" />
		
			
	</div>

	

	<div id="leftside">
		<h2 class="hide">Menu:</h2>

		<ul class="avmenu">
			<li><a href="index.php">Home</a></li>
			<li><a href="discography.php">Discography</a></li>
			<li><a href="gallery.php">Gallery</a></li>
			<li><a href="media.php">Audio</a></li>
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
       <h2>Please Sign In:</h2>
       <hr />
		<?php 
			if(isset($_GET['failed']))
			{
				if ($_GET['failed']==1)
				{
					echo "<div class=\"loginmessage\">Please login with a valid username and password.</div>";
				}
				else if ($_GET['failed']==2)
				{
					echo "<div class=\"loginmessage\">Access to this page is denied to non-administrative users.</div>";
				}
			}
		?>
    <div id="loginarea">
    	
        
<form id="form1" method="post" action="<?php echo $loginFormAction; ?>">
		  <p>
		    <label for="username">Enter Username</label>
		    <input type="text" name="username" id="username" />
          </p>
          <p>
            <label for="password">Enter Password</label>
		  	<input type="password" name="password" id="password" />
          </p>
          <p>
          
            <input type="submit" name="login" id="login" value="Login" />
		  </p>
	  </form>
        
<h5><a href="register.php">Register</a></h5>
		</div>
    
  </div>	
	<div id="footer">
		
		<p>&copy; 2012 James Coll - Munnki Productions<br />
		Designed using Php | MySQL | jquery | Lightbox </p>
	</div>

</div>

</body>
</html>

<?php
mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
ob_end_flush();
?>
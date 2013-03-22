<?php
ob_start();
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php require_once('../connections/Project01.php'); ?>
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
	
  $logoutGoTo = "../index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "false";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "members.php?failed=2";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO linkinfo (linkId, linkHeader, linkUrl, linkType, linkSource, linkDate) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['linkId'], "int"),
                       GetSQLValueString($_POST['linkHeader'], "text"),
                       GetSQLValueString($_POST['linkUrl'], "text"),
                       GetSQLValueString($_POST['linkType'], "int"),
                       GetSQLValueString($_POST['linkSource'], "text"),
                       GetSQLValueString($_POST['linkDate'], "date"));

  mysql_select_db($database_Project01, $Project01);
  $Result1 = mysql_query($insertSQL, $Project01) or die(mysql_error());

  $insertGoTo = "links.php?success=1";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_Project01, $Project01);
$query_Recordset1 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl, linkinfo.linkType FROM linkinfo WHERE linkinfo.linkType = 0";
$Recordset1 = mysql_query($query_Recordset1, $Project01) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_Project01, $Project01);
$query_Recordset2 = "SELECT linkinfo.linkHeader, linkinfo.linkType, linkinfo.linkSource, linkinfo.linkDate FROM linkinfo WHERE linkinfo.linkType = 1 ORDER BY linkinfo.linkDate ASC";
$Recordset2 = mysql_query($query_Recordset2, $Project01) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_Project01, $Project01);
$query_Recordset3 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl, linkinfo.linkType, linkinfo.linkSource, linkinfo.linkDate FROM linkinfo";
$Recordset3 = mysql_query($query_Recordset3, $Project01) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Your description goes here" />
<meta name="keywords" content="your,keywords,goes,here" />
<meta name="author" content="Your Name" />
<link rel="stylesheet" type="text/css" href="../css/layout.css" media="screen,projection" />
<link rel="shortcut icon" href="../images/siteicon.ico" type="image/x-icon" />
<title>kraftwerk@home</title>
</head>

<body>
<div id="wrap">
    <div id="header"> <img id="frontphoto" src="../images/Home/front.jpg" width="960" height="75" alt="binary code banner" /> </div>
    <div id="leftside">
        <h2 class="announce">Admin:</h2>
        <ul class="avmenu">
            <li><a href="admin.php">Users</a></li>
            <li><a class="current" href="links.php">News/Links</a></li>
            <li><a href="../index.php">Home</a></li>
            <li><a href="<?php echo $logoutAction ?>">Log out</a></li>
            
            
        </ul>
    </div>
    <div id="contentwide">
        <hr />
        <h2>Add News/Links</h2>
        <hr />
                <br />
        <h3 class="adminsubheader"> Current Links</h3>
        <table class="admintable">
            <tr>
                <td>Link Description</td>
                <td>Link URL</td>
            </tr>
            <?php do { ?>
                <tr>
                    <td><?php echo $row_Recordset1['linkHeader']; ?></td>
                    <td><?php echo $row_Recordset1['linkUrl']; ?></td>
                </tr>
                <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
        </table>
        <br />
	<h3 class="adminsubheader"> Current News</h3>
        <table class="admintable">
            <tr>
                
                <td>Description</td>
                <td>Source</td>
                <td>Date</td>
            </tr>
            <?php do { ?>
                <tr>
                    
                    <td><?php echo $row_Recordset2['linkHeader']; ?></td>
                    <td><?php echo $row_Recordset2['linkSource']; ?></td>
                    <td><?php echo $row_Recordset2['linkDate']; ?></td>
                </tr>
                <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
        </table>
		<br />
        <h3 class="adminsubheader">Add News Item/Link</h3>
        
        <form action="<?php echo $editFormAction; ?>" method="post" id="form1">
            <table class="insertLink">
                <tr valign="top">
                    <td align="right">Description(If Link)<br />Headline(If News)</td>
                    <td><textarea name="linkHeader" value=""  rows="6" cols="40"/></textarea></td>
            </tr>
                <tr valign="baseline">
                    <td align="right">URL:</td>
                    <td><input type="text" name="linkUrl" value="" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td align="right">Type:</td>
                    <td valign="baseline">
                    <table>
                        <tr>
                            <td><input type="radio" name="linkType" value="0" />
                                Link</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="linkType" value="1" />
                                News</td>
                        </tr>
                    </table></td>
                </tr>
                <tr valign="baseline">
                    <td align="right">Source (If News):</td>
                    <td><input type="text" name="linkSource" value="0" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td align="right">Date (If News):</td>
                    <td><input type="text" name="linkDate" value="0" size="32" /></td>
                </tr>
                <tr valign="baseline">
                    <td align="right">&nbsp;</td>
                    <td><input type="submit" value="Update" /></td>
                </tr>
            </table>
            <input type="hidden" name="MM_insert" value="form1" />
        </form>
        
        
    </div>
</div>
<div id="footer">
    <p><span>&copy; 2012 James Coll - Munnki Productions</span><br />
        Designed using Php | MySQL | jquery | Lightbox </p>
</div>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);
ob_end_flush();
?>

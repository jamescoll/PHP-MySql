<?php
//we need this to avoid problems with 'headers already included' etc...
ob_start();
if (!isset($_SESSION)) {
  session_start();
}
?>
<?php require_once('connections/Project01.php'); ?>
<?php
//initialize the session


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
	
  $logoutGoTo = "chrome_media.php";
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
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

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
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "members.php";
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
  $insertSQL = sprintf("INSERT INTO commentinfo (trackId, userId, commentTxt, dateAndTime) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['trackId'], "int"),
                       GetSQLValueString($_POST['userId'], "text"),
                       GetSQLValueString($_POST['commentTxt'], "text"),
                       GetSQLValueString($_POST['dateAndTime'], "date"));

  mysql_select_db($database_Project01, $Project01);
  $Result1 = mysql_query($insertSQL, $Project01) or die(mysql_error());

  $insertGoTo = "chrome_media.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$maxRows_Recordset1 = 15;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

if(isset($_GET["trackId"]))
{
	$currentTrack = $_GET["trackId"];
}
else
{
	//set it to the first track that has an associated
	//sample
	$currentTrack = 100;
}

mysql_select_db($database_Project01, $Project01);
$query_Recordset1 = "SELECT trackinfo.trackId, trackinfo.albumId, trackinfo.trackTitle, trackinfo.trackLength, trackinfo.trackComposers, trackinfo.sampleTrack, trackinfo.samplePath, albuminfo.albumId, albuminfo.albumTitle, albuminfo.albumReleaseYear FROM trackinfo, albuminfo WHERE albuminfo.albumId = trackinfo.albumId AND sampleTrack=1 ";
$Recordset1 = mysql_query($query_Recordset1, $Project01) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_Project01, $Project01);
$query_Recordset2 = "SELECT trackinfo.samplePath, trackinfo.trackTitle, trackinfo.trackId FROM trackinfo WHERE trackinfo.trackId = $currentTrack";
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
$query_Recordset3 = "SELECT commentinfo.trackId, commentinfo.userId, commentinfo.commentTxt, commentinfo.dateAndTime, userinfo.userName FROM commentinfo, userinfo  WHERE  commentinfo.trackId = $currentTrack AND commentinfo.userId = userinfo.userId ";
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

mysql_select_db($database_Project01, $Project01);
$query_Recordset4 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl FROM linkinfo WHERE linkinfo.linkType = 0";
$Recordset4 = mysql_query($query_Recordset4, $Project01) or die(mysql_error());
$row_Recordset4 = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

$maxRows_Recordset5 = 10;
$pageNum_Recordset5 = 0;
if (isset($_GET['pageNum_Recordset5'])) {
  $pageNum_Recordset5 = $_GET['pageNum_Recordset5'];
}
$startRow_Recordset5 = $pageNum_Recordset5 * $maxRows_Recordset5;

mysql_select_db($database_Project01, $Project01);
$query_Recordset5 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl, linkinfo.linkType, linkinfo.linkSource, linkinfo.linkDate FROM linkinfo WHERE linkinfo.linkType = 1 ORDER BY linkinfo.linkDate DESC";
$query_limit_Recordset5 = sprintf("%s LIMIT %d, %d", $query_Recordset5, $startRow_Recordset5, $maxRows_Recordset5);
$Recordset5 = mysql_query($query_limit_Recordset5, $Project01) or die(mysql_error());
$row_Recordset5 = mysql_fetch_assoc($Recordset5);

if (isset($_GET['totalRows_Recordset5'])) {
  $totalRows_Recordset5 = $_GET['totalRows_Recordset5'];
} else {
  $all_Recordset5 = mysql_query($query_Recordset5);
  $totalRows_Recordset5 = mysql_num_rows($all_Recordset5);
}
$totalPages_Recordset5 = ceil($totalRows_Recordset5/$maxRows_Recordset5)-1;




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
    <script src="js/styling-the-playlist-table-stripes.js"  type="text/javascript"></script>
  
	<script type="text/javascript">
		function DoNav(theUrl)
		{
			document.location.href = theUrl;
		}
	</script>
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
			<li><a class="current" href="chrome_media.php">Audio</a></li>
            <li><a href="admin/admin.php">Admin</a></li>
            <li><a href="<?php echo $logoutAction ?>">Log out</a></li>
		</ul>
        <div class="links">
			<h3>Links:</h3>
			<ul>
			    <?php do { ?>
			        <li><a href="<?php echo $row_Recordset4['linkUrl']; ?>"><?php echo $row_Recordset4['linkHeader']; ?></a></li>
			        <?php } while ($row_Recordset4 = mysql_fetch_assoc($Recordset4)); ?>
			
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
			    <p><strong><?php echo $row_Recordset5['linkDate']; ?> </strong><?php echo $row_Recordset5['linkHeader']; ?> <a href="<?php echo $row_Recordset5['linkUrl']; ?>"><?php echo $row_Recordset5['linkSource']; ?></a></p>
			    <?php } while ($row_Recordset5 = mysql_fetch_assoc($Recordset5)); ?>
            
			
		</div>
	
		
  </div>
		
	<div id="content">	
	 <hr />
    <h2>Members Area - Welcome <?php echo $_SESSION['MM_Username']; ?></h2>
    <hr />
	<h3> Playlist</h3>
    <h5> Click on a tune below to select it and then press play in the player. </h5>
    <hr />
	
	    <table id="playlist1" width="90%" summary="An interactive playlist inspired by the iTunes playlist of Craig Gannell.">
	      
	        <thead>
	            <tr>
	                <th scope="col">Song Name</th>
	                <th scope="col">Time</th>
	                <th scope="col">Composers</th>
	                <th scope="col">Album</th>
	                <th scope="col">Year</th>
                </tr>
            </thead>
	        <tfoot>
	            <tr>
	                <td colspan="5">Music selection from - Kraftwerk@home </td>
                </tr>
            </tfoot>
	        <tbody>
            <?php do { ?>
            
	            <tr onclick="DoNav('chrome_media.php?trackId=<?php echo $row_Recordset1['trackId']; ?>')">
                
				    
				    
				    
				    
	                <td><?php echo $row_Recordset1['trackTitle']; ?></td>
	                <td><?php echo $row_Recordset1['trackLength']; ?></td>
	                <td><?php echo $row_Recordset1['trackComposers']; ?></td>
	                <td><?php echo $row_Recordset1['albumTitle']; ?></td>
	                <td><?php echo $row_Recordset1['albumReleaseYear']; ?></td>
	                </tr>
	    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>        
            </tbody>
        </table>
	    
        <!-- this page uses the better HTML5 audio tag and avoids Chrome problems  -->
		
    <hr />
    
     <h3> Now Playing - <em><?php echo $row_Recordset2['trackTitle']; ?></em></h3>
    <h5> Please allow track a moment to load </h5>
	<h5> If experiencing problems please click <a href="media.php">here</a> for a Java based player. </h5>
    <hr />
    
    <div id="audioplayer">
	<audio controls="controls">
			<source src="<?php echo $row_Recordset2['samplePath']; ?>" type="audio/mp3">
			Please click <a href="media.php">here</a> for a java based player.
			</audio>
   </div>
    
	<table id="comments">
        <tr>
        <th>Username</th>
        <th>Comment</th>
        <th>Date</th>
        </tr>
        <?php do { ?>
    <tr>
        <td class="name"><?php echo $row_Recordset3['userName']; ?></td>
        <td class="comment"><?php echo $row_Recordset3['commentTxt']; ?></td>
        <td class="date"><?php 
		//this makes the date a bit more readable
		 echo date("F j, Y h:i", strtotime($row_Recordset3['dateAndTime']) );  ?></td>
    </tr>
    <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
        </table>
		
            <form action="<?php echo $editFormAction; ?>" method="post" id="form1">
        <table id="commentform">
            <tr valign="baseline">
                <td align="right"><h3><?php echo $_SESSION['MM_Username']; ?> - Share your thoughts!</h3></td>
				</tr>
				<tr>
                <td><textarea name="commentTxt" value=""  rows="6" cols="40"/></textarea></td>
            </tr>
            <tr valign="baseline">
                
                <td><input type="submit" value="Add Comment" /></td>
            </tr>
        </table>
        <input type="hidden" name="trackId" value="<?php echo $row_Recordset2['trackId']; ?>" />		<!-- We Want to Get the Current User by UserId  we grab it by using the session variable and getting the id back out of the database using it-->
        <?php
        	mysql_select_db($database_Project01, $Project01);
			$uName = $_SESSION['MM_Username']; 
			$userIdQuery = "SELECT userId FROM userinfo WHERE userName = '$uName'";
			$userData = mysql_query($userIdQuery, $Project01); 
			$row_userData = mysql_fetch_assoc($userData);
			?>
            
           
        <input type="hidden" name="userId" value="<?php echo $row_userData['userId']; ?>" />
        <input type="hidden" name="dateAndTime" value="<?php $var = (date("Y-m-d H:i:s", time())); echo $var; ?>" />
        <input type="hidden" name="MM_insert" value="form1" />
    </form>
    </div>
    
    
    
	<div id="footer">
		<p>&copy; 2012 James Coll - Munnki Productions<br />
		Designed using Php | MySQL | jquery | Lightbox </p>
	</div>

</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);

mysql_free_result($Recordset3);

mysql_free_result($Recordset4);
mysql_free_result($Recordset5);
ob_end_flush();
?>

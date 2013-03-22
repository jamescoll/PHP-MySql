<?php
ob_start();
if(!isset($_SESSION))
{
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
	
  $logoutGoTo = "review.php";
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
//This is the code that gets the variable and forms the select statement
//if the variable isn't set then a default value of the first album will be set
if(isset($_GET["albumId"]))
{
	$identifier = $_GET["albumId"];
}
else
{
		$identifier = 1000;	
}

mysql_select_db($database_Project01, $Project01);
$query_Recordset1 = "SELECT albumId, albumTitle, albumNoTracks, albumLabel, albumImage, albumReview FROM albuminfo WHERE albumId=$identifier";
$Recordset1 = mysql_query($query_Recordset1, $Project01) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_Project01, $Project01);
$query_Recordset2 = "SELECT albumId, trackNo, trackTitle, trackComposers, trackLength FROM trackinfo WHERE albumId=$identifier";
$Recordset2 = mysql_query($query_Recordset2, $Project01) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

mysql_select_db($database_Project01, $Project01);
$query_Recordset3 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl FROM linkinfo WHERE linkinfo.linkType = 0";
$Recordset3 = mysql_query($query_Recordset3, $Project01) or die(mysql_error());
$row_Recordset3 = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

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
	<link rel="stylesheet" type="text/css" href="css/lightbox.css" media="screen,projection" />
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
			<li><a class="current" href="discography.php">Discography</a></li>
			<li><a href="gallery.php">Gallery</a></li>
			<li><a href="media.php">Audio</a></li>
            <li><a href="admin/admin.php">Admin</a></li>
		
		</ul>
        <div class="links">
			<h3>Links:</h3>
			<ul>
			    <?php do { ?>
			        <li><a href="<?php echo $row_Recordset3['linkUrl']; ?>"><?php echo $row_Recordset3['linkHeader']; ?></a></li>
			        <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
			
			</ul>
		</div>

		
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
		<h2><?php echo $row_Recordset1['albumTitle']; ?></h2>
		<hr />
        	<table id="reviewbackprev">
				<tr>
					
					<th>
					<?php 
					
						// this sets up the back and next variables for the images
						$var=$row_Recordset1['albumId'];
						$back=$var-1;
						$next=$var+1;
				
						
					
					// this avoids a back button appearing when at the first album 
					if($back != 999)
					{
						//this sets up the variables for the previous and next page links
						
						
						echo "<a href=\"review.php?albumId=";
						echo $back;
						echo "\"><img src=\"images/Navigation/back.jpg\" alt=\"back\" /></a>";


					}
					// if this fails an image of equal size but blank will be loaded to preserve consistency - this is a hack - but it works
					else
					{
						echo "<img src=\"images/Navigation/nil.jpg\" alt=\"Nil\"  />";
					}
					
					?>
					</th>
					<th colspan="2"><h5> <a href="discography.php">Browse Discography</a></h5></th>
					
					<th>
					
					<?php 	
					
					// this avoids a back button appearing when at the first album 
					if($next != 1012)
					{
						//this sets up the variables for the previous and next page links
						
						
						echo "<a href=\"review.php?albumId=";
						echo $next;
						echo "\"><img src=\"images/Navigation/next.jpg\" alt=\"next\"  /></a>";


					}
					// if this fails an image of equal size but blank will be loaded to preserve consistency - this is a hack - but it works
					else
					{
						echo "<img src=\"images/Navigation/nil.jpg\" alt=\"Nil\"  />";
					}
					
					?>					
					</th>
				</tr>
		</table>
		
		<img src="<?php echo $row_Recordset1['albumImage']; ?>" width="200" height="200" class ="left" alt="Album Cover" />
		
		<p><?php
			 
			$reviewtext = file_get_contents($row_Recordset1['albumReview'], true);
			echo $reviewtext;
			?>
        </p>
        <h5>Review from <a href="http://www.allmusic.com">All Music Guide</a></h5>
		
	
		
		
		<table id="albumInformation">
				<tr>
					
					<th colspan="4">Album Information</th>
					
				</tr>
		  <tr id="subInformation">
					<td>Track Number</td>
					<td>Title</td>
					<td>Composer(s)</td>
					<td>Length</td>
				</tr>
				<?php do { ?>
			    <tr>
				    <td class="tracktitlelength"><?php echo $row_Recordset2['trackNo']; ?></td>
				    <td class="tracktitlelength"><?php echo $row_Recordset2['trackTitle']; ?></td>
				    <td class="composer"><?php echo $row_Recordset2['trackComposers']; ?></td>
				    
				    <td class="tracktitlelength"><?php echo $row_Recordset2['trackLength']; ?></td>
				    
				    </tr>
				  <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
				
		</table>
		
	
	
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

mysql_free_result($Recordset5);
ob_end_flush();
?>

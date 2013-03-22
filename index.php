<?php 
ob_start();
//initialize the session
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
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if(!isset($_SESSION))
{
	session_start();
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

mysql_select_db($database_Project01, $Project01);
$query_Recordset1 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl, linkinfo.linkType FROM linkinfo  WHERE linkinfo.linkType = 0";
$Recordset1 = mysql_query($query_Recordset1, $Project01) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

mysql_select_db($database_Project01, $Project01);
$query_Recordset2 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl, linkinfo.linkType, linkinfo.linkSource, linkinfo.linkDate FROM linkinfo WHERE linkinfo.linkType = 1 ORDER BY linkinfo.linkDate DESC";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $Project01) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;
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
			<li><a class="current" href="index.php">Home</a></li>
			<li><a href="discography.php">Discography</a></li>
			<li><a href="gallery.php">Gallery</a></li>
			<li><a href="media.php">Audio</a></li>
            <li><a href="admin/admin.php">Admin</a></li>
		</ul>

		
		<div class="links">
			<h3>Links:</h3>
			<ul>
			    <?php do { ?>
			        <li><a href="<?php echo $row_Recordset1['linkUrl']; ?>"><?php echo $row_Recordset1['linkHeader']; ?></a></li>
			        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
			
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
			    <p><strong><?php echo $row_Recordset2['linkDate']; ?> </strong><?php echo $row_Recordset2['linkHeader']; ?> <a href="<?php echo $row_Recordset2['linkUrl']; ?>"><?php echo $row_Recordset2['linkSource']; ?></a></p>
			    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
            
			
		</div>
		
  </div>

	<div id="content">
    	<?php 
			if(isset($_GET['success']))
			{
				if ($_GET['success']==1)
				{
					echo "<div class=\"loginmessage\">YOU ARE NOW LOGGED IN AND MAY ACCESS OUR AUDIO OR ADMIN PAGES.</div>";
				}
			}
		?>
		<p><img src="images/Home/live.jpg" height="150" width="150" class="right" alt="Kraftwerk - Live in Kiev" title="Kraftwerk - Live in Kiev 2008" /><em>Kraftwerk</em> ( meaning power station) from D&#252;sseldorf, Germany, is an influential electronic music project that was formed by Ralf H&#252;tter and Florian Schneider in 1970, and was fronted by them until Schneider's departure in 2008. The signature Kraftwerk sound combines driving, repetitive rhythms with catchy melodies, mainly following a Western Classical style of harmony, with a minimalistic and strictly electronic instrumentation. The group's simplified lyrics are at times sung through a vocoder or generated by computer-speech software. Kraftwerk were one of the first groups to popularize electronic music and are considered pioneers in the field. In the 1970s and early 1980s, Kraftwerk's distinctive sound was revolutionary, and has had a lasting effect across many genres of modern music.</p>
		
	  <div class="frontquote">We have aspects in our music that refer to space, like Kometenmelodie, but we also have some very earthly aspects that are very direct and not from outer space but from inner space like from the human being and the body, and very close to every day life. <strong> Ralf H&#252;tter </strong></div>
		
	  
		<p>This site is a guide to the work of the German collective Kraftwerk. It features a complete and dynamic discography, galleries featuring tours and their studios as well as audio samples. It is intended to provide a guide to the work of this important and unique collective. Since their inception in 1970 Kraftwerk have influenced a huge range of musicians and musical styles.</p>

	  <div class="frontquote"> The association field is very large in music, meaning that somebody can make some special sound put them on tape and broadcast them to 50 people or 100 or 1,000 and each one of those people has a different impression of the sounds they have heard. It's not like the cinema where nearly everybody sees the same thing. I think the optical is much more fixed but when you have music you have so many different sorts of musics in the brains of the people. <strong>Florian Schneider </strong></div>
		<p><img src="images/Home/Kraftwerk.jpg" width="220" height="168" alt="kraftwerk models" class="left" />Kraftwerk's lyrics deal with post-war European urban life and technology—traveling by car on the Autobahn, traveling by train, using home computers, and the like. Usually, the lyrics are very minimal but reveal both an innocent celebration of, and a knowing caution about, the modern world, as well as playing an integral role in the rhythmic structure of the songs. Many of Kraftwerk's songs express the paradoxical nature of modern urban life—a strong sense of alienation existing side-by-side with a celebration of the joys of modern technology.
All of Kraftwerk's albums from Radio-Activity onwards have been released in separate versions: one with German vocals for sale in Germany, Switzerland and Austria and one with English vocals for the rest of the world, with occasional variations in other languages when conceptually appropriate.
Live performance has always played an important part in Kraftwerk's activities. Also, despite its live shows generally being based around formal songs and compositions, live improvisation often plays a noticeable role in its performances. This trait can be traced back to the group's roots in the first experimental krautrock scene of the late 1960s, but, significantly, it has continued to be a part of its playing even as it makes ever greater use of digital and computer-controlled sequencing in its performances. Some of the band's familiar compositions have been observed to have developed from live improvisations at its concerts or sound-checks.</p>
	
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
ob_end_flush();
?>

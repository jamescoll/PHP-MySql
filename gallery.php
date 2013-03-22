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
	
  $logoutGoTo = "gallery.php";
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

mysql_select_db($database_Project01, $Project01);
$query_Recordset1 = "SELECT linkinfo.linkHeader, linkinfo.linkUrl FROM linkinfo WHERE linkinfo.linkType = 0";
$Recordset1 = mysql_query($query_Recordset1, $Project01) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Your description goes here" />
	<meta name="keywords" content="your,keywords,goes,here" />
	<meta name="author" content="Your Name" />
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/lightbox.js"></script>
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
			<li><a href="discography.php">Discography</a></li>
			<li><a class="current" href="gallery.php">Gallery</a></li>
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
			    <p><strong><?php echo $row_Recordset3['linkDate']; ?> </strong><?php echo $row_Recordset3['linkHeader']; ?> <a href="<?php echo $row_Recordset3['linkUrl']; ?>"><?php echo $row_Recordset3['linkSource']; ?></a></p>
			    <?php } while ($row_Recordset3 = mysql_fetch_assoc($Recordset3)); ?>
            
			
		</div>
		  
		
  </div>
	
    
	<div id="content">
		<hr />
		<h2>The Band</h2>
		<hr />
		<p>Florian Schneider (flutes, synthesizers, electro-violin) and Ralf H&#252;tter (electronic organ, synthesizers) met as students at the Robert Schumann Hochschule in Düsseldorf in the late 1960s. From then on they have gathered other members finally settling on the fixed line-up of Kraftwerk that lasted until two years ago.</p>
		<a href="images/Band/1.jpg" rel="lightbox[Group]" title="The 1970s" ><img src="images/Band/thumb-1.jpg" width="100" height="100" alt="The 1970s"/></a>
		<a href="images/Band/2.jpg" rel="lightbox[Group]" title="The 1970s"><img src="images/Band/thumb-2.jpg" width="100" height="100" alt="The 1970s" /></a>
		<a href="images/Band/3.jpg" rel="lightbox[Group]" title="The 1970s" ><img src="images/Band/thumb-3.jpg" width="100" height="100" alt="The 1970s" /></a>
		<a href="images/Band/4.jpg" rel="lightbox[Group]" title="The 1980s"><img src="images/Band/thumb-4.jpg" width="100" height="100" alt="The 1980s" /></a>
		<a href="images/Band/5.jpg" rel="lightbox[Group]" title="The 1980s"><img src="images/Band/thumb-5.jpg" width="100" height="100" alt="The 1980s" /></a>
		<a href="images/Band/6.jpg" rel="lightbox[Group]" title="The 1990s" ><img src="images/Band/thumb-6.jpg" width="100" height="100" alt="The 1990s" /></a>
		<a href="images/Band/6a.jpg" rel="lightbox[Group]" title="The 1990s" ><img src="images/Band/thumb-6a.jpg" width="100" height="100" alt="The 1990s" /></a>
		<a href="images/Band/7.jpg" rel="lightbox[Group]" title="Karl Bartos" ><img src="images/Band/thumb-7.jpg" width="100" height="100" alt="Karl Bartos" /></a>
		<a href="images/Band/8.jpg" rel="lightbox[Group]" title="Ralf Hütter" ><img src="images/Band/thumb-8.jpg" width="100" height="100" alt="Ralf Hütter"/></a>
		<a href="images/Band/9.jpg" rel="lightbox[Group]" title="Florian Schneider" ><img src="images/Band/thumb-9.jpg" width="100" height="100" alt="Florian Schneider" /></a>
		<hr />
		<h2>Kling Klang Studio</h2>
		<hr />
		<p>Kling Klang (also known as Klingklang) is the private music studio of the band Kraftwerk. The name is taken from the first song on the Kraftwerk 2 album. The studio was originally located at Mintropstrasse 16 in D&#252;sseldorf, Germany, but in mid-2009 was relocated to a new location in Meerbusch-Osterath, around 10 kilometers west of D&#252;sseldorf.</p>
		<a href="images/KlingKlang/1.jpg" rel="lightbox[KlingKlang]" title="The original site of KlingKlang Studio" ><img src="images/KlingKlang/thumb-1.jpg" width="100" height="100" alt="The original site of KlingKlang Studio"/></a>
		<a href="images/KlingKlang/2.jpg" rel="lightbox[KlingKlang]" title="Equipment at the KlingKlang Studio 1 (Black and White)" ><img src="images/KlingKlang/thumb-2.jpg" width="100" height="100" alt="Equipment at the KlingKlang Studio 1 (Black and White)" /></a>
		<a href="images/KlingKlang/2a.jpg" rel="lightbox[KlingKlang]" title="Equipment at the KlingKlang Studio 2 (Black and White)" ><img src="images/KlingKlang/thumb-2a.jpg" width="100" height="100" alt="Equipment at the KlingKlang Studio 2 (Black and White)" /></a>
		<a href="images/KlingKlang/3.jpg" rel="lightbox[KlingKlang]" title="Equipment at the KlingKlang Studio 3 (Colour)"><img src="images/KlingKlang/thumb-3.jpg" width="100" height="100" alt="Equipment at the KlingKlang Studio 3 (Colour)" /></a>
		<a href="images/KlingKlang/4.jpg" rel="lightbox[KlingKlang]" title="The Robots in action"><img src="images/KlingKlang/thumb-4.jpg" width="100" height="100" alt="The Robots in action" /></a>
		<a href="images/KlingKlang/5.jpg" rel="lightbox[KlingKlang]" title="Posing for the Man Machine in studio"><img src="images/KlingKlang/thumb-5.jpg" width="100" height="100" alt="Posing for the Man Machine in studio" /></a>
		<a href="images/KlingKlang/6.jpg" rel="lightbox[KlingKlang]" title="At work in the studio"><img src="images/KlingKlang/thumb-6.jpg" width="100" height="100" alt="At work in the studio" /></a>
		<hr />
		<h2>Kraftwerk Live</h2>
		<hr />
		<p>Kraftwerk still tour and play regularly at festivals. Their stage shows have typically featured the four muscians stage front and digital imagery displayed behind them. The use of robotics and other technical innovations in their live performances illustrates Kraftwerk’s belief in the respective contributions of both people and machines in creating art.</p>
			
		<a href="images/Live/0.jpg" rel="lightbox[KraftwerkLive]" title="Live in 1970"><img src="images/Live/thumb-0.jpg" width="100" height="100" alt="Live in 1970"/></a>
		<a href="images/Live/0a.jpg" rel="lightbox[KraftwerkLive]" title="At Berkeley Court 1975"><img src="images/Live/thumb-0a.jpg" width="100" height="100" alt="At Berkeley Court 1975"/></a>
		<a href="images/Live/1.jpg" rel="lightbox[KraftwerkLive]" title="The Model on tour - 1980s"><img src="images/Live/thumb-1.jpg" width="100" height="100" alt="The Model on tour - 1980s"/></a>
		<a href="images/Live/2.jpg" rel="lightbox[KraftwerkLive]" title="The Man Machine live 2007"><img src="images/Live/thumb-2.jpg" width="100" height="100" alt="The Man Machine live 2007" /></a>
		<a href="images/Live/4.jpg" rel="lightbox[KraftwerkLive]" title="The fun of the Autobahn 2009"><img src="images/Live/thumb-4.jpg" width="100" height="100" alt="The fun of the Autobahn 2009" /></a>
		<hr />
		<h2>The Instruments</h2>
		<hr />
		<p>Kraftwerk's use of instruments has charted the history of electronic music and devices. From building their own custom devices to having devices custom made for them, they have additionally used a huge array of available instruments from early synths like the Orchestron to modern devices like the Nord Lead 2. </p>
		<a href="images/Instruments/1.JPG" rel="lightbox[Instruments]" title="Roland 100m Modular Synthesizer (1970s)"><img src="images/Instruments/thumb-1.jpg" width="100" height="100" alt="Roland 100m Modular Synthesizer (1970s)"/></a>
		<a href="images/Instruments/2.jpg" rel="lightbox[Instruments]" title="Custom Vocoder (1970s)"><img src="images/Instruments/thumb-2.jpg" width="100" height="100" alt="Custom Vocoder (1970s)" /></a>
		<a href="images/Instruments/3.jpg" rel="lightbox[Instruments]" title="The Orchestron - Radioactivity (1975)"><img src="images/Instruments/thumb-3.jpg" width="100" height="100" alt="The Orchestron - Radioactivity (1975)" /></a>
		<a href="images/Instruments/4.jpg" rel="lightbox[Instruments]" title="Texas Instruments Language Translator - Computer World (1981)"><img src="images/Instruments/thumb-4.jpg" width="100" height="100" alt="Texas Instruments Language Translator - Computer World (1981)" /></a>
		<a href="images/Instruments/5.jpg" rel="lightbox[Instruments]" title="Mattel BEEGEE Mini Keyboard - Computer World (1981)"><img src="images/Instruments/thumb-5.jpg" width="100" height="100" alt="Mattel BEEGEE Mini Keyboard - Computer World (1981)" /></a>
		<a href="images/Instruments/6.jpg" rel="lightbox[Instruments]" title="Clavia Nord Lead 2 (1995)"><img src="images/Instruments/thumb-6.jpg" width="100" height="100" alt="Clavia Nord Lead 2 (1995)" /></a>
		<a href="images/Instruments/7.jpg" rel="lightbox[Instruments]" title="Doepfer Schaltwerk instrument controller (1997)"><img src="images/Instruments/thumb-7.jpg" width="100" height="100" alt="Doepfer Schaltwerk instrument controller (1997)" /></a>
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

mysql_free_result($Recordset3);

ob_end_flush();
?>

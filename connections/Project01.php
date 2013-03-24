<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Project01 = "*";
$database_Project01 = "*";
$username_Project01 = "*";
$password_Project01 = "*";
$Project01 = mysql_pconnect($hostname_Project01, $username_Project01, $password_Project01) or trigger_error(mysql_error(),E_USER_ERROR); 
?>


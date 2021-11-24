<?php
include("../include/aplikacija.h.php"); 
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Promena lozinke",100);

prazanRed();

$pass=$_POST['pass'];
$pass2=$_POST['pass2'];

if (!$pass || !$pass2)
{
  adminIspis("Niste uneli sve neophodne podatke. Poku&#353;ajte ponovo...");
  adminFooter();
  dbDisconnect();
  exit;
}

if ($pass!=$pass2)
{
  adminIspis("Lozinke nisu iste. Poku&#353;ajte ponovo...");
  adminFooter();
  dbDisconnect();
  exit;
}

$salt="";
$fp=fopen(".htpasswd","w");
$novi_pass=crypt($pass,$salt);
$sadrzaj="admin:".$novi_pass;

$pisanje=fwrite($fp,$sadrzaj);
if ($pisanje)
{
  adminIspis("Lozinka promenjena.");
  adminIspis(stampUVreme(stamp())); 
}
else
{
  adminIspis("Greska!!!");    
}

fclose($fp);

adminFooter();
dbDisconnect();
?>
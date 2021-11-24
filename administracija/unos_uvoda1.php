<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Unos uvoda",100);   

prazanRed();

$grupa=$_POST[grupa];
if (!$grupa) $grupa=0;

$v=new uvod($grupa);

$v->naslov=$_POST[naslov];
$v->tekst=$_POST[tekst];

if (!$v->naslov || !$v->tekst)
{
  if (!$v->naziv) adminIspis("Niste uneli naslov.");
  if (!$v->tekst) adminIspis("Niste uneli tekst.");
  adminIspis("Niste uneli sve neophodne podatke. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos uvoda");  
  adminFooter();
  dbDisconnect();
  exit;
}

$v->unos();
if ($v->rezultat_unosa)
{
  adminIspis("Podaci za uvod: <span class='vrednost'>".$v->naziv."</span> su uneti.");
  adminIspis(stampUVreme(stamp())); 
  prazanRed();  
  adminLink("- Povratak na unos uvoda","unos_uvoda.php?grupa=".$v->grupa);
}
else
{
  adminIspis("Podaci nisu uneti. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos uvoda");   
} 



adminFooter();
dbDisconnect();
?>
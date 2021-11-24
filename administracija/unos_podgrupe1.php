<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Unos podgrupe",100);  
prazanRed(2); 

$id=$_POST[id];
$v=new podgrupa($id);

$v->parent=$_POST[parent];
$v->naziv=$_POST[naziv];
$v->prioritet=$_POST[prioritet];
$v->aktivno=$_POST[aktivno];

if (!$v->naziv || !$v->parent)
{
  if (!$v->parent) adminIspis("Niste uneli pripadnost.");
  if (!$v->naziv) adminIspis("Niste uneli naziv.");
  adminIspis("Niste uneli sve neophodne podatke. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos podgrupe");
  adminLink("- Pregled podgrupa","unos_grupe.php?id=".$v->parent); 
  adminFooter();
  dbDisconnect();
  exit;
}


$v->unos();
if ($v->rezultat_unosa)
{
  adminIspis("Podaci za podgrupu: <span class='vrednost'>".$v->naziv."</span> su uneti.");
  adminIspis(stampUVreme(stamp())); 
  prazanRed();  
  adminLink("- Povratak na unos podgrupe","unos_podgrupe.php?parent=".$v->parent."&id=".$v->id);
  adminLink("- Unos nove podgrupe","unos_podgrupe.php?parent=".$v->parent);  
  adminLink("- Pregled podgrupa","unos_grupe.php?id=".$v->parent);  
  adminLink("- Pregled grupa","grupe.php");  
 
}
else
{
  adminIspis("Podaci nisu uneti. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos podgrupe");    
  adminLink("- Pregled podgrupa","unos_grupe.php?id=".$v->parent); 
} 

adminFooter();
dbDisconnect();
?>
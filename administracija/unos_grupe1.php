<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Unos grupe",100);    
prazanRed(2); 

$id=$_POST[id];
$v=new grupa($id);

$v->naziv=$_POST[naziv];
$v->prioritet=$_POST[prioritet];
$v->aktivno=$_POST[aktivno];

if (!$v->naziv)
{
  if (!$v->naziv) adminIspis("Niste uneli naziv.");
  adminIspis("Niste uneli sve neophodne podatke. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos grupe");  
  adminFooter();
  dbDisconnect();
  exit;
}

$q=new query("select * from ".TAB_GRUPE." where naziv='".$v->naziv."' and id!='".$v->id."'");
if ($q->rows)
{
  adminIspis("Grupa <span class='vrednost'>".$v->naziv."</span> je ve&#263; uneta ! ");
  prazanRed();
  adminLinkBack("- Povratak na unos grupe");
  adminLink("- Pregled grupa","grupe.php");  
  adminFooter();
  dbDisconnect();
  exit;
}

$v->unos();
if ($v->rezultat_unosa)
{
  adminIspis("Podaci za grupu: <span class='vrednost'>".$v->naziv."</span> su uneti.");
  adminIspis(stampUVreme(stamp())); 
  prazanRed();  
  adminLink("- Povratak na unos grupe","unos_grupe.php?id=".$v->id);
  adminLink("- Unos nove grupe","unos_grupe.php");  
  adminLink("- Pregled grupa","grupe.php");  
}
else
{
  adminIspis("Podaci nisu uneti. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos grupe");   
  adminLink("- Pregled grupa","grupe.php"); 
} 

adminFooter();
dbDisconnect();
?>
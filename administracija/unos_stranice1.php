<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("PODE&#352;AVANJA - Unos stranice",100);  

prazanRed();

$id=$_REQUEST[id];
$v=new stranica($id);

$v->naslov=$_POST[naslov];
$v->tekst=$_POST[tekst];

/*
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
*/

$v->unos();
if ($v->rezultat_unosa)
{
  $i=1;
  while ($i<=MAX_SLIKA_PO_STRANICI)
  { 
      
    //die(var_dump($_FILES['slika'.$i]));  
    $v->slike[$i]->niz=$_FILES['slika'.$i];
    $v->slike[$i]->komentar=$_POST['slika_komentar'.$i];
    //$v->slike[$i]->postaviKomentar($_POST['slika_komentar'.$i]);
    adminIspis($v->slike[$i]->upload());  
    $i++;  
  }
      
  adminIspis("Podaci za stranicu: <span class='vrednost'>".$v->naziv."</span> su uneti.");
  adminIspis(stampUVreme(stamp())); 
  prazanRed();  
  adminLink("- Povratak na unos stranice","unos_stranice.php?id=".$v->id);
}
else
{
  adminIspis("Podaci nisu uneti. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos stranice");   
} 



adminFooter();
dbDisconnect();
?>
<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();
adminHeader("VESTI - Unos vesti",99);   

prazanRed();

$id=$_POST[id];
$v=new vest($id);

$v->naslov=$_POST['naslov'];
$v->tekst=$_POST['tekst'];
$v->tekst_kratki=$_POST['tekst_kratki'];

$v->prioritet=$_POST['prioritet'];
$v->aktivno=$_POST['aktivno'];


if (!$v->naslov)
{
  if (!$v->naziv) adminIspis("Niste uneli naslov.");
  adminIspis("Niste uneli sve neophodne podatke. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos vesti");  
  adminFooter();
  dbDisconnect();
  exit;
}

$v->unos();
if ($v->rezultat_unosa)
{
  $i=1;
  while ($i<=MAX_SLIKA_PO_VESTI)
  {    
    $v->slike[$i]->niz=$_FILES['slika'.$i];
    $v->slike[$i]->komentar=$_POST['slika_komentar'.$i];
    $v->slike[$i]->postaviKomentar($_POST['slika_komentar'.$i]);
    adminIspis($v->slike[$i]->upload());  
    $i++;  
  }
    
  adminIspis("Podaci za vest: <span class='vrednost'>".$v->naslov."</span> su uneti.");
  adminIspis(stampUVreme(stamp())); 
  prazanRed();  
  adminLink("- Povratak na unos vesti","unos_vesti.php?id=".$v->id);
  adminLink("- Pregled vesti","vesti.php"); 
}
else
{
  adminIspis("Podaci nisu uneti. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos vesti"); 
  adminLink("- Pregled sajtova","vesti.php"); 
} 



adminFooter();
dbDisconnect();
?>
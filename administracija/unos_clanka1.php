<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();

$id=$_POST[id];
$v=new clanak($id);

$grupa=$_POST['grupa'];
$podgrupa=$_POST['podgrupa'];

$v->parent=$podgrupa;
$v->naslov=$_POST['naslov'];
$v->tekst=$_POST['tekst'];
$v->tekst_kratki=$_POST['tekst_kratki'];

$v->povezani1=$_POST['povezani1'];

$v->prioritet=$_POST['prioritet'];
$v->aktivno=$_POST['aktivno'];


adminHeader("&#268;LANCI- Unos &#269;lanka",$g->id);  
prazanRed();


if (!$v->naslov)
{
  if (!$v->naziv) adminIspis("Niste uneli naslov.");
  adminIspis("Niste uneli sve neophodne podatke. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos &#269;lanka");  
  adminFooter();
  dbDisconnect();
  exit;
}

$v->unos();
if ($v->rezultat_unosa)
{
  $i=1;
  while ($i<=MAX_SLIKA_PO_CLANKU)
  {    
    $v->slike[$i]->niz=$_FILES['slika'.$i];
    $v->slike[$i]->komentar=$_POST['slika_komentar'.$i];
    //$v->slike[$i]->postaviKomentar($_POST['slika_komentar'.$i]);
    adminIspis($v->slike[$i]->upload());  
    $i++;  
  }
    
  adminIspis("Podaci za &#269;lanak: <span class='vrednost'>".$v->naslov."</span> su uneti.");
  adminIspis(stampUVreme(stamp())); 
  prazanRed();  
  adminLink("- Povratak na unos &#269;lanka","unos_clanka.php?id=".$v->id."&grupa=".$grupa."&podgrupa=".$podgrupa);
  adminLink("- Pregled &#269;lanka za datu grupu/podgrupu","pregled.php?grupa=".$grupa."&podgrupa=".$podgrupa); 
}
else
{
  adminIspis("Podaci nisu uneti. Poku&#353;ajte ponovo...");
  prazanRed();
  adminLinkBack("- Povratak na unos &#269;lanka");
  adminLink("- Pregled &#269;lanka za datu grupu/podgrupu","pregled.php?grupa=".$grupa."&podgrupa=".$podgrupa);
} 


adminFooter();
dbDisconnect();
?>
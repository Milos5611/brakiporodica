<?php
include("../include/aplikacija.h.php");
include("../include/admin.h.php");
dbConnect();

$grupa=$_REQUEST['grupa'];
$podgrupa=$_REQUEST['podgrupa'];

if (!$grupa) $grupa=defaultGrupa();
if (!$podgrupa) $podgrupa=defaultPodgrupa($grupa);

$g=new grupa($grupa);
$p=new podgrupa($podgrupa);

adminHeader("&#268;LANCI- Unos &#269;lanka",$g->id);    

prazanRed();

$id=$_REQUEST[id];
$v=new clanak($id);
if (!$v->id) $v->id=0;

$f=new adminForma("UNOS &#268;LANKA","forma0","unos_clanka1.php",680,150);
$f->hidden("id",$v->id);
$f->hidden("grupa",$g->id);
$f->hidden("podgrupa",$p->id);

$f->pocetakGrupe("OSNOVNI PODACI",1);
$f->podatak("Grupa / Podgrupa",$g->naziv." / ".$p->naziv);
$f->prazanRed(2);
$f->textField("Naslov","naslov",$v->naslov,35,50,1);
$f->prazanRed(2);
$f->textArea2("Kratak tekst","tekst_kratki",$v->tekst_kratki,1,70,5);
$f->prazanRed(2);
$f->textArea2("Tekst","tekst",$v->tekst,1,70,20);
$f->prazanRed(2);

// Povezani clanak 1
$q_povezani=new query("select id from ".TAB_CLANCI." where aktivno=1 and id<>'".$v->id."' order by naslov");
$f->selectPocetak("Povezani &#269;lanak","povezani1");
$f->selectStavka("","");
for ($k=0; $k<$q_povezani->rows; $k++)
{
  $vv=new clanak($q_povezani->row[0]);
  if ($v->povezani1==$vv->id) $sel=1;
  $f->selectStavka($vv->naslov,$vv->id,$sel);
  unset($sel);
  $q_povezani->fetchRow();
}
$f->selectKraj();

/*
// Povezani clanak 2
$q_povezani=new query("select id from ".TAB_CLANCI." order by naslov");
$f->selectPocetak("Povezani &#269;lanak","povezani2");
$f->selectStavka("","");
for ($k=0; $k<$q_povezani->rows; $k++)
{
  $vv=new clanak($q_povezani->row[0]);
  if ($v->povezani2==$vv->id) $sel=1;
  $f->selectStavka($vv->naslov,$vv->id,$sel);
  unset($sel);
  $q_povezani->fetchRow();
}
$f->selectKraj();

// Povezani clanak 3
$q_povezani=new query("select id from ".TAB_CLANCI." order by naslov");
$f->selectPocetak("Povezani &#269;lanak","povezani3");
$f->selectStavka("","");
for ($k=0; $k<$q_povezani->rows; $k++)
{
  $vv=new clanak($q_povezani->row[0]);
  if ($v->povezani3==$vv->id) $sel=1;
  $f->selectStavka($vv->naslov,$vv->id,$sel);
  unset($sel);
  $q_povezani->fetchRow();
}
$f->selectKraj();
 
//Povezani clanak 4
$q_povezani=new query("select id from ".TAB_CLANCI." order by naslov");
$f->selectPocetak("Povezani &#269;lanak","povezani4");
$f->selectStavka("","");
for ($k=0; $k<$q_povezani->rows; $k++)
{
  $vv=new clanak($q_povezani->row[0]);
  if ($v->povezani4==$vv->id) $sel=1;
  $f->selectStavka($vv->naslov,$vv->id,$sel);
  unset($sel);
  $q_povezani->fetchRow();
}
$f->selectKraj();
*/
$f->krajGrupe();


$i=1;
while ($i<=MAX_SLIKA_PO_CLANKU)
{
  if ($v->slike[$i]->naziv) $otvoreno=1;
  else $otvoreno=0;
  $f->pocetakGrupe("SLIKA ".$i,$otvoreno);
  $f->slika("Slika ".$i,"slika".$i,SL_CLANAK,$v->id,$i,"brisanje_slike_clanka.php?id=".$v->id."&grupa=".$grupa."&podgrupa=".$podgrupa."&indeks=".$i,0);
  unset($otvoreno);
  $f->krajGrupe();
  $i++;
}


$f->pocetakGrupe("DODATNI PODACI",1);
//$f->textField("Prioritet izlistavanja","prioritet",$v->prioritet,2,3);
$f->prazanRed();
if (!$id) $aktivno=1; else $aktivno=$v->aktivno; 
$f->checkbox("Unos aktivan","aktivno",1,$aktivno);
unset($aktivno);
$f->krajGrupe();


$f->kraj();
prazanRed();

adminFooter();
dbDisconnect();
?>
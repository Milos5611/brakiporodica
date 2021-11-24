<?php
header("Content-type: image/png");

$broj=$_REQUEST['broj'];
$aktivna=$_REQUEST['aktivna'];

if (!$broj) $broj=1;
$slika=ImageCreate(20,16);

$boja_pozadine=ImageColorAllocate($slika,255,255,255);
$boja_slova=ImageColorAllocate($slika,0x1b,0x5f,0x9c);
$boja_aktivna=ImageColorAllocate($slika,0xff,0x66,0x00);
$boja_okvira=ImageColorAllocate($slika,0xcc,0xcc,0xcc);

$font="../../include/arialbd.ttf";
ImageFill($slika,2,2,$boja_pozadine);
ImageLine($slika,0,0,19,0,$boja_okvira);
ImageLine($slika,19,0,19,15,$boja_okvira);
ImageLine($slika,19,15,0,15,$boja_okvira);
ImageLine($slika,0,15,0,0,$boja_okvira);

if ($broj<10) $otklon=6;
else $otklon=3;

if ($aktivna)
{
  imagettftext($slika,10,0,$otklon,13,$boja_aktivna,$font,$broj);  
}
else
{
  imagettftext($slika,10,0,$otklon,13,$boja_slova,$font,$broj);
}


ImagePng($slika);
ImageDestroy($slika);

?>

<?php
include("include/aplikacija.h.php");
dbConnect();

$id=$_REQUEST['id'];
if (!$id)
{
  dbDisconnect();  
  header("Location: index.php");  
  exit;
}

$v=new vest($id);
$grupa=101;
$podgrupa=0;

appHeader($grupa,$podgrupa);

echo "
<table border='0' cellpadding='0' cellspacing='0' id='tabDetalji'>
  <tr>
    <td>
      <table width='100%' border='0' cellpadding='0' cellspacing='0' id='tabDetaljiNaslov'>
        <tr>
          <td class='tabDetaljiNaslovTdNaslov'>".$v->naslov."</td>
          <td class='tabDetaljiNaslovTdDatum'>".stampUDatum2($v->stamp_unosa)."</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class='tabListaSep'></td>
  </tr>
  <tr>
    <td class='tabDetaljiSep2'>&nbsp;</td>
  </tr>
  <tr>
    <td class='tekst'>
"; 
    
if ($v->slike[1]->naziv) echo "<a href='".$v->slike[1]->path.$v->slike[1]->naziv."' class='galerija'><img src='".$v->slike[1]->path.$v->slike[1]->naziv_srednja."' width='".$v->slike[1]->srednja_sirina."' height='".$v->slike[1]->srednja_visina."' class='detaljiSlika' border='0' align='right' /></a>";    
    
echo nl2br($v->tekst); 
    

    
echo "</td>
  </tr>
  <tr>
    <td class='tabDetaljiSep2'>&nbsp;</td>
  </tr>
";

echo "  
</table>
";


appFooter($grupa);
dbDisconnect();
?>
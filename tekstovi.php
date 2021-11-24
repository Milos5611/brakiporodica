<?php
include("include/aplikacija.h.php");
dbConnect();

$grupa=$_REQUEST['grupa'];
if (!$grupa) $grupa=defaultGrupa();

$podgrupa=$_REQUEST['podgrupa'];
if (!$podgrupa) $podgrupa=defaultPodgrupa($grupa);

appHeader($grupa,$podgrupa);

echo "
          <table width='100%' border='0' cellpadding='0' cellspacing='0' id='tabLista'>

";



$strana=$_REQUEST[strana];
if (!$strana) $strana=1;
$lim=($strana-1)*MAX_CLANAKA;


$query="select id from ".TAB_CLANCI." where aktivno=1";
if ($podgrupa) $query.=" and parent='".$podgrupa."'";


$order=" order by stamp_unosa desc";
$limit=" limit ".$lim.",".MAX_CLANAKA;


$qb=new query($query);
$q=new query($query.$order.$limit);

$i=0;
while ($i<$q->rows)
{
  $v=new clanak($q->row[0]);
  echo "
            <tr>
              <td> 
              <table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabListaPre'>
                <tr>
  ";
  
      
  if ($v->slike[1]->naziv) echo "<td align='left' valign='top' class='tabListaPreTdSlika'><div class='divListaPreSlika'><img src='".$v->slike[1]->path.$v->slike[1]->naziv_mala."' width='".$v->slike[1]->mala_sirina."' height='".$v->slike[1]->mala_visina."' class='preSlika' border='0' /></div></td>";
  
  echo "                
                  <td valign='top' class='tabListaPreTdTekst'>
                  <span class='naslov'>".$v->naslov."</span><br />
                  <span class='tekst'>".$v->tekst_kratki."</span><br />
                  <div class='divListaProcitaj'><table border='0' cellpadding='0' cellspacing='0'><tr><td><a href='tekst.php?id=".$v->id."'><img src='img/lista_ico.gif' border='0' /></a></td>
                  <td class='procitaj'><a href='tekst.php?id=".$v->id."'>Pro&#269;itaj &#269;lanak</a></td></tr></table></div>
                  </td>
                </tr>
              </table>   
              
              </td>
            </tr>
            <tr>
              <td class='tabListaSep2'></td>
            </tr>
  ";

  if ($i<(MAX_CLANAKA-1))
  {
    echo "
            <tr>
              <td class='tabListaSep'></td>
            </tr>
            <tr>
              <td class='tabListaSep3'></td>
            </tr>
    ";   
  }

  unset($v);
  $q->fetchRow();
  $i++;
}

$sel=new selektor();
$sel->br_rezultata=$qb->rows;
$sel->max_rezultata=MAX_CLANAKA;
$sel->strana=$strana;
$sel->dodajPromenjivu("podgrupa",$podgrupa);




echo "
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>
";

$sel->ispis();

echo "              
              </td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
";


/*              
echo "              
              <table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabListaPre'>
                <tr>
                  <td align='left' valign='top' class='tabListaPreTdSlika'><div class='divListaPreSlika'><img src='img/tmp/prew.jpg' width='150' height='100' class='preSlika' /></div></td>
                  <td valign='top' class='tabListaPreTdTekst'>
                  <span class='naslov'>Glavne teme seminara</span><br />
                  <span class='tekst'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat consectetuer adipiscing...</span><br />
                  <div class='divListaProcitaj'><table border='0' cellpadding='0' cellspacing='0'><tr><td><a href='index.html'><img src='img/lista_ico.gif' border='0' /></a></td>
                  <td class='procitaj'><a href='index.html'>Procitaj clanak</a></td></tr></table></div>
                  </td>
                </tr>
              </table>
              
              </td>
            </tr>
            <tr>
              <td class='tabListaSep2'></td>
            </tr>
            <tr>
              <td class='tabListaSep'></td>
            </tr>
            <tr>
              <td class='tabListaSep3'></td>
            </tr>
            <tr>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabListaPre'>
                <tr>
                  <td align='left' valign='top' class='tabListaPreTdSlika'><div class='divListaPreSlika'><img src='img/tmp/prew.jpg' width='150' height='100' class='preSlika' /></div></td>
                  <td valign='top' class='tabListaPreTdTekst'><span class='naslov'>Glavne teme seminara</span><br />
                    <span class='tekst'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat consectetuer adipiscing...</span><br />
                    <div class='divListaProcitaj'>
                      <table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><a href='index.html'><img src='img/lista_ico.gif' border='0' /></a></td>
                          <td class='procitaj'><a href='index.html'>Procitaj clanak</a></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class='tabListaSep2'></td>
            </tr>
            <tr>
              <td class='tabListaSep'></td>
            </tr>
            <tr>
              <td class='tabListaSep3'></td>
            </tr>
            <tr>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabListaPre'>
                <tr>
                  <td align='left' valign='top' class='tabListaPreTdSlika'><div class='divListaPreSlika'><img src='img/tmp/prew.jpg' width='150' height='100' class='preSlika' /></div></td>
                  <td valign='top' class='tabListaPreTdTekst'><span class='naslov'>Glavne teme seminara</span><br />
                    <span class='tekst'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat consectetuer adipiscing...</span><br />
                    <div class='divListaProcitaj'>
                      <table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><a href='index.html'><img src='img/lista_ico.gif' border='0' /></a></td>
                          <td class='procitaj'><a href='index.html'>Procitaj clanak</a></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class='tabListaSep2'></td>
            </tr>
            <tr>
              <td class='tabListaSep'></td>
            </tr>
            <tr>
              <td class='tabListaSep3'></td>
            </tr>
            <tr>
              <td><table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabListaPre'>
                <tr>
                  <td align='left' valign='top' class='tabListaPreTdSlika'><div class='divListaPreSlika'><img src='img/tmp/prew.jpg' width='150' height='100' class='preSlika' /></div></td>
                  <td valign='top' class='tabListaPreTdTekst'><span class='naslov'>Glavne teme seminara</span><br />
                    <span class='tekst'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat consectetuer adipiscing...</span><br />
                    <div class='divListaProcitaj'>
                      <table border='0' cellpadding='0' cellspacing='0'>
                        <tr>
                          <td><a href='index.html'><img src='img/lista_ico.gif' border='0' /></a></td>
                          <td class='procitaj'><a href='index.html'>Procitaj clanak</a></td>
                        </tr>
                      </table>
                    </div></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td class='tabListaSep2'></td>
            </tr>
";
*/


appFooter($grupa);
dbDisconnect();
?>
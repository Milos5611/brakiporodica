<?php
include("include/aplikacija.h.php");
dbConnect();

$grupa=100;
$podgrupa=0;

appHeader($grupa,$podgrupa);




echo "
<form action='mail.php' method='post'>
 <table border='0' cellpadding='0' cellspacing='0' id='tabKontakt'>
            <tr>
              <td colspan='2' class='kontaktNaslov'>Postavite pitanje</td>
              </tr>
            <tr>
              <td colspan='2'>&nbsp;</td>
              </tr>
            <tr>
              <td class='kontaktPodatak'>Va&#353;a e-mail adresa:</td>
              <td valign='top'>

              <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td class='kontaktTextfieldTd'><input name='adresa' type='text' class='kontaktTextField' id='adresa' size='55' maxlength='100' class='kontaktTextField' /></td>
                  <td>&nbsp;</td>
                </tr>
              </table>              
              
              </td>
            </tr>
            <tr>
              <td class='kontaktPodatak'>Naslov poruke:</td>
              <td valign='top'>
              
              <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td class='kontaktTextfieldTd'><input name='naslov' type='text' class='kontaktTextField' id='naslov' size='55' maxlength='100' class='kontaktTextField' /></td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              
              </td>
            </tr>
            <tr>
              <td class='kontaktPodatak'>Pitanje/komentar:</td>
              <td valign='top'>

              <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                <tr>
                  <td class='kontaktTextAreaTd'><textarea name='tekst' class='kontaktTextArea' id='tekst' class='kontaktTextArea'></textarea></td>
                  <td>&nbsp;</td>
                  </tr>
                </table>              
              
              </td>
            </tr>
            <tr>
              <td colspan='2'>&nbsp;</td>
              </tr>
              
              <tr>
                <td colspan='2'>
              <table width='100%' border='0' cellpadding='0' cellspacing='0' class='tabPosalji'>
                <tr>
                  <td class='tabSlicanClanakTdSep'>&nbsp;</td>
                  <td class='tabSlicanClanakTdStrelica'><img src='img/detalji_ico.gif' /></td>
                  <td class='tabPosaljiTdPosalji'><input type='image' src='img/kontakt_posalji.gif' width='40' height='20' onClick='return proveraForme()' /></td>
                </tr>
              </table>
                </td>
              </tr>
                
              
            <tr>
              <td colspan='2'></td>
            </tr>
            <tr>
              <td colspan='2'>&nbsp;</td>
            </tr>
            <tr>
              <td colspan='2'>&nbsp;</td>
              </tr>
            <tr>
              <td colspan='2' class='kontaktNaslov'>Kontakt</td>
              </tr>
            <tr>
              <td colspan='2'>&nbsp;</td>
            </tr>
            <tr>
              <td colspan='2' class='kontaktVrednost'>Udru&#382;enje za o&#269;uvanje i razvoj porodice &quot;Brak i porodica&quot;</td>
              </tr>
            <tr>
              <td colspan='2' class='kontaktVrednost'>Požeška 83a 2. sprat</td>
              </tr>
            <tr>
              <td colspan='2' class='kontaktVrednost'>11030 Beograd</td>
              </tr>
            <tr>
              <td colspan='2'>&nbsp;</td>
            </tr>
            <tr>
              <td colspan='2' class='kontaktVrednost'>mob. 063/248-748</td>
              </tr>
            <tr>
              <td colspan='2' class='kontaktVrednost'>mob. 063/700-00-52</td>
              </tr>
            <tr>
              <td colspan='2' class='kontaktVrednost'>email: <a href='mailto:office@brakiporodica.org'>office@brakiporodica.org</a></td>
              </tr>
            <tr>
              <td colspan='2'>&nbsp;</td>
              </tr>
          </table>
          </form>
";


echo "
<script language='javascript'>

function proveraForme()
{
  var adresa=document.getElementById(\"adresa\");
  if (!adresa.value)
  {
    alert('Niste uneli vasu e-mail adresu!');
    adresa.focus();
    return false;
  }
  
  var naslov=document.getElementById(\"naslov\");
  if (!naslov.value)
  {
    alert('Niste uneli naslov poruke!');
    naslov.focus();
    return false;
  }

  var tekst=document.getElementById(\"tekst\");
  if (!tekst.value)
  {
    alert('Niste uneli tekst poruke!');
    tekst.focus();
    return false;
  }  

  return true;
}

</script>    
"; 

appFooter($grupa);
dbDisconnect();
?>
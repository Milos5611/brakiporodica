<?php
include("include/aplikacija.h.php");
dbConnect();

$grupa=100;
$podgrupa=0;

appHeader($grupa,$podgrupa);


$adresa=$_POST['adresa'];
$naslov=$_POST['naslov'];
$tekst=$_POST['tekst'];

echo "<table border='0' cellpadding='0' cellspacing='0' id='tabKontakt'>";

if (!$adresa)
{
  echo "
            <tr>
              <td class='kontaktVrednost'>Niste uneli vasu e-mail adresu.</td>
            </tr>  
  ";    
}
if (!$naslov)
{
  echo "
            <tr>
              <td class='kontaktVrednost'>Niste uneli naslov poruke.</td>
            </tr>  
  ";    
}
if (!$tekst)
{
  echo "
            <tr>
              <td class='kontaktVrednost'>Niste uneli tekst poruke.</td>
            </tr>  
  ";    
}

if (!$adresa || !$naslov || !$tekst)
{
  echo "
            <tr>
              <td class='kontaktVrednost'>Niste uneli uneli sve neophodne podatke. Pokusajte ponovo...</td>
            </tr>  
  ";    
}
else
{
  $email="office@brakiporodica.org";
  $from_adresa="website@brakiporodica.org"; 
  $slanje=mail($email,$naslov,"Adresa: ".$adresa."\n\n".$tekst,"From: ".$from_adresa."\r\n"."Reply-To: ".$adresa."\r\n");
  if ($slanje)
  {
    echo "
            <tr>
              <td class='kontaktVrednost'>Poruka poslata. Hvala!</td>
            </tr>  "; 
           /* <tr>
              <td class='kontaktVrednost'>".stampUVreme(stamp())."</td>
            </tr>  */
              
    
  }
  else
  {
    echo "
            <tr>
              <td class='kontaktVrednost'>Poruka nije poslata...</td>
            </tr>  
    ";      
  }
 
}


echo "
            <tr>
              <td colspan='2'>&nbsp;</td>
              </tr>
          </table>
";

/*
$subject=$_POST[subject];
$text=$_POST[text];
$from=$_POST[from];
$email="bogdan@tastenwelt.at";
$from_adresa="website@tastenwelt.at";

if (!$subject)
{
  echo "Invalid message subject.<br>";
}
if (!$text)
{
  echo "Invalid message text.<br>";
}
if (!$from)
{
  echo "Invalid reply to adress.<br>";
}

if (!$subject || !$text || !$from)
{
  echo "Pease fill out the form.";   
}
else
{
  $slanje=mail($email,$subject,$text,"From: ".$from_adresa."\r\n"."Reply-To: ".$from."\r\n");
  if ($slanje)
  {
    echo "Message sent. Thank you!";   
  }
}

*/

appFooter($grupa);
dbDisconnect();
?>
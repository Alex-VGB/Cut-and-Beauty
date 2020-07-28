<?php
if (isset ($_POST['contactFF'])) {
  $to = "cutandbeauty@op.pl";
  $from = $_POST['contactFF'];
  $subject = "Cut&Beauty Form";
  $message = "Imię: "
              .$_POST['nameFF'].
             "\nNazwisko: "
              .$_POST['surNameFF'].
             "\nEmail: "
              .$from.
             "\nTel: "
             .$_POST['telephoneFF'].
             "\nWiadomość: "
              .$_POST['messageFF'];
  $boundary = md5(date('r', time()));
  $filesize = '';
  $headers = "MIME-Version: 1.0\r\n";
  $headers .= "From: " . $from . "\r\n";
  $headers .= "Reply-To: " . $from . "\r\n";
  $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
  $message="
Content-Type: multipart/mixed; boundary=\"$boundary\"

--$boundary
Content-Type: text/plain; charset=\"utf-8\"
Content-Transfer-Encoding: 7bit

$message";
  for($i=0;$i<count($_FILES['fileFF']['name']);$i++) {
      if(is_uploaded_file($_FILES['fileFF']['tmp_name'][$i])) {
         $attachment = chunk_split(base64_encode(file_get_contents($_FILES['fileFF']['tmp_name'][$i])));
         $filename = $_FILES['fileFF']['name'][$i];
         $filetype = $_FILES['fileFF']['type'][$i];
         $filesize += $_FILES['fileFF']['size'][$i];
         $message.="

--$boundary
Content-Type: \"$filetype\"; name=\"$filename\"
Content-Transfer-Encoding: base64
Content-Disposition: attachment; filename=\"$filename\"

$attachment";
     }
   }
   $message.="
--$boundary--";

  if ($filesize < 10000000) {
    mail($to, $subject, $message, $headers);
    $output = '<div>"Wiadomość została wysłana"</div>';
  } else {
    $output = '<div>"Przepraszamy, list nie został wysłany. Rozmiar pliku przekracza 10 MB."<div>';
  }
}
?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="https://cutandbeauty.pl/image/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://cutandbeauty.pl/image/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://cutandbeauty.pl/image/fav/favicon-16x16.png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,500,900&display=swap&subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="css/sKontakt.css">
    <link rel="stylesheet" href="../media.css">
    <title>Cut & Beauty - Kontakt</title>
</head>

<body>
<div class="container">
  <header id="navbar">
            <a href="https://cutandbeauty.pl" class="logo"></a>
            <ul>
                <li><a href="https://cutandbeauty.pl/" class="active">Home</a></li>
                <li><a class="hideMenu" href="https://cutandbeauty.pl/#uslugi">Usługi</a></li>
                <li><a class="hideMenu" href="https://cutandbeauty.pl/#stylisci">Styliści</a></li>
                <li><a href="https://www.moment.pl/cut-beauty-studio-urody">Rezerwacja</a></li>
                <li><a href="https://cutandbeauty.pl/galeria">Galeria</a></li>
                <li><a href="https://cutandbeauty.pl/kontakt">Kontakt</a></li>
            </ul>
            <span class="menuIcon" onclick="menuToggle();"></span>
  </header>  


  <form enctype="multipart/form-data" method="post" id="feedback-form">
    <div class="containerForm">
        <div class="contactInfo">
            <div>
                <h2>Dane kontaktowe</h2>
                <ul class="info">
                    <li>
                        <span><img src="img/location.svg" alt="loc"></span>
                        <span>ul.Harfowa 11 lok. U3<br>
                            Warsaw, Poland 02-389</span>
                    </li>
                    <li>
                        <span><img src="img/mail.svg" alt="mail"></span>
                        <span><a href="mailto:cutandbeauty@op.pl">cutandbeauty@op.pl</a></span>
                    </li>
                    <li>
                        <span><img src="img/call.svg" alt="call"></span>
                        <span><a href="tel:+48535607503">+48 535 607 503</a></span>
                    </li>
                </ul>
                <ul class="sci">
                    <li><a href="https://www.facebook.com/CutBeautyStudioUrody/"><img src="img/facebook.svg" alt="facebook"></a></li>
                    <li><a href="https://www.instagram.com/cutandbeautystudio/"><img src="img/instagram.svg" alt="instagram"></a></li>
                </ul>
            </div>
        </div>
        <div class="contactForm">
            <h2>Napisz do nas</h2>
            <div class="formBox">
                <div class="inputBox w50">
                    <input type="text" required name="nameFF" id="nameFF">
                    <span for="nameFF">Imię</span>
                </div>
                <div class="inputBox w50">
                    <input type="text" required name="surNameFF" id="surNameFF">
                    <span for="surNameFF">Nazwisko</span>
                </div>
                <div class="inputBox w50">
                    <input type="email" required name="contactFF" id="contactFF">
                    <span for="contactFF">Email</span>
                </div>
                <div class="inputBox w50">
                    <input type="text" required name="telephoneFF" id="telephoneFF">
                    <span for="telephoneFF">Telefon</span>
                </div>
                <div class="inputBox w100">
                    <input type="file" name="fileFF[]" multiple id="fileFF">
                    <span for="fileFF">.</span>
                </div>
                <div class="inputBox w100">
                    <textarea required name="messageFF" id="messageFF"></textarea>
                    <span for="messageFF">Treść Wiadomości..</span>
                </div>
                <div style="margin-top: -30px;line-height: 15px;">
                    <input type="checkbox" id="scales" name="scales" required>
                    <label style="font-size:10px;" for="scales">Korzystając z formularza, zgadzasz się na przechowywanie i przetwarzanie
                         Twoich danych przez witrynę oraz przetwarzanie Twoich danych osobowych w celu przekazywania
                          informacji dotyczących skierowanego przez Ciebie zapytania w formularzu kontaktowym do firmy
                          cutandbeauty.pl. </label>
                </div>
<?php echo $output; ?>
                <div class="inputBox w100">
                    <input type="submit" id="submitFF" value="Wyślij"><span></span>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
    <!--------------- Footer --------------->
    <footer>
    <div class="containerFooter">
        <div class="containerFooterBoxes">
            <div class="footerBox">
                <h4>Menu</h4>
                <div class="footerList">
                    <p><a href="https://cutandbeauty.pl/#uslugi">Usługi</a></p>
                    <p><a href="https://www.moment.pl/cut-beauty-studio-urody">Rezerwacja</a></p>
                    <p><a href="https://cutandbeauty.pl/#stylisci">Styliści</a></p>
                </div>
            </div>
            <div class="footerBox">
                <h4>Kontakt</h4>
                <div class="footerList">
                    <p><a href="mailto:cutandbeauty@op.pl">cutandbeauty@op.pl</a></p>
                    <p><a href="tel:+48535607503">+48 535 607 503</a></p>
                    <div class="icons">
                        <ul class="sci">
                            <li>
                                <a href="https://www.facebook.com/CutBeautyStudioUrody/"><img class="icon ic" src="../../image/facebook.svg" alt="fb"></a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/cutandbeautystudio/"><img class="icon" src="../../image/instagram.svg" alt="in"></a>
                            </li>
                        </ul>
                </div>
                </div>
            </div>
            <div class="footerBox">
                <h4>Adres</h4>
                <div class="footerList">
                    <p>ul.Harfowa 11 lok. U3</p>
                    <p>Warsaw</p>
                    <p>Poland 02-389</p>
                </div>
            </div>
        </div>
    </div>
</footer>
      <!---------------// Footer --------------->
<script src="../main.js"></script>
</body>
</html>
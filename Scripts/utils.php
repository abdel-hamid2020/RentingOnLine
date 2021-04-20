<?php

$page_list = array(
    array(
        "name" => "Accueil",
        "title" => "Accueil",
        "menutitle" => "Accueil"),
    array(
        "name" => "Deposer une annonce",
        "title" => " Deposer une annonce",
        "menutitle" => "annonce"),
    array(
        "name" => "connection",
        "title" => "connection ",
        "menutitle" => "connection"),
    array(
        "name" => "register",
        "title" => "inscription ",
    ),
    array(
        "name" => "compte",
        "title" => "compte",
    ),
     array(
        "name" => "condition",
        "title" => "condition d'utilisation ",
    ),
     array(
        "name" => "contact",
        "title" => "Nous contacter ",
    ),
);

function generateHTMLHeader($titre) {
    echo <<<CHAINE_DE_FIN
<!DOCTYPE html>
<html lang="fr">
    <head>
        
        <title>$titre</title>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta charset="utf-8">
        <meta name="author" content="Nom de l'auteur"/>
        <meta name="keywords" content="Mots clefs relatifs à cette page"/>
        <meta name="description" content="Descriptif court"/>


      
        <script  src="js/jquery-1.11.0.min.js"></script>
        <script src="js/hide2.js"></script>
        <script src="js/contact.js"></script>
         <script src="https://d19m59y37dris4.cloudfront.net/directory/1-6/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Select-->
    <script src="https://d19m59y37dris4.cloudfront.net/directory/1-6/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
             <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
              <script src="js/jquery-ui.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">   
        <link href="css/perso.css" rel="stylesheet">  
        <!-- theme stylesheet-->
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://d19m59y37dris4.cloudfront.net/directory/1-6/css/style.default.452e11c7.css" id="theme-stylesheet">
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="css/personnel.css">
      <link rel="stylesheet" href="css/contact.css">
            <style>
<!--
#goog-gt-tt {display:none !important;}
.goog-te-banner-frame {display:none !important;}
.goog-te-menu-value:hover {text-decoration:none !important;}
.goog-te-gadget-icon {background-image:url(//gtranslate.net/flags/gt_logo_19x19.gif) !important;background-position:0 0 !important;}
body {top:0 !important;}
-->
</style>
</head>
CHAINE_DE_FIN;
if($titre=="compte"){
        echo<<<END
       <body style=" background-image:url(images/fd5.jpg); background-size: 100% ;
            background-repeat:repeat; padding-top : 5%">
        
END;}
     else{
          echo<<<END
     <body class='bod'>
       
END;}}


function chekPage($askedPage) {
    global $page_list;
    foreach ($page_list as $page) {
        if ($page['name'] == $askedPage) {
            return true;
        }
    }return false;
}

function getPageTitle($askedPage) {
    global $page_list;
    foreach ($page_list as $page) {
        if ($page['name'] == $askedPage) {
            return $page['title'];
        }
    }return 'erreur';
}



function generateMenu() {
    if (isset($_SESSION['loggedIn'])&&$_SESSION['loggedIn']) {
        echo<<<CHAINE_DE_FIN
    <nav class = "navbar navbar-expand-lg navbar-fixed-top shadow navbar-light bg-white">
       <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          Menu <i id="Menu" class="fas fa-bars"></i>
      </button>
    <a class = "navbar-brand" href = "index.php?page=Accueil">
    <img src = "images/logo2.png" height = "40" class = "d-inline-block align-top" alt = "" loading = "lazy">
    </a>
     </div>
     <div class="collapse navbar-collapse" id="myNavbar">
    <ul class = "navbar-nav ml-auto navbar-right">
    <li><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
</svg><button class = "btn btn-outline-success" type = "button" role="link" onClick = "window.location = 'index.php?page=annonce'" > deposer une annonce</button></li>
    <li><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
  <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
  <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
</svg><button class = "btn btn-outline-success" type = "button" role="link" onClick = "window.location='index.php?page=compte'"> mon compte</button></li>
    <li><span class="glyphicon glyphicon-log-out"></span><button class = "btn btn-outline-success" type = "button" role="link" onClick = "window.location='index.php?page=Accueil&todo=logout'">déconnexion</button></li>
    </ul>
      </div>
        </div>
    </nav >
   <div>
        <!-- GTranslate: https://gtranslate.io/ -->
<div id="google_translate_element"></div>
<script>
function googleTranslateElementInit() {new google.translate.TranslateElement({pageLanguage: 'fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE,autoDisplay: false, includedLanguages: ''}, 'google_translate_element');}
</script><script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
       </div>
CHAINE_DE_FIN;
         
    } else {
        echo<<<CHAINE_DE_FIN
    <nav class = "navbar navbar-expand-sm navbar-fixed-top shadow navbar-light bg-white">
     <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          Menu <i class="fas fa-bars"></i>
      </button>
    <a class = "navbar-brand" href ="index.php?page=Accueil">
    <img src = "images/logo2.png" height = "40" class = "d-inline-block align-top" alt = "logo" loading = "lazy">
    </a>
     </div>
      <div class="collapse navbar-collapse" id="myNavbar">
    <ul class = "navbar-nav ml-auto navbar-right">
    <li><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM4 14a1 1 0 1 1 2 0 1 1 0 0 1-2 0zm7 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z"/>
</svg><button class = "btn btn-outline-success navbar-btn" type = "button" role="link" onClick = "window.location='index.php?page=annonce'"> deposer une annonce</button></li>
    <li><span class="glyphicon glyphicon-log-in"></span><button class = "btn btn-outline-success navbar-btn" type = "button" role="link" onClick = "window.location='index.php?page=connection'">se connecter </button></li>
    <li><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg><button class = "btn btn-outline-success navbar-btn" type = "button" role="link" onClick = "window.location='index.php?page=register'">cree un compte</button></li>
    </ul>
     </div>
     </div>
    </nav >
       <div>
          <!-- GTranslate: https://gtranslate.io/ -->
<div id='google_translate_element'></div>
<script>
function googleTranslateElementInit() {new google.translate.TranslateElement({pageLanguage: 'fr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE,autoDisplay: false, includedLanguages: ''}, 'google_translate_element');}
</script><script src='https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'></script></div>
CHAINE_DE_FIN;
    }
}

function generateHTMLFooter() {
    echo <<<CHAINE_DE_FIN
    
    
    <!-- Footer -->
<footer class="page-footer font-small indigo" id="footer">

  <!-- Footer Links -->
  <div class="container">

    <!-- Grid row-->
    <div class="row text-center d-flex justify-content-center pt-5 mb-3">

      <!-- Grid column -->
      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="index.php?page=condition">Politique de confidentialité</a>
        </h6>
      </div>
      <!-- Grid column -->

       <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="index.php?page=contact">Nous contacter</a>
        </h6>
      </div>
      <!-- Grid column -->
      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="index.php?page=Accueil">Retourner a l'accueil</a>
        </h6>
      </div>
      



     

    </div>
    <!-- Grid row-->
    <hr class="rgba-white-light" style="margin: 0 15%;">

    <!-- Grid row-->
    <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">

      <!-- Grid column -->
      <div class="col-md-8 col-12 mt-5">
        <p style="line-height: 1.7rem">Mekani est le premier site mauritanien de location en ligne <br>
Mekani a toujours le plaisir de vous offrir les meilleures services ! <br>
Que ça soit pour vos annonces, pour créer votre site a vous ou pour autre chose ;) <br>
N’hésitez pas à nous contacter par mail  <br> Pour decouvrir plus de choses sur nous et nos services suivez nos comptes sur les reseau sociaux accessibles par les liens ci-dessous </p>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->
    <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">

    <!-- Grid row-->
    <div class="row pb-3">

      <!-- Grid column -->
      <div class="col-md-12">

        <div class="mb-5 flex-center">

          <!-- Facebook -->
          <a class="fb-ic" href=https://www.facebook.com/Mekani-%D9%85%D9%83%D8%A7%D9%86%D9%8A-101020815158873 >
            <i class="fab fa-facebook-f fa-lg white-text mr-4"> </i>
          </a>
        </div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Links -->


</footer>
<!-- Footer -->
</body>
 
</html>
CHAINE_DE_FIN;
}
function affichecondition(){
    echo<<<CHAINE_DE_FIN
    
    <div class="col-md-8 col-md-offset-2">
    <div style="background-color : rgb(152,188,254)">
     
<strong> Quels types de donnés nous collectons et ce que nous faisons avec : </strong> <br>
   Les seuls donnés que Mekani collecte sont les donnés que l’utilisateur nous fournis sur lui et ses annonces ! nous en profiterons pour améliorer nos services et pourrons organiser par exemple une compétition entre les meilleurs annonces <br>
vous disposez des droits suivants concernant vos données personnelles : <br>

<strong>Droits </strong><br>
Accès : il s'agit de votre droit d'obtenir la confirmation que vos données sont traitées ou non, et si oui, d'accéder à ces données ; <br>

Rectification : Les seules donnés que l’utilisateur peux rectifier sont son numéro de téléphone et son mot de passe les autres informations sont considérés inchangeables  et que la personne devait les donner correctes à son inscription sinon il est prié de supprimer son compte et donner ses informations correctes ; <br>

Suppression/Effacement : l’utilisateur  peut toujours supprimer ses annonces précédentes et le cas échéant l’intégralité de son compte ce qui veut dire la suppression de toute trace de la personne dans nos bases de donnés. <br>

Limitation : il s'agit de votre droit d'obtenir la limitation du traitement lorsque vous vous y opposez, lorsque vous contestez l'exactitude de vos données, lorsque vous pensez que leur traitement est illicite, ou lorsque vous en avez besoin pour la constatation, l'exercice ou la défense de vos droits en justice ; <br>

    </div>
    </div>
CHAINE_DE_FIN;
}
?>
   
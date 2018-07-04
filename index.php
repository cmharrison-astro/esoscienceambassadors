<!DOCTYPE html>
<html>

<title>ESO Science Ambassadors</title>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ESO, European Organisation for Astronomical Research in the Southern Hemisphere" />
<meta name="keywords" content="ESO, Astronomy, Astrophysics, Astronomie, Suedsternwarte, telescopes, planets,
stars, galaxies, universe, NTT, VLT, VLTI, ALMA, ELT, La Silla, Paranal, Garching, Chile, science, ambassadors, exoplanets" />

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">

<body>
  
<!--get language-->
  <?php
  $lang = $_GET['lang'];

  if (empty($lang)) {
    $lang='en';
  }

?>

<!-- Set up languages -->
<?php
$home_txt='Home';
$about_txt='About Us';
$resources_txt='Resources';
$exoplanets_txt='Exoplanets';
$foreveryone_txt='For Everyone';
$foreducators_txt='For Educators';
$explorePlanets_txt='EXPLORE YOUR<br>EXOPLANETS';

 if ($lang == 'en'){
   $about_txt='About Us';
   $resources_txt='Resources';
 }
 if ($lang == 'fr'){
   $about_txt='Sur';
   $resources_txt='Ressources';
   $explorePlanets_txt='EXPLOREZ VOS<br>EXOPLANETS';
 }

?>

<!-- Links Menu (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-eso">
    <div class="w3-col s3">
      <a href="#about" class="w3-button w3-block w3-eso"><?=$about_txt?></a>
    </div>
    <div class="w3-col s3">
      <a href="#exoplanets" class="w3-button w3-block w3-eso"><?=$exoplanets_txt?></a>
    </div>
    <div class="w3-col s3">
      <a href="#resources" class="w3-button w3-block w3-eso"><?=$resources_txt?></a>
    </div>  
    <div class="w3-dropdown-hover w3-display-topright">
      <button class="w3-button w3-black w3-small">Language <i class="arrow down"></i></button>
        <div id="Languages" class="w3-dropdown-content w3-bar-block w3-border">
          <a href="/?lang=fr" class="w3-bar-item w3-button">Fran&ccedilais</a>
          <a href="/?lang=en" class="w3-bar-item w3-button">English</a>
        </div>
    </div>
  </div>
</div>

<!-- Header with image -->
<header class="bgimg w3-display-container" id="home">
  <div class="w3-display-quartleft w3-center w3-eso">
    <a href="#exoplanets" class="w3-button w3-block w3-eso" style="font-size:25px"><?=$explorePlanets_txt?></a>
  </div>
  <div class="w3-display-bottomright w3-center w3-padding-large">
    <span class="w3-text-white">Credit:ESO/L. Calçada</span>
  </div>
</header>

<!-- apply large text to the whole page -->
<div class="w3-large">

<!-- 'About Us' Container -->
<!-- ++++++++++++++++++++ -->
<div class="w3-container" id="about">
<div class="w3-content" style="max-width:700px">
  
  <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide"><?=$about_txt?></span></h5>

    <div class="w3-container w3-padding-small w3-card w3-medium">
        <?php include 'pages/about/about_'.$lang.'.html';?>
    </div>
  

<!-- Slider for Action Photos (look in directory get image and metadata) -->
<div class="w3-content w3-display-container">

 <?php
$handle = opendir(dirname(realpath(__FILE__)).'/images/ambassadors/');
while($ambimages = readdir($handle)){
  
  if($ambimages !== '.' && $ambimages !== '..'){
    $exif = exif_read_data('images/ambassadors/'.$ambimages.'', 0, true);
    foreach ($exif['COMPUTED'] as $header => $value) {
        if($header==UserComment){$comment = $value;}
    }
    echo '<div class="w3-display-container mySlides"><img src="images/ambassadors/'.$ambimages.'" style="width:100%">
          <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black">'.$comment.'</div></div>';  
  }
  
  }

?>
<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>

</div>

</div>
</div>
  
<!-- Exoplanets Container -->
<!-- ++++++++++++++++++++ -->
<div class="w3-container" id="exoplanets">
  <div class="w3-content" style="max-width:700px">
 
    <h5 class="w3-center w3-padding-48"><span class="w3-tag w3-wide"><?=$exoplanets_txt?></span></h5>
<!-- Auto generated drop down menu from SQL table -->
<!-- Will then set the properties of animated exoplanet system -->
  <div class="w3-dropdown-click">
    <button onclick="myFunction()" class="w3-button w3-black">Select System!</button>
    <div id="Exoplanets" class="w3-dropdown-content w3-bar-block w3-border">
      <a href="#exoplanets" class="w3-bar-item w3-button">Kepler 7</a>
      <a href="#exoplanets" class="w3-bar-item w3-button">Trappist 1</a>
      <a href="#exoplanets" class="w3-bar-item w3-button">etc.</a>
    </div>
  </div>

<!-- Animated Exoplanet system -->
  <div class="space">  
    <div class="planet"></div>
    <div class="orbit"></div>
    <div class="sat" id="sat1"></div>
  </div>
 
  <!-- Resources Container -->
  <!-- ++++++++++++++++++++ -->
<div class="w3-container" id="resources">
  <div class="w3-content" style="max-width:700px">

    <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide"><?=$resources_txt?></span></h5>

   <div class="w3-row w3-center w3-card w3-padding">
      <a href="javascript:void(0)" onclick="openMenu(event, 'REveryone');" id="myLink">
        <div class="w3-col s6 tablink"><?=$foreveryone_txt?></div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'REducators');">
        <div class="w3-col s6 tablink"><?=$foreducators_txt?></div>
      </a>
    </div>

    <div id="REveryone" class="w3-container menu w3-padding-48 w3-card">
      <h5>Some Text</h5>
      <p class="w3-text-grey">Some Resources For Everyone (will contain links to images, videos etc.)</p><br>
    </div>
    
    <div id="REducators" class="w3-container menu w3-padding-48 w3-card">
      <h5>Some Other Text</h5>
      <p class="w3-text-grey">Some Resources for Educators (will contain links to educational resources - documents and such like.</p><br>
    </div>  

  </div>
  </div>

    <div class="w3-panel w3-leftbar w3-light-grey">
      <p><i>"Something profound"</i></p>
      <p>Some text</p>
    </div>
    
  </div>
</div>

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-48 w3-large">
  <p>Footer</p>
</footer>


<!-- Scripts, place somewhere else? -->
  <script src="scripts/orbits.js"></script>
  <script src="scripts/slider.js"></script>
  <script src="scripts/tabbed_menu.js"></script>
  <script src="scripts/dropdown_menu.js"></script>

</body>
</html>


<!DOCTYPE html>
<html>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-125571662-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-125571662-1');
  </script>

  <title>Biggest Eye on the Sky</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="ESO, European Organisation for Astronomical Research in the Southern Hemisphere" />
  <meta name="keywords" content="ESO, Astronomy, Astrophysics, Astronomie, Suedsternwarte, telescopes, planets, stars, galaxies, universe, NTT, VLT, VLTI, ALMA, ELT, La Silla, Paranal, Garching, Chile, science, ambassadors, exoplanets, biggest eye on the sky" />

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
</head>

<body>

<?php
  // development helper function
  function debugToConsole($msg) { 
    echo "<script>console.log(".json_encode($msg).")</script>";
  }
?>

<!-- database -->
<?php include ('./db-connection.php'); ?>

<!--get language here-->
<?php
  $lang = $_GET['lang'];

  if (empty($lang)) {
    $lang='en';
  }
?>

<!--get exoplanet here-->
<?php
  $exoName = $_GET['exoName'];
  if (empty($exoName)) {
    $exoName='Kepler_79';
  }
  $exoName_D = $_GET['exoName_D'];
  if (empty($exoName_D)) {
    $exoName_D='Kepler_79';
  }
?>


<!-- Set up languages -->
<?php
  $lang_file='lang_en.php';  

  if ($lang == 'fr'){
    $lang_file='lang_fr.php';
  }

  include_once 'languages/'.$lang_file;
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
          <a href="./?lang=fr" class="w3-bar-item w3-button">Fran&ccedilais</a>
          <a href="./?lang=en" class="w3-bar-item w3-button">English</a>
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
    <span class="w3-text-white">ESO/L. Calçada</span>
  </div>
</header>

<!-- apply large text to the whole page -->
<div class="w3-large">

<!-- 'About Us' Container -->
<!-- ++++++++++++++++++++ -->
<div class="w3-container" id="about"><br />
  <div class="w3-content" style="max-width:700px">
  
    <h5 class="w3-center w3-padding-24"><span class="w3-tag w3-wide"><?=$about_txt?></span></h5>

    <!-- Include About Us Text -->
    <div class="w3-container w3-padding-small w3-card w3-medium">
      <?php include 'pages/about/about_'.$lang.'.html';?>
    </div>
  
<!-- Slider for Action Photos (look in directory get image and metadata) -->
    <div class="w3-content w3-display-container">
      <?php
        $handle = opendir(dirname(realpath(__FILE__)).'/images/ambassadors/');
        while($ambimages = readdir($handle)){
    
          if($ambimages !== '.' && $ambimages !== '..' && $ambimages !== '.DS_Store'){
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
<div class="w3-container" id="exoplanets"><br />
  <div class="w3-content" style="max-width:700px">
 
    <h5 class="w3-center w3-padding-24"><span class="w3-tag w3-wide"><?=$exoplanets_txt?></span></h5>
    
    <!-- Auto generated drop down menu from SQL table -->
    <!-- Will then set the properties of animated exoplanet system -->
    <div class="w3-row">
      <div class="w3-col s5">
        <button onclick="chooseStarMenu()" class="w3-button w3-red"><?=$select_star_txt?><i class="arrow down"></i></button>
        <div id="Exoplanets" class="w3-dropdown-content w3-bar-block w3-border">
          <?php
            $sql = "SELECT star_name, star_name_2 FROM exoplanets";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
              while($row = $result->fetch_assoc()) {
                if($row["star_name_2"] != ""){
                echo '<a href="./?exoName='.$row["star_name_2"].'&exoName_D='.$row["star_name"].'#exoplanets" class="w3-bar-item w3-button">'.$row["star_name"].'</a>';
                }
              }
            } else {
            echo "0 results";
            }
          ?>
        </div>
      </div>
      <div style="w3-col s5"><?=$selected_star_txt?><span class="w3-tag w3-wide" style="background-color:#000000"><?=$exoName_D?></span></div>
    </div>


<!-- -->
    <div class="w3-content w3-display-container">

      <div class="w3-row w3-center w3-card w3-padding">
        <a href="javascript:void(0)" onclick="openMenu2(event, 'RAnimation');" id="myLink2">
        <div class="w3-col s4 tablink2"><?=$overview_txt?></div>
        </a>
        <a href="javascript:void(0)" onclick="openMenu2(event, 'RParticipants');">
        <div class="w3-col s4 tablink2"><?=$yourpics_txt?></div>
        </a>
        <a href="javascript:void(0)" onclick="openMenu2(event, 'RProfessional');">
        <div class="w3-col s4 tablink2"><?=$otherpics_txt?></div>
        </a>
      </div>

      <!-- Animated Exoplanet system -->
      <div id="RAnimation" class="w3-container menu2 w3-padding-48 w3-card">

      <?php
        //SQL query
        $sqlSystemProps = "SELECT 
        star_name, star_name_2, star_distance, star_teff, interesting_fact,
        name_a, name_b, name_c, name_d, name_e, name_f, name_g,
        mass_a, mass_b, mass_c, mass_d, mass_e, mass_f, mass_g,
        semi_major_axis_a, semi_major_axis_b, semi_major_axis_c, semi_major_axis_d, semi_major_axis_e, semi_major_axis_f, semi_major_axis_g,
        orbital_period_a, orbital_period_b, orbital_period_c, orbital_period_d, orbital_period_e, orbital_period_f, orbital_period_g
        FROM exoplanets WHERE star_name_2='$exoName'";
        $resultSystemProps = $conn->query($sqlSystemProps);

        //If successful query
        if ($resultSystemProps->num_rows == 1) {
          echo '<div class="w3-row w3-padding-small">';
          $row = $resultSystemProps->fetch_assoc();
          //Read raw data for planets and put into arrays
          $planetNames = array($row["name_a"],$row["name_b"],$row["name_c"],$row["name_d"],$row["name_e"],$row["name_f"],$row["name_g"]);
          $planetDistances = array($row["semi_major_axis_a"],$row["semi_major_axis_b"],$row["semi_major_axis_c"],$row["semi_major_axis_d"],$row["semi_major_axis_e"],$row["semi_major_axis_f"],$row["semi_major_axis_g"]);
          $planetPeriods = array($row["orbital_period_a"],$row["orbital_period_b"],$row["orbital_period_c"],$row["orbital_period_d"],$row["orbital_period_e"],$row["orbital_period_f"],$row["orbital_period_g"]);
          $planetMass = array($row["mass_a"],$row["mass_b"],$row["mass_c"],$row["mass_d"],$row["mass_e"],$row["mass_f"],$row["mass_g"]);

          //Count planets
          $nPlanet = 0;
          if ($row["name_a"]!=''){$nPlanet++;}
          if ($row["name_b"]!=''){$nPlanet++;}
          if ($row["name_c"]!=''){$nPlanet++;}
          if ($row["name_d"]!=''){$nPlanet++;}
          if ($row["name_e"]!=''){$nPlanet++;}
          if ($row["name_f"]!=''){$nPlanet++;}
          if ($row["name_g"]!=''){$nPlanet++;}
          
          //create arrays for css/java parameters
          $maxPlanetDist = max($planetDistances);
          $maxPlanetPeriod = max($planetPeriods);
          $maxPlanetMass = max($planetMass);
          $planetRValues = [0,0,0,0,0,0,0];
          $planetDaValues = [0,0,0,0,0,0,0];
          $planetSizeValues = [0,0,0,0,0,0,0];


          echo '<div class="w3-twothird w3-padding-large">
          <div class="space"> 
          <div class="star"></div>';
          //<div class="orbit"></div>

          for ($j = 0; $j<$nPlanet; $j++){
            //calculate css/java parameters based on real data
            $planetRValues[$j] = 200*$planetDistances[$j]/$maxPlanetDist;
            $planetSizeValues[$j] = 10*$planetMass[$j]/$maxPlanetMass;
            $planetDaValues[$j] = 0.005*$maxPlanetPeriod/$planetPeriods[$j];

            //create div for each planet
            echo '<div class="planet" id="planet'.$j.'" style="width:'.$planetSizeValues[$j].'px;height:'.$planetSizeValues[$j].'px"></div>';
          
          }
          echo '</div>';
          echo '</div>';
          echo '<div class="w3-third w3-padding-small">';
          echo '<b>Star Temp.:</b> '.number_format($row['star_teff']-273., 0, '.', ',').' C<br />';
          //if ($row['star_distance'] =! 0.0){echo '<b>Distance:</b> '.number_format($row['star_distance']*3.26156, 1, '.', ',').' light yrs<br />';}
          echo '<b>Fact</b> '.$row['interesting_fact'].'<br />';
          echo '<b>Confirmed planets:</b> '.$nPlanet.'<br />';
          for ($j = 0; $j<$nPlanet; $j++){
            echo $planetNames[$j].'<br />'; 
            //a='.$planetAvalues[$j].' dA='.$planetDaValues[$j].'size='. $planetSizeValues[$j].'<br />';  
            //echo "const planet".($j+1)." = new Planet('planet".($j+1)."', document.getElementById('planet".($j+1)."'), 0, ".$planetRValues[$j].", ".$planetDaValues[$j].");";   
          }
          echo '</div>';

         } else{
           echo "Problem fetching exoplanet data";
         }

         echo '</div>'; 
?>

      </div>
    
      <script>
        // grab the data in js 
        // TODO: cleanse data
        var row = <?=json_encode($row)?>;
        var planetRValues = <?=json_encode($planetRValues)?>;
        var planetSizeValues = <?=json_encode($planetSizeValues)?>;
        var planetDaValues = <?=json_encode($planetDaValues)?>;
      </script>

      <div id="RParticipants" class="w3-container menu2 w3-padding-48 w3-card">
        <?php
          $exohandle_pp = opendir(dirname(realpath(__FILE__)).'/images/exoplanets/'.$exoName.);
          while($exoimages_pp = readdir($exohandle_pp)){
            if($exoimages_pp !== '.' && $exoimages_pp !== '..'){
              echo '<div class="w3-display-container w3-center mySlides3"><img src="images/exoplanets/'.$exoName.'/'.$exoimages_pp.'" style="width:100%">
              </div>';  
            }
          }   
        ?>
        <button class="w3-button w3-display-left w3-black" onclick="plusDivs3(-1)">&#10094;</button>
        <button class="w3-button w3-display-right w3-black" onclick="plusDivs3(1)">&#10095;</button>
      </div> 

      <div id="RProfessional" class="w3-container menu2 w3-padding-48 w3-card">
        <?php
          $exohandle = opendir(dirname(realpath(__FILE__)).'/images/exoplanets/'.$exoName.'/professional/');
          while($exoimages = readdir($exohandle)){
            if($exoimages !== '.' && $exoimages !== '..'){
              $exif = exif_read_data('images/exoplanets/'.$exoName.'/professional/'.$exoimages.'', 0, true);
              foreach ($exif['IFD0'] as $header => $value) {
                if($header==Title){$comment = $value;}
                if($header==Author){$copyright = $value;}
              }
              echo '<div class="w3-display-container w3-center mySlides2"><img src="images/exoplanets/'.$exoName.'/professional/'.$exoimages.'" style="width:100%">
              <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black">'.$comment.'</div>
              <div class="w3-display-bottomright w3-small w3-container w3-padding-16 w3-black">'.$copyright.'</div>
              </div>';  
            }
          }   
        ?>
        <button class="w3-button w3-display-left w3-black" onclick="plusDivs2(-1)">&#10094;</button>
        <button class="w3-button w3-display-right w3-black" onclick="plusDivs2(1)">&#10095;</button>
      </div> 
    </div>
  </div>
 </div>

<!-- Resources Container -->
<!-- ++++++++++++++++++++ -->
<div class="w3-container" id="resources"><br />
  <div class="w3-content" style="max-width:700px">

    <h5 class="w3-center w3-padding-24"><span class="w3-tag w3-wide"><?=$resources_txt?></span></h5>

    <div class="w3-row w3-center w3-card w3-padding">
      <a href="javascript:void(0)" onclick="openMenu(event, 'REveryone');" id="myLink">
        <div class="w3-col s6 tablink"><?=$foreveryone_txt?></div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'REducators');">
        <div class="w3-col s6 tablink"><?=$foreducators_txt?></div>
      </a>
    </div>

    <div id="REveryone" class="w3-container menu w3-padding-16 w3-card">
      <h5>Extremely Large Telescope</h5>
      <div class="w3-row">
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="http://eso.org/public/unitedkingdom/images/archive/category/elt/" target="_blank" data-toggle="tooltip" title="Image Archive">
          <img src="images/general/elt_images.jpg" class="w3-round-xlarge" alt="ELT images" style="width:100%">
          <div class="w3-display-bottomleft w3-tiny w3-text-white" style="padding-left:20px;padding-bottom:5px">ESO/L. Calçada</div>
          </a>
        </div>
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="http://eso.org/public/unitedkingdom/videos/archive/category/elt/" target="_blank" data-toggle="tooltip" title="Video Archive">
          <img src="images/general/elt_movies.jpg" class="w3-round-xlarge" alt="ELT movies" style="width:100%"></a>
          <div class="w3-display-bottomleft w3-tiny w3-text-white" style="padding-left:20px;padding-bottom:5px">ESO/L. Calçada/ACe Consortium</div>
        </div>
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="https://www.eso.org/public/teles-instr/elt/" target="_blank" data-toggle="tooltip" title="Information">
          <img src="images/general/elt_info.jpg" class="w3-round-xlarge" alt="ELT information" style="width:100%"></a>
          <div class="w3-display-bottomleft w3-tiny w3-text-black" style="padding-left:20px;padding-bottom:5px">ESO</div>
        </div>
      </div>
      <h5><?=$exoplanets_txt?></h5>
      <div class="w3-row">
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="http://eso.org/public/unitedkingdom/images/archive/category/exoplanets/" target="_blank" data-toggle="tooltip" title="Image Archive">
          <img src="images/general/exoplanet_images.jpg" class="w3-round-xlarge" alt="Exoplanets images" style="width:100%">
          <div class="w3-display-bottomleft w3-tiny w3-text-white" style="padding-left:20px;padding-bottom:5px">ESO/N. Bartmann/spaceengine.org</div>
          </a>
        </div>
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="http://eso.org/public/unitedkingdom/videos/archive/category/exoplanets/" target="_blank" data-toggle="tooltip" title="Video Archive">
          <img src="images/general/exoplanet_movies.jpg" class="w3-round-xlarge" alt="Exoplanet movies" style="width:100%"></a>
          <div class="w3-display-bottomleft w3-tiny w3-text-white" style="padding-left:20px;padding-bottom:5px">ESO/L. Calçada</div>
        </div>
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="https://www.eso.org/public/science/exoplanets/" target="_blank" data-toggle="tooltip" title="Information">
          <img src="images/general/exoplanet_info.jpg" class="w3-round-xlarge" alt="Exoplanet information" style="width:100%"></a>
          <div class="w3-display-bottomleft w3-tiny w3-text-white" style="padding-left:20px;padding-bottom:5px">ESO</div>
        </div>
      </div>
      <h5>Atacama Pathfinder Experiment (APEX)</h5>
      <div class="w3-row">
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="http://eso.org/public/unitedkingdom/images/archive/category/apex/" target="_blank" data-toggle="tooltip" title="Image Archive">
          <img src="images/general/apex_images.jpg" class="w3-round-xlarge" alt="APEX images" style="width:100%">
          <div class="w3-display-bottomleft w3-tiny w3-text-white" style="padding-left:20px;padding-bottom:5px">F. Montenegro-Montes/ESO/APEX (MPIfR/ESO/OSO)</div>
          </a>
        </div>
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="http://eso.org/public/unitedkingdom/videos/archive/category/apex/" target="_blank" data-toggle="tooltip" title="Video Archive">
          <img src="images/general/apex_movies.jpg" class="w3-round-xlarge" alt="APEX movies" style="width:100%"></a>
          <div class="w3-display-bottomleft w3-tiny w3-text-white" style="padding-left:20px;padding-bottom:5px">ESO/B. Tafreshi</div>
        </div>
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="https://www.eso.org/public/teles-instr/apex/" target="_blank" data-toggle="tooltip" title="Information">
          <img src="images/general/apex_info.jpg" class="w3-round-xlarge" alt="APEX information" style="width:100%"></a>
          <div class="w3-display-bottomleft w3-tiny w3-text-white" style="padding-left:20px;padding-bottom:5px">ESO/Onsala Space Observatory/I. Lapkin</div>
        </div>
      </div>
      <h5>ESO</h5>
      <div class="w3-row">
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="https://www.eso.org/public/videos/archive/category/esocast/" target="_blank" data-toggle="tooltip" title="ESOCast">
          <img src="images/general/esocast.png"  alt="ESOCast" style="width:100%">
          </a>
        </div>
        <div class="w3-display-container w3-third w3-padding-small">
          <a href="https://supernova.eso.org" target="_blank" data-toggle="tooltip" title="ESO Supernova">
          <img src="images/general/es-logo-blue.jpg" alt="ESO Supernova" style="width:100%">
          </a>
        </div>
      </div>
    </div>
    
    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>

    <div id="REducators" class="w3-container menu w3-padding-48 w3-card">
      <?php include 'pages/educators/educators_'.$lang.'.html';?>
    </div>  

  </div>
</div>

  <div class="w3-panel w3-leftbar w3-light-grey">
    <p></p>
  </div>
    
  </div>
</div>

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-48 w3-large">
  <button onclick="creditPopUp()"><?=$credits_txt?></button>
  <script>
    function creditPopUp() {
      alert("Project Co-ordinators:\n Chris Harrison; Fabrizio Arrigoni Battaia; Lucy Moorcraft\nWebsite:\n Chris Harrison; Jasmin Patel\nAmbassadors:\n Richard Anderson\n Chiara Circosta\n Jesús M. Corral-Santana\n Jeremy Fensch\n Chris Harrison\n Aleksandra Hamanowicz\n Miranda Jarvis\n Hugo Messias\n Miguel Querejeta\n Jan Scholtz\n Dominika Wylezalek\n Anita Zanella\nTremendous support from:\n Mylene Andre\n Stella-Maria Chasiotis-Klingner\n Anne-Laure Cheffot\n Tania Johnston\n Mariya Lyubenova\n Nicole Shearer\n Nelma Silva\n Alasdair Thomson\n Wolfgang Vieser\n Sebastian Wassill\n Saskia\n Elizabeth\n Alex\nFinancial Support from ESO SSDF");
    }
  </script>
</footer>


<!-- Scripts -->
  <script src="dist/orbits.js"></script>
  <script src="dist/slider.js"></script>
  <script src="dist/slider2.js"></script>
  <script src="dist/slider3.js"></script>
  <script src="dist/tabbed_menu.js"></script>
  <script src="dist/tabbed_menu2.js"></script>
  <script src="dist/dropdown_menu.js"></script>

</body>
</html>

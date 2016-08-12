
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../project1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="../../project1/dist/css/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body> <!--background="../../project1/bg.JPG"> -->

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="../../project1/index.PHP">Home</a></li>
            <li><a href="#about">Champions</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <!-- Static Champions -->
    <div class="container">
      <div class="starter-template">
        <h1>CHAMPIONS</h1>

        <?php
          $apiKey = "6e7e852a-40df-447a-acf8-fe7cc07bdd4c";
          $arrayOfChampions = array ("Aatrox","Ahri","Akali","Alistar","Amumu","Anivia","Annie","Ashe","AurelionSol","Azir","Bard","Blitzcrank","Brand","Braum","Caitlyn","Cassiopeia","Chogath","Corki","Darius","Diana","DrMundo","Draven","Ekko","Elise","Evelynn","Ezreal","FiddleSticks","Fiora","Fizz","Galio","Gangplank","Garen","Gnar","Gragas","Graves","Hecarim","Heimerdinger","Illaoi","Irelia","Janna","JarvanIV","Jax","Jayce","Jhin","Jinx","Kalista","Karma","Karthus","Kassadin","Katarina","Kayle","Kennen","Khazix","Kindred","KogMaw","Leblanc","LeeSin","Leona","Lissandra","Lucian","Lulu","Lux","Malphite","Malzahar","Maokai","MasterYi","MissFortune","Mordekaiser","Morgana","Nami","Nasus","Nautilus","Nidalee","Nocturne","Nunu","Olaf","Orianna","Pantheon","Poppy","Quinn","Rammus","RekSai","Renekton","Rengar","Riven","Rumble","Ryze","Sejuani","Shaco","Shen","Shyvana","Singed","Sion","Sivir","Skarner","Sona","Soraka","Swain","Syndra","TahmKench","Taliyah","Talon","Taric","Teemo","Thresh","Tristana","Trundle","Tryndamere","TwistedFate","Twitch","Udyr","Urgot","Varus","Vayne","Veigar","Velkoz","Vi","Viktor","Vladimir","Volibear","Warwick","MonkeyKing","Xerath","XinZhao","Yasuo","Yorick","Zac","Zed","Ziggs","Zilean","Zyra");

          $urlAllChamp = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?champData=all&api_key=" .$apiKey;
          $jsonObjAllChamp = file_get_contents($urlAllChamp);
          $jsonOutputAllChamp = json_decode($jsonObjAllChamp);

          $allChampData = $jsonOutputAllChamp->data;
          
          //print_r($allChampData->Jax);
         for ($x = 0; $x < count($arrayOfChampions); $x++){
            $championName = $arrayOfChampions[$x];
            $allChampion = $allChampData->$championName;
            $allChampionName = $allChampion->key;
            $allChampionTitle= $allChampion->title;
            $allChampionLore = $allChampion->lore;
            $allChampionBlurb = $allChampion->blurb;
            $allChampionAllyTipsArray = $allChampion->allytips;
            $allChampionEnemyTipArry = $allChampion->enemytips;
            $allChampionPassive = $allChampion->passive;
            $allChampionAbilities = $allChampion->spells;


            $allChampionSkinsArray = $allChampion->skins;
            
            //image is clickable, once click the skins will display
            echo "<input type='image' onclick=display2('$championName') width = '10%' src = 'http://ddragon.leagueoflegends.com/cdn/6.16.1/img/champion/$championName.png'/>
            <p>$championName<p>
             <br>";

             echo"<p>Passive: $allChampionPassive->name<p>";

             $passiveImage = $allChampionPassive->image;
             echo"<img src ='http://ddragon.leagueoflegends.com/cdn/6.16.2/img/passive/$passiveImage->full'</>";
             echo"<p>$allChampionPassive->description $allChampionPassive->sanitizedDescription<p>";

           
             for ($a = 0; $a < count($allChampionAbilities); $a++){
              $abilityImage = $allChampionAbilities[$a]->image;
              $abiltiyName = $allChampionAbilities[$a]->name;
              $abilityDescription = $allChampionAbilities[$a]->description;
             // $abilitySanitizedDescription = $allChampionAbilities[$a]->sanitizedDescription;
              echo "<h3>$abiltiyName</h3>";
              echo "<img src = 'http://ddragon.leagueoflegends.com/cdn/6.16.2/img/spell/$abilityImage->full'</>";
              echo"<p>$abilityDescription<p><br>";
             // echo"<p>$abilitySanitizedDescription<p>";
             }
             echo "<h1> Champion Lore </h1>";

             echo"<p>$allChampionLore<p>";

            //added a skip so that the first default skin is not shown
            $skip = 0;
            //loop to print out the skins
            for ($y = 0; $y < count($allChampionSkinsArray); $y++){
              //using num instead of $y because for some reason the skin numbers jumps,
              $allChampionSkinName = $allChampionSkinsArray[$y]->name;
              if($skip != 0){ 
              $championSkin = $championName ."_" .$allChampionSkinsArray[$y]->num .".jpg";
              //skins are hidden by default
              echo "<img class = '$championName championSkin' style='display:none' width = '15%' src = 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/$championSkin'>";
              }
              else{
                $skip += 1;
              }
            }
            echo"<br>
                  <br>";

          }

        ?>

        <script>

         function display2(className){
       
        if (document.getElementsByClassName(className)[0].style.display == "none"){
          clearStatSummmaryView();
          var a = 0;
          var numOfElements = document.getElementsByClassName(className).length;
          while (a < numOfElements){
            document.getElementsByClassName(className)[a].style.display = "inline";
          a++;
          }
        }
        else{
           clearStatSummmaryView();
        }
      }


      function clearStatSummmaryView(){
        var a = 0;
          var numOfElements = document.getElementsByClassName("championSkin").length;
            while (a < numOfElements){
              document.getElementsByClassName("championSkin")[a].style.display = "none";
            a++;
            }

      }

        </script>
      </div>
    </div>




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../project1/dist/js/bootstrap.min.js"></script>

    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
  </body>
</html>


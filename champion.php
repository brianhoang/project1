
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
          $arrayOfChampions = array ("Aatrox","Ahri","Akali","Alistar","Amumu","Anivia","Annie","Ashe","AurelionSol","Azir","Bard","Blitzcrank","Brand","Braum","Caitlyn","Cassiopeia","Chogath","Corki","Darius","Diana","DrMundo","Draven","Ekko","Elise","Evelynn","Ezreal","FiddleSticks","Fiora","Fizz","Galio","Gangplank","Garen","Gnar","Gragas","Graves","Hecarim","Heimerdinger","Illaoi","Irelia","Janna","JarvanIV","Jax","Jayce","Jhin","Jinx","Kalista","Karma","Karthus","Kassadin","Katarina","Kayle","Kennen","Khazix","Kindred","Kled","KogMaw","Leblanc","LeeSin","Leona","Lissandra","Lucian","Lulu","Lux","Malphite","Malzahar","Maokai","MasterYi","MissFortune","Mordekaiser","Morgana","Nami","Nasus","Nautilus","Nidalee","Nocturne","Nunu","Olaf","Orianna","Pantheon","Poppy","Quinn","Rammus","RekSai","Renekton","Rengar","Riven","Rumble","Ryze","Sejuani","Shaco","Shen","Shyvana","Singed","Sion","Sivir","Skarner","Sona","Soraka","Swain","Syndra","TahmKench","Taliyah","Talon","Taric","Teemo","Thresh","Tristana","Trundle","Tryndamere","TwistedFate","Twitch","Udyr","Urgot","Varus","Vayne","Veigar","Velkoz","Vi","Viktor","Vladimir","Volibear","Warwick","MonkeyKing","Xerath","XinZhao","Yasuo","Yorick","Zac","Zed","Ziggs","Zilean","Zyra");

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

            $allChampionInfo = $allChampion->info;

            $allChampionSkinsArray = $allChampion->skins;

            $abilityIcon = $championName . "AbilityIcon";

            //div to separate all the champions 
            echo"<div id = '$championName'>";
            
            echo "<h1 style='position:fixed; font-size:25px; list-style-type:none;'>

              <li onclick= search('A')>A</li>
              <li onclick=search('B')>B</li>
              <li onclick=search('C')>C</li>
              <li onclick=search('D')>D</li>
              <li onclick=search('E')>E</li>
              <li onclick=search('F')>F</li>
              <li onclick=search('G')>G</li>
              <li onclick=search('H')>H</li>
              <li onclick=search('I')>I</li>
              <li onclick=search('J')>J</li>
              <li onclick=search('K')>K</li>
              <li onclick=search('L')>L</li>
              <li onclick=search('M')>M</li>
              <li onclick=search('N')>N</li>
              <li onclick=search('O')>O</li>
              <li onclick=search('P')>P</li>
              <li onclick=search('Q')>Q</li>
              <li onclick=search('R')>R</li>
              <li onclick=search('S')>S</li>
              <li onclick=search('T')>T</li>
              <li onclick=search('U')>U</li>
              <li onclick=search('V')>V</li>
              <li onclick=search('W')>W</li>
              <li onclick=search('X')>X</li>
              <li onclick=search('Y')>Y</li>
              <li onclick=search('Z')>Z</li>
          
            </h1>";

            //image is clickable, once click the skins will display
            echo "<input type='image' onclick=displayChampionAbilityDescription('$championName') src = 'http://ddragon.leagueoflegends.com/cdn/6.16.2/img/champion/$championName.png'/>";
            echo " <br>";

            echo "<p>Attack: $allChampionInfo->attack /10
                      Defense: $allChampionInfo->defense
                      Difficulty: $allChampionInfo->difficulty
                      Magic: $allChampionInfo->magic</p>";

            // echo"<p>Passive: $allChampionPassive->name<p>";

             $passiveImage = $allChampionPassive->image;
             echo"<input type='image' onclick=displayChampionAbilityDescription('$abilityIcon') src ='http://ddragon.leagueoflegends.com/cdn/6.16.2/img/passive/$passiveImage->full' />";
            // echo"<p class = '$abilityIcon abilityIcon' style='display:none' >$allChampionPassive->description $allChampionPassive->sanitizedDescription</p>";

            
             for ($a = 0; $a < count($allChampionAbilities); $a++){
              $abilityImage = $allChampionAbilities[$a]->image;
              $abiltiyName = $allChampionAbilities[$a]->name;
              $abilityDescription = $allChampionAbilities[$a]->description;
             

              //its a mess, i couldnt find a way to pass in two php vairables to a javascrpit function.
              // it has something to do with strings and quotatation marks. 
              //instead i passed in one variable, the concatination of the ability name + it's description 
              //for example "...AbilityIconX" with x being a number from 0-3
              $abilityIconNum = $abilityIcon .$a;
              $new = $abilityIconNum . $abilityDescription;
              //replaceing ' with * 
              $updatedString=str_replace("'s", "*s", $new);
              $abilityDescriptionString = '"' .$updatedString .'"';
             echo "<input type='image' id = '$abilityIconNum' class = 'abilityImage' onclick='displayChampionAbilityDescription($abilityDescriptionString)' style='-webkit-filter: grayscale(75%)' src = 'http://ddragon.leagueoflegends.com/cdn/6.16.2/img/spell/$abilityImage->full' />";

             //after displaying all the ability images, i display a nonvisbale p tag
             //this will display once the ability images are pressed
              if ($a==3){
              echo "<br>";
              $abilityIconNum2 = $abilityIconNum ."PTag";
              //i still needed a unique ID because this page will have all the champions 
              echo "<p id= '$abilityIconNum2' class='abilityDescriptionText' style='display:none' >wrwerwr</p>";
              }
             }
             
             echo "<h1> Champion Lore </h1>";

             echo"<p>$allChampionLore</p>";

            //added a skip so that the first default skin is not shown
           // $skip = 0;
            //loop to print out the skins
            for ($y = 0; $y < count($allChampionSkinsArray); $y++){
              //using num instead of $y because for some reason the skin numbers jumps,
              $allChampionSkinName = $allChampionSkinsArray[$y]->name;
            //  if($skip != 0){ 
              $championSkin = $championName ."_" .$allChampionSkinsArray[$y]->num .".jpg";
              //skins are hidden by default
              echo "<img class = 'championSkin' style='display:inline' width = '15%' src = 'http://ddragon.leagueoflegends.com/cdn/img/champion/loading/$championSkin' />";
              //}
              //else{
              //  $skip += 1;
              //}
            }
            echo"<br><br>";
            echo"</div>";

          }

        ?>

        <script>

        //pupose of this function is to change the hidden p tag to view whenever a button is pressed
        function displayChampionAbilityDescription(className){
          //im paring the passed in string
          var abilityDescription = className.substring(className.indexOf("AbilityIcon") + 12);
          var abilityName = className.substring(0, className.indexOf("AbilityIcon")+11);
          var abilityIconNum = className.substring(0, className.indexOf("AbilityIcon")+12);
          var abilityPTag = abilityName.concat("3PTag");
          
          clearStatSummmaryView("abilityDescriptionText");
          document.getElementById(abilityPTag).innerHTML = abilityDescription;
          document.getElementById(abilityPTag).style.display = "inline";

          document.getElementById(abilityIconNum).setAttribute("style","-webkit-filter:grayscale(0%)");

          //document.getElementById("MasterYiAbilityIcon3").scrollIntoView();
      }

      //will reset the abilitty description view when you click on another champion ability
      function clearStatSummmaryView(whatToClear){
        var a = 0;
        var b = 0;
        alert
          var numOfElements = document.getElementsByClassName(whatToClear).length;
          var numOfElements2 = document.getElementsByClassName("abilityImage").length;
            while (a < numOfElements){
            document.getElementsByClassName(whatToClear)[a].style.display = "none";
            a++;
            }

            while (b < numOfElements2){
            document.getElementsByClassName("abilityImage")[b].setAttribute("style","-webkit-filter:grayscale(75%)");
            b++;
            }
      }

      function search(letter){

        if(letter=='O'){
          document.getElementById("Olaf").scrollIntoView();
        }
      }
        </script>
      }
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


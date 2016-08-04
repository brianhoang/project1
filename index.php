
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

  <body>

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
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
        Name: <input type="text" name="sumName">
        <input type="submit">
    </form>

    

      <?php



      //******************************************************************************************************************************
      //********************************** ABOUT SUMMONER  *****************************************************************************
      //******************************************************************************************************************************

      //making it global in case i need to use it anywhere else
      global $summonerName, $summoner;
      //my unique api key
      $apiKey = "6e7e852a-40df-447a-acf8-fe7cc07bdd4c";

      //getting and storing what the user has entered AJAX
      if (isset($_POST['sumName'])) {
          // collect value of input field
          $summonerName = $_REQUEST['sumName'];
          if (empty($summonerName)) {
              echo "Name is empty";
          } 

          else {
          //remove whitespaces in summor name
            $summonerName = preg_replace('/\s+/', '', $summonerName);

            //sending api call and parsing json object
        $urlSummoner = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/" . $summonerName . "?api_key=" .$apiKey; 
        $jsonObj = file_get_contents($urlSummoner);
        $jsonOutput = json_decode($jsonObj);
        $summoner = $jsonOutput->$summonerName; // $summoner = $jsonOutput->{"beesonmyhead"}; 
        //print_r($summoner) = stdClass Object ( [id] => 28876594 [name] => bees on my head [profileIconId] => 1154 [summonerLevel] => 30 [revisionDate] => 1469664675000 )
        $summonerLevel = $summoner->summonerLevel;
        echo "<h2> Hello $summoner->name</h2>";
        echo "<p><img src='http://ddragon.leagueoflegends.com/cdn/6.15.1/img/profileicon/$summoner->profileIconId.png'></p>
              <p>Your summoner level is: $summonerLevel </p>"; 
        
        }

      } 

      ?>
      <h1>Overall Match Statistic</h1>

      <!-- Buttons for user to choose what to display -->
      <button class="btn btn-default btn-sm CoopVsAIBtn" onclick="display2('CoopVsAI')">CoopVsAI</button>
      <button class="btn btn-default btn-sm RankedSolo5x5Btn" onclick="display2('RankedSolo5x5')">RankedSolo5x5</button>
      <button class="btn btn-default btn-sm UnrankedBtn" onclick="display2('Unranked')">Unranked</button>
      <button class="btn btn-default btn-sm Unranked3x3Btn" onclick="display2('Unranked3x3')">Unranked3x3</button>
      <button class="btn btn-default btn-sm OneForAll5x5Btn" onclick="display2('OneForAll5x5')">OneForAll5x5</button>
      <button class="btn btn-default btn-sm AscensionBtn" onclick="display2('Ascension')">Ascension</button>
      <button class="btn btn-default btn-sm KingPoroBtn" onclick="display2('KingPoro')">KingPoro</button>
      <button class="btn btn-default btn-sm URFBtn" onclick="display2('URF')">URF</button>
      <button class="btn btn-default btn-sm SiegeBtn" onclick="display2('Siege')">Siege</button>
      <button class="btn btn-default btn-sm OdinUnrankedBtn" onclick="display2('OdinUnranked')">OdinUnranked</button>
      <button class="btn btn-default btn-sm AramUnranked5x5Btn" onclick="display2('AramUnranked5x5')">AramUnranked5x5</button>



      <script>
        
      function display2(className){
       
        if (document.getElementsByClassName(className)[0].style.display == "none"){
          clearStatSummmaryView();
          var a = 0;
          var numOfElements = document.getElementsByClassName(className).length;
          while (a < numOfElements){
            document.getElementsByClassName(className)[a].style.display = "block";
          a++;
          }
        }
        else{
           clearStatSummmaryView();
        }
      }


      function clearStatSummmaryView(){
        var a = 0;
          var numOfElements = document.getElementsByClassName("statSummaryView").length;
            while (a < numOfElements){
              document.getElementsByClassName("statSummaryView")[a].style.display = "none";
            a++;
            }

      }

      </script>

      <?php

      //******************************************************************************************************************************
      //********************************** SUMMONER SUMMARY *****************************************************************************
      //******************************************************************************************************************************



      $urlSummonerSummery = "https://na.api.pvp.net/api/lol/na/v1.3/stats/by-summoner/" . $summoner->id ."/summary?season=SEASON2016&api_key=" .$apiKey; 
      $jsonObjSummonerSummary = file_get_contents($urlSummonerSummery);
      $jsonOutputSummonerSummary = json_decode($jsonObjSummonerSummary);
      //print_r($jsonOutputSummonerSummary) = stdClass Object ( [summonerId] => 28876594 [playerStatSummaries] => Array ( [0] => stdClass Object ( [playerStatSummaryType] => CoopVsAI [wins] => 110 [modifyDate] => 1453340787000 [aggregatedStats] => stdClass Object ( [totalChampionKills] => 1067 [totalMinionKills] => 11953 [totalTurretsKilled] => 88 [totalNeutralMinionsKilled] => 2807 [totalAssists] => 1313 [maxChampionsKilled] => 6 [averageNodeCapture] => 3 [averageNodeNeutralize] => 5 [averageTeamObjective] => 1 [averageTotalPlayerScore] => 900 [averageCombatPlayerScore] => 219 [averageObjectivePlayerScore] => 681 [averageNodeCaptureAssist] => 3 [averageNodeNeutralizeAssist] => 2 [maxNodeCapture] => 3 [maxNodeNeutralize] => 5 [maxTeamObjective] => 1 [maxTotalPlayerScore] => 900 [maxCombatPlayerScore] => 219 [maxObjectivePlayerScore] => 681 [maxNodeCaptureAssist] => 3 [maxNodeNeutralizeAssist] => 2 [totalNodeNeutralize] => 5 [totalNodeCapture] => 3 [averageChampionsKilled] => 6 [averageNumDeaths] => 1 [averageAssists] => 6 [maxAssists] => 6 ) ) [1] => stdClass Object ( [playerStatSummaryType] => RankedSolo5x5 [wins] => 0 [losses] => 0 [modifyDate] => 1400973277000 [aggregatedStats] => stdClass Object ( ) ) [2] => stdClass Object ( [playerStatSummaryType] => Unranked [wins] => 51 [modifyDate] => 1453340787000 [aggregatedStats] => stdClass Object ( [totalChampionKills] => 373 [totalMinionKills] => 9491 [totalTurretsKilled] => 56 [totalNeutralMinionsKilled] => 871 [totalAssists] => 916 ) ) [3] => stdClass Object ( [playerStatSummaryType] => Unranked3x3 [wins] => 1 [modifyDate] => 1453340787000 [aggregatedStats] => stdClass Object ( [totalChampionKills] => 6 [totalMinionKills] => 176 [totalTurretsKilled] => 0 [totalNeutralMinionsKilled] => 18 [totalAssists] => 26 ) ) [4] => stdClass Object ( [playerStatSummaryType] => OneForAll5x5 [wins] => 0 [modifyDate] => 1468975755000 [aggregatedStats] => stdClass Object ( [totalChampionKills] => 20 [totalMinionKills] => 211 [totalTurretsKilled] => 2 [totalNeutralMinionsKilled] => 23 [totalAssists] => 11 ) ) [5] => stdClass Object ( [playerStatSummaryType] => Ascension [wins] => 4 [modifyDate] => 1469322054000 [aggregatedStats] => stdClass Object ( ) ) [6] => stdClass Object ( [playerStatSummaryType] => KingPoro [wins] => 9 [modifyDate] => 1469322054000 [aggregatedStats] => stdClass Object ( ) ) [7] => stdClass Object ( [playerStatSummaryType] => URF [wins] => 16 [modifyDate] => 1469322054000 [aggregatedStats] => stdClass Object ( [totalChampionKills] => 248 [totalMinionKills] => 2642 [totalTurretsKilled] => 39 [totalNeutralMinionsKilled] => 349 [totalAssists] => 406 ) ) [8] => stdClass Object ( [playerStatSummaryType] => Siege [wins] => 0 [modifyDate] => 1469395696000 [aggregatedStats] => stdClass Object ( ) ) [9] => stdClass Object ( [playerStatSummaryType] => OdinUnranked [wins] => 5 [modifyDate] => 1469663044000 [aggregatedStats] => stdClass Object ( [totalChampionKills] => 62 [totalAssists] => 166 [maxChampionsKilled] => 24 [averageNodeCapture] => 5 [averageNodeNeutralize] => 3 [averageTeamObjective] => 1 [averageTotalPlayerScore] => 1239 [averageCombatPlayerScore] => 81 [averageObjectivePlayerScore] => 253 [averageNodeCaptureAssist] => 1 [averageNodeNeutralizeAssist] => 2 [maxNodeCapture] => 7 [maxNodeNeutralize] => 5 [maxTeamObjective] => 1 [maxTotalPlayerScore] => 1971 [maxCombatPlayerScore] => 231 [maxObjectivePlayerScore] => 898 [maxNodeCaptureAssist] => 3 [maxNodeNeutralizeAssist] => 3 [totalNodeNeutralize] => 17 [totalNodeCapture] => 36 [averageChampionsKilled] => 9 [averageNumDeaths] => 9 [averageAssists] => 24 [maxAssists] => 57 ) ) [10] => stdClass Object ( [playerStatSummaryType] => AramUnranked5x5 [wins] => 1035 [modifyDate] => 1469664675000 [aggregatedStats] => stdClass Object ( [totalChampionKills] => 16452 [totalTurretsKilled] => 879 [totalAssists] => 44421 ) ) ) )
      $playerStatSummary = $jsonOutputSummonerSummary->{"playerStatSummaries"};

      $y = 0;
      //echo ("<div class = 'statSummaryView'>");
      while ($y < count($playerStatSummary)){
        $gameType = ($playerStatSummary[$y]->playerStatSummaryType);
        $gameWins = ($playerStatSummary[$y]->wins);
        $aggregatedStats = $playerStatSummary[$y]->{"aggregatedStats"};
        echo ("<h2 class='$gameType statSummaryView' style='display:none'>Game Type: $gameType</h2>");
        echo("<p class='$gameType statSummaryView' style='display:none' >Number of wins: $gameWins</p>");
        if(isset($aggregatedStats->totalChampionKills)){
          echo ("<p class='$gameType statSummaryView' style='display:none' >Total Champions Killed: $aggregatedStats->totalChampionKills</p>");}
        if(isset($aggregatedStats->totalMinionKills)){
          echo ("<p class='$gameType statSummaryView' style='display:none' >Total Minions Killed: $aggregatedStats->totalMinionKills</p>");}
        if(isset($aggregatedStats->totalTurretsKilled)){
          echo ("<p class='$gameType statSummaryView' style='display:none' >Total Turrets Killed: $aggregatedStats->totalTurretsKilled</p>");}
        if(isset($aggregatedStats->totalAssists)){
          echo ("<p class='$gameType statSummaryView' style='display:none' >Total Assits: $aggregatedStats->totalAssists</p>");}
        
        $y++;
      }
     // echo ("</div>");


      //******************************************************************************************************************************
      //********************************** FREE CHAMPION *****************************************************************************
      //******************************************************************************************************************************

      echo "<h1>Free champions this week</h1>";
      //free champion rotation
      $urlFreeChamp = "https://na.api.pvp.net/api/lol/na/v1.2/champion?freeToPlay=true&api_key=" .$apiKey;
      $jsonObjFreeChamp = file_get_contents($urlFreeChamp);
      $jsonOutputFreeChamp = json_decode($jsonObjFreeChamp);

      //freechamp contains array
      $freeChamp = $jsonOutputFreeChamp->{"champions"};

      //counts the number of elements in the array ie number of free champions (which normally is 10)
      $numberOfFreeChampions = count($freeChamp);

      $x = 0;
      while ($x < $numberOfFreeChampions){
          //getting the id of the availiable free champs (from array)
          $champID = $freeChamp[$x]->id;
          //looking up champion name by ID
          $urlChampionName = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/" .$champID . "?api_key=" .$apiKey;
          $jsonChampObj = file_get_contents($urlChampionName);
          $jsonOutputChamp = json_decode($jsonChampObj);
          //key == string name of champion 
          $champName = $jsonOutputChamp->key;
          //concating _0 to indicate that it is a splash art
          //$champName.= "_0"; 
          echo "<img src = 'http://ddragon.leagueoflegends.com/cdn/6.6.1/img/champion/$champName.png' width='10%' 'height=10%''>";
          if ($x==4){
            echo"<br>";
          }
          $x++; 
      }


      //******************************************************************************************************************************
      //********************************** SUMMONER MASTERY **************************************************************************
      //******************************************************************************************************************************


      $urlMastery = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/" .$summoner->id . "/masteries?api_key=" .$apiKey; 
      $jsonMasteryObj = file_get_contents($urlMastery);
      $jsonOutputMastery = json_decode($jsonMasteryObj);

      $summonerMastery = $jsonOutputMastery->{$summoner->id};
      $summonerMasteryPages = ($summonerMastery->{"pages"});

      echo "<h1>User Mastery</h1>";
      echo "
      <div class='dropdown'>
      <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Your Masteries
      <span class='caret'></span></button>
      <ul class='dropdown-menu'>";


    $numOfMasteries = count($summonerMasteryPages);
    $b=0;
   

    while ($b<$numOfMasteries){
       $c = 0;
      $str = "";
      $masteryName = $summonerMasteryPages[$b]->name;
      $summonerM = $summonerMasteryPages[$b]->masteries;
      while ($c < count($summonerM)){
       $str = $str . strval($summonerM[$c]->id);
      $c++;
      }
     
      echo" <button type='button' class='list-group-item' onclick=showMasteryInfo('$str')>$masteryName</button>";
      $b++;
    } 
    
    echo " </ul>
          </div>";
         
      // print_r(#summonerMasteryPages[0]) =  {"28876594":{"summonerId":28876594,"pages":[{"id":36284312,"name":"TANK ","current":false,"masteries":[{"id":6343,"rank":1},{"id":6311,"rank":5},{"id":6242,"rank":1},{"id":6221,"rank":1},{"id":6211,"rank":5},{"id":6322,"rank":1},{"id":6332,"rank":5},{"id":6232,"rank":5},{"id":6362,"rank":1},{"id":6352,"rank":5}]},{"id":36284314,"name":"AD ","current":false,"masteries":[{"id":6121,"rank":1},{"id":6311,"rank":5},{"id":6131,"rank":5},{"id":6221,"rank":1},{"id":6111,"rank":5},{"id":6232,"rank":1},{"id":6211,"rank":5},{"id":6142,"rank":1},{"id":6161,"rank":1},{"id":6151,"rank":5}]},{"id":36284315,"name":"ap mage","current":true,"masteries":[{"id":6342,"rank":1},{"id":6121,"rank":1},{"id":6111,"rank":5},{"id":6312,"rank":5},{"id":6142,"rank":1},{"id":6322,"rank":1},{"id":6332,"rank":5},{"id":6134,"rank":5},{"id":6352,"rank":5},{"id":6362,"rank":1}]},{"id":36284316,"name":"support","current":false,"masteries":[{"id":6223,"rank":1},{"id":6342,"rank":1},{"id":6241,"rank":1},{"id":6311,"rank":5},{"id":6211,"rank":5},{"id":6322,"rank":1},{"id":6332,"rank":5},{"id":6231,"rank":5},{"id":6352,"rank":5},{"id":6362,"rank":1}]}]}}
      




          //ALL MYSTERIES 
          $urlAllMasteries = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/mastery?masteryListData=all&api_key=" .$apiKey;
          $jsonObjAllMasteries = file_get_contents($urlAllMasteries);
          $jsonOutputAllMasteries = json_decode($jsonObjAllMasteries);

          $mysteryTree=$jsonOutputAllMasteries->tree;; //tree gives me the the mastery IDs in the tree
          $mysteryData=$jsonOutputAllMasteries->data; //data gives me the decription 
         

          echo"<h3>Cunning Tree</h3>";

          // Cunning Mastery Tree
          $cunningTreePosition = $mysteryTree->Cunning;

          $x = 0;

          while ($x < count($cunningTreePosition)){
            $cunningTreeItens = $cunningTreePosition[$x]->masteryTreeItems;
            $y=0;
            while ($y < count($cunningTreeItens)){
              if(isset($cunningTreeItens[$y]->masteryId)){
                $cunningTreeItemID = $cunningTreeItens[$y]->masteryId;
                $mysteryInformation=$mysteryData->{$cunningTreeItemID};
                $mysteryName = $mysteryInformation->name ."\n\n";
                $mysteryDescription = $mysteryInformation->description;

                $z=0;
                $string="";
                while($z < count($mysteryDescription)){
                  $string = $string . $mysteryDescription[$z] ."\n";
                  $z++;
                }
              $total=$mysteryName . $string;
              $total2=str_replace("'s", "\"s", $total);

              echo "<img data-toggle='tooltip' data-placement='top' title= '$total2' class='mysteryIcon' id ='$cunningTreeItemID'  style='-webkit-filter: grayscale(100%); ' src = 'http://ddragon.leagueoflegends.com/cdn/6.15.1/img/mastery/$cunningTreeItemID.png'>";
              }
              $y++;

            }
            $x++;
          }
          
          echo"<br>";


          echo"<h3>Ferocity Tree</h3>";

          //Ferocity Mastery Tree
          $ferocityTreePosition = $mysteryTree->Ferocity;
           $x = 0;

          while ($x < count($ferocityTreePosition)){
            $ferocityTreeItens = $ferocityTreePosition[$x]->masteryTreeItems;
            $y=0;
            while ($y < count($ferocityTreeItens)){
              if(isset($ferocityTreeItens[$y]->masteryId)){
                $ferocityTreeItemID = $ferocityTreeItens[$y]->masteryId;
                $mysteryInformation=$mysteryData->{$ferocityTreeItemID};
                $mysteryName = $mysteryInformation->name ."\n\n";
                $mysteryDescription = $mysteryInformation->description;

                $z=0;
                $string="";
                while($z < count($mysteryDescription)){
                  $string = $string . $mysteryDescription[$z] ."\n";
                  $z++;
                }
                
             
              $total=$mysteryName . $string;
              $total2=str_replace("'s", "\"s", $total);
              echo "<img title= '$total2' class='mysteryIcon' id = '$ferocityTreeItemID' style='-webkit-filter: grayscale(100%); ' src = 'http://ddragon.leagueoflegends.com/cdn/6.15.1/img/mastery/$ferocityTreeItemID.png'>";
              }
              $y++;

            }
            $x++;
          }


          echo"<br>";

          echo"<h3>Resolve Tree</h3>";

          //Resolve Mastery Tree
          $resolveTreePosition = $mysteryTree->Resolve;
           $x = 0;

          while ($x < count($resolveTreePosition)){
            $resolveTreeItens = $resolveTreePosition[$x]->masteryTreeItems;
            $y=0;
            while ($y < count($resolveTreeItens)){

              if(isset($resolveTreeItens[$y]->masteryId)){
                $resolveTreeItemID = $resolveTreeItens[$y]->masteryId;
                $mysteryInformation=$mysteryData->{$resolveTreeItemID};
                $mysteryName = $mysteryInformation->name ."\n\n";
                $mysteryDescription = $mysteryInformation->description;

                $z=0;
                $string='';
                while($z < count($mysteryDescription)){
                  $string = $string . $mysteryDescription[$z] ."\n";
                  $z++;
                }

                //'s was messing up everthing!!!, had to change it from ' to " because when echoing the sting would end when there is a ' (for some reason)
              $total=$mysteryName . $string;
              $total2=str_replace("'s", "\"s", $total);

              echo "<img title= '$total2' class='mysteryIcon' id = '$resolveTreeItemID' style='-webkit-filter: grayscale(100%); '  src = 'http://ddragon.leagueoflegends.com/cdn/6.15.1/img/mastery/$resolveTreeItemID.png'>";
              }

              $y++;

            }
            $x++;
          }
          echo"<br>";





      //******************************************************************************************************************************
      //********************************** CHAMPION MASTERY **************************************************************************
      //******************************************************************************************************************************

        echo "<h1>Your top 3 champions are: </h1>";

      $urlChampMastyery = "https://na.api.pvp.net/championmastery/location/NA1/player/" . $summoner->id ."/champions?api_key=" .$apiKey; 
      $jsonObjChampMastery = file_get_contents($urlChampMastyery);
      $jsonOutputChampMastery = json_decode($jsonObjChampMastery);

      for($x=0; $x<3; $x++){
        $champIdOfChampMastery = ($jsonOutputChampMastery[$x]->championId);
        $champMasteryLevel = $jsonOutputChampMastery[$x]->championLevel;
        $champMasteryPoints = $jsonOutputChampMastery[$x]->championPoints;
        $urlChampionName = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion/" .$champIdOfChampMastery . "?api_key=" .$apiKey;
        $jsonChampObj = file_get_contents($urlChampionName);
        $jsonOutputChamp = json_decode($jsonChampObj);
        $champName = $jsonOutputChamp->key;
        echo "<img src= 'http://canisback.com/champion_mastery/img/level_$champMasteryLevel.png'>";
        echo"<input type='image' class='img-circle' onclick='test()' src='http://ddragon.leagueoflegends.com/cdn/6.6.1/img/champion/$champName.png'/>";
        echo "<p>You are level: $champMasteryLevel</p>";
        echo "<p>Your points are: $champMasteryPoints</p>";

      }


     ?> 

     <script>

      function test(){
        alert("img was clicked");
      }

        //parse the string og mastery id. 
        function showMasteryInfo(string2){
         var str = string2.toString();
         //divide the string by every 4th characeter
         var str2 = str.match(/.{1,4}/g);
         var x = 0;
         //we want to reset all icons back to gray when we select a new mastery
         resetMastery(str2);
         while(x<str2.length){
          var var3 = str2[x].toString();
            //removed the grayscale
            document.getElementById(var3).setAttribute("style","-webkit-filter:grayscale(0%)");
            x++;

         }

        }
        //finds all the class name "mysteryIcon" and set the grayscale back to 100%
        function resetMastery(str2){
          var x =0;
          var var3 = str2[x].toString();
            var test = document.getElementsByClassName("mysteryIcon");
            var y=0;
            while(y<test.length){
                test[y].setAttribute("style","-webkit-filter:grayscale(100%)");
                y++;
            }
            //x++;

         //}

        }
     </script>

<h1>sadfasdf</h1>
<h1>sadfasdf</h1>
<h1>sadfasdf</h1>
<h1>sadfasdf</h1>







      <!--

      all the champions 
      $urlAllChamp = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?champData=all&api_key=$apiKey";
      $jsonObjAllChamp = file_get_contents($urlAllChamp);
      $jsonOutputAllChamp = json_decode($jsonObjAllChamp);
      $test = $jsonOutputAllChamp->{"data"};
      
      echo ($test->{"Thresh"}->name);
    
      end of php call -->


      </div>

    </div><!-- /.container -->




























    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../project1/dist/js/bootstrap.min.js"></script>

  <script>
    // Initialize any Tooltip on this page
    $(document).ready(function () 
        {
            $('[data-toggle="tooltip"]').tooltip();
        }
    );
    </script>     
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
  </body>
</html>

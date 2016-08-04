<!DOCTYPE html>
<html>
	<head>

	</head>
	
	<body>
		<h1>Free champions this week</h1>

		<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
  			Name: <input type="text" name="sumName">
  			<input type="submit">
		</form>


			<?php


			//making it global in case i need to use it anywhere else
			global $summonerName, $summoner;
			//my unique api key
			$apiKey = "6e7e852a-40df-447a-acf8-fe7cc07bdd4c";

			//getting and storing what the user has entered
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
    			// collect value of input field
    			$summonerName = $_REQUEST['sumName'];
    			if (empty($summonerName)) {
        			echo "Name is empty";
    			} else {
    			//remove whitespaces in summor name
       			$summonerName = preg_replace('/\s+/', '', $summonerName);

       			//sending api call and parsing json object
				$url = "https://na.api.pvp.net/api/lol/na/v1.4/summoner/by-name/" . $summonerName . "?api_key=" .$apiKey; 
				$jsonObj = file_get_contents($url);
				$jsonOutput = json_decode($jsonObj);
				$summoner = $jsonOutput->$summonerName; // $summoner = $jsonOutput->{"beesonmyhead"}; 
				echo "<img src='http://ddragon.leagueoflegends.com/cdn/6.15.1/img/profileicon/$summoner->profileIconId.png'>
				 	  <h2> Hello $summoner->name</h2>";
    			}
			}	

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
					echo "<img src = 'http://ddragon.leagueoflegends.com/cdn/6.6.1/img/champion/$champName.png'>";
					$x++; 
			}

			//all the champions 
			$urlAllChamp = "https://global.api.pvp.net/api/lol/static-data/na/v1.2/champion?champData=all&api_key=$apiKey";
			$jsonObjAllChamp = file_get_contents($urlAllChamp);
			$jsonOutputAllChamp = json_decode($jsonObjAllChamp);
			$test = $jsonOutputAllChamp->{"data"};
			
			echo ($test->{"Thresh"}->name);
		 ?>
		
	</body>
</html>
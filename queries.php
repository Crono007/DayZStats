<?php
include ('config.php');

// Stats
$stats_totalAlive = "SELECT COUNT(*) FROM Character_DATA WHERE Alive = 1";
$stats_totalplayers = "SELECT COUNT(*) FROM Player_DATA";
$stats_deaths = "SELECT COUNT(*) FROM Character_DATA WHERE Alive = 0";
$stats_alivebandits = "SELECT COUNT(*) FROM Character_DATA WHERE Alive = 1 AND Humanity < -2000";
$stats_aliveheros = "SELECT COUNT(*) FROM Character_DATA WHERE Alive = 1 AND Humanity > 5000";
$stats_totalVehicles = array("SELECT COUNT(*) FROM Object_DATA WHERE Instance = ? AND CharacterID = '0'", $iid);
$stats_Played24h = "SELECT COUNT(*) FROM (SELECT COUNT(*) FROM Character_DATA WHERE LastLogin > NOW() - INTERVAL 1 DAY GROUP BY PlayerUID) uniqueplayers";
$stats_totalkills = "SELECT * FROM Character_DATA";

// Leaderboard
$leaderboard_query = "
SELECT
	pd.playerName,
	pd.playerUID,
    cd.CharacterID,
	cd.Generation,
	cd.KillsZ,
	cd.KillsB,
	cd.KillsH,
	cd.HeadshotsZ,
	cd.Humanity
FROM
	Character_DATA cd 
LEFT JOIN
	Player_DATA pd
ON
	pd.playerUID = cd.PlayerUID
WHERE
	InstanceID = " . $iid . "
AND 
	Alive like 1
";

$leaderboard_query_dead = "
SELECT 
	cd.distanceFoot,
	cd.duration
FROM 
	Character_DEAD cd
WHERE
	InstanceID = " . $iid ." 
AND 
	playerUID = ?
";

// Search
$search_query_player = "
SELECT
	pd.playerName,
	pd.playerUID,
	cd.playerUID,
	cd.CharacterID
FROM
	Character_DATA cd
JOIN
	Player_DATA pd
ON
	cd.PlayerUID = pd.playerUID
WHERE
	cd.Alive = 1
AND
    pd.playerName LIKE ?
";

//Info	
$info1 = "
SELECT
    pd.playerName,
    pd.playerUID,
    pd.playerSex,
    cd.*
FROM
    Character_DATA cd
JOIN
    Player_DATA pd
ON
    cd.playerUID = pd.playerUID
WHERE
    cd.CharacterID = ?
";

?>

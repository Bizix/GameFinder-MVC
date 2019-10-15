<?php
require_once("Manager.php");

class GameManager extends Manager
{
    public function getTopFive()
    {
        // Connexion to the database
        $db = $this->dbConnect();

        $req = $db->query("SELECT * FROM games ORDER BY rating DESC LIMIT 0, 5");

        return $req;
    }

    public function getResultsFromCat($postParams)
    {
        // Connexion to the database
        $db = $this->dbConnect();

        $locations = isset($postParams['location']) ? $postParams['location'] : null;
        $socials = isset($postParams['social']) ? $postParams['social'] : null;
        $players = isset($postParams['anyP']) ? 'anyP' : htmlentities($postParams['playerRange']);
        $time = isset($postParams['anyT']) ? 'anyT' : htmlentities($postParams['timeRange']);

        if (isset($postParams['drink'])) {
            $drink = $postParams['drink'];
            $checks['drink'] = $drink;
        } else {
            $drink =  null;
        }

        if (isset($postParams['prepSelector'])) {
            $prep = $postParams['prepSelector'];
            $checks['prep'] = $prep;
        } else {
            $prep =  null;
        }

        // prefill checks
        $checks['players'] = $players;
        $checks['time'] = $time;

        // Creation of the query
        $query = "SELECT DISTINCT(name),id,  isDrink, minP, maxP, shortTxt, fullTxt, minT, maxT, img, prep, rating FROM games g WHERE 1";

        $subquery = "";
        // Location
        if ($locations and count($locations) > 0) {
            $checks[$locations[0]] = $locations[0];
            $subquery = " AND  (";
            $locLength = count($locations);
            $subquery .= "$locations[0] = 1";

            if ($locLength == 1) {
                $subquery .= " )";
            }

            for ($i = 1; $i < $locLength; $i++) {
                $checks[$locations[$i]] = $locations[$i];
                $subquery .= " OR  $locations[$i] = 1";
            }
            if ($locLength > 1) {
                $subquery .= " )";
            }
        }
        // Social
        if ($socials and count($socials) >= 1) {
            $checks[$socials[0]] = $socials[0];
            $subquery .= " AND (";
            $socLength = count($socials);
            $subquery .= "$socials[0] = 1";

            if ($socLength == 1) {
                $subquery .= " )";
            }

            for ($i = 1; $i < $socLength; $i++) {
                $checks[$socials[$i]] = $socials[$i];
                $subquery .= " OR  $socials[$i] = 1";
            }
            if ($socLength > 1) {
                $subquery .= " )";
            }
        }


        // Drinking
        if ($drink == "drink") {
            $subquery .= " AND g.isDrink = 1";
        } else if ($drink == "nodrink") {
            $subquery .= " AND g.isDrink IS NULL";
        }
        // Players
        if ($players == 'anyP') {
            $subquery .= " AND g.minP >= 0 AND g.maxP <= 100";
        } else if ($players == 21) {
            $subquery .= " AND g.minP >= $players AND g.maxP <= 100";
        } else if ($players <= 20) {
            $subquery .= " AND g.minP <= $players AND g.maxP >= $players";
        }
        // Time
        if ($time == 'anyT') {
            $subquery .= " AND g.minT >= 0 AND g.maxT <= 300";
        } else if ($time == 61) {
            $subquery .= " AND g.minT >= $time AND g.maxT <= 300";
        } else if ($time <= 60) {
            $subquery .= " AND g.minT <= $time AND g.maxT >= $time";
        }
        // Prep
        if ($prep == 'min') {
            $subquery .= " AND g.prep = '$prep'";
        } else if ($prep == 'med') {
            $subquery .= " AND g.prep IN ('$prep', 'min')";
        } else if ($prep == 'max') {
            $subquery .= " AND g.prep IN ('$prep','min', 'med')";
        }

        // Continue queries
        $query .= $subquery;

        $object = array(
            "db_result" => $db->query($query),
            "checks" =>  $checks,
        );
        return $object;
    }
    public function searchBackend($postParams)
    {
        // Connexion to the database
        $db = $this->dbConnect();
        // print_r($postParams);
        $inquiry = $postParams['search'];
        $random = isset($postParams['randomGame']);
        if (isset($random) and $random == 'randomGame') {
            $query = "SELECT * FROM games g ORDER BY RAND() LIMIT 1";
        } else if ($inquiry != '') {
            $query = "SELECT * FROM games g WHERE name SOUNDS LIKE '$inquiry'";
        } else {
            $query = "SELECT * FROM games g ORDER BY rating DESC LIMIT 25";
        }

        return $db->query($query);
    }
    public function getUserGames($userId)
    {
        // Connexion to the database
        $db = $this->dbConnect();
        $user_games["Evaluation"] = array();
        $user_games["Validated"] = array();
        $user_games["Rejected"] = array();
        $req = $db->query("SELECT * FROM games WHERE userId = $userId  ORDER BY gameStatus");
        while ($data = $req->fetch()) {
            switch ($data["gameStatus"]) {
                case "Evaluation":
                    array_push($user_games["Validated"], $data);
                    break;
                case "Validated":
                    array_push($user_games["Evaluation"], $data);
                    break;
                case "Rejected":
                    array_push($user_games["Rejected"], $data);
                    break;
                default:
                    break;
            }
        }
        return  $user_games;
    }

    public function addGame($postParams)
    {
        // Connexion to the database
        $db = $this->dbConnect();

        // print_r($_POST);
        $gameName = addslashes(htmlspecialchars($postParams['name']));
        $shortTxt = addslashes(htmlspecialchars($postParams['shortTxt']));
        $fullTxt =  addslashes(htmlspecialchars($postParams['fullTxt']));
        $minP = $postParams['minP'];
        $maxP = $postParams['maxP'];
        $minT = $postParams['minT'];
        $maxT = $postParams['maxT'];
        $prep = isset($postParams['prepSelector']) ? $postParams['prepSelector'] : null;
        $userId = isset($postParams['userId']) ? $postParams['userId'] : null;
        $img = isset($postParams['game_img']) ? $postParams['game_img'] : "example.jpg";
        $drink = isset($postParams['isDrink']) ? $postParams['isDrink'] : null;
        $locations = isset($postParams['location']) ? $postParams['location'] : null;
        $socials = isset($postParams['social']) ? $postParams['social'] : null;


        $columns = " INSERT INTO games (name, shortTxt, fullTxt, minP, maxP, minT, maxT , prep, userId, img ";
        $values = ")  VALUES ( '$gameName' , '$shortTxt', '$fullTxt', $minT, $maxT, $minP, $maxP, '$prep', $userId, '$img'";

        if ($drink == 1) {
            $columns .= ", isDrink ";
            $values .= ", $drink ";
        }
        foreach ($locations as $location) {
            $columns .= ",  $location ";
            $values .= ",  1";
        }
        foreach ($socials as $social) {
            $columns .= ",  $social ";
            $values .= ", 1 ";
        }
        $query = $columns . $values . ")";
        // echo $query;
        $req = $db->prepare($query);
        $req->execute();
    }

    public function loadGame($getParams)
    {
        // Connexion to the database
        $db = $this->dbConnect();
        $game_id = $_REQUEST["game_id"];

        $response = $db->query("SELECT name, fullTxt, minP, maxP, minT, maxT, img, rating FROM games WHERE id=$game_id");
        echo json_encode($response->fetch());
    }
    public function getRatingsGame($getParams)
    {
        // Connexion to the database
        $db = $this->dbConnect();
        $game_id = $getParams["game_id"];
        $query = "SELECT * FROM ratings WHERE game_id = $game_id";
        $response = $db->query($query);

        // need to update games.rating from $rate_bg !!

        while ($data = $response->fetch(PDO::FETCH_ASSOC)) {
            $rate_db[] = $data;
            $sum_rates[] = $data['rating'];
        }

        if (@count($rate_db)) {
            $rate_times = count($rate_db);
            $sum_rates = array_sum($sum_rates);
            $rate_value = $sum_rates / $rate_times;
            $rate_bg = (($rate_value) / 5) * 100;
        } else {
            $rate_times = 0;
            $rate_value = 0;
            $rate_bg = 0;
        }

        // current user logged rating 

        if (isset($_SESSION['id'])) {
            $userID = $_SESSION['id'];
            $query = "SELECT * FROM ratings WHERE game_id = $game_id AND user_id = $userID";
        } else {
            $userID = "";
        }
        $response = $db->query($query);
        $userRating = null;
        while ($data = $response->fetch(PDO::FETCH_ASSOC)) {
            $userRating = $data['rating'];
        }


        $object['rate_bg']    =  $rate_bg;
        $object['rate_value'] =  $rate_value;
        $object['rate_times'] =  $rate_times;
        $object['userRating'] =  $userRating;

        return $object;
    }

    public function updateRating($getParams)
    {
        // Connexion to the database
        $db = $this->dbConnect();
        $userID = $_SESSION['id'];
        $gameID = $getParams['game_id'];
        $rating = $getParams['rate'];
        $rate_db = array();
        // print_r($getParams);
        $query = "SELECT * FROM ratings WHERE game_id=$gameID AND user_id = $userID";
        $response = $db->query($query);
        $db_rating_user = $response->fetch();
        if ($db_rating_user and $userID == $db_rating_user["user_id"]) {
            $query = "UPDATE ratings SET rating= $rating WHERE game_id=$gameID AND user_id = $userID";
            $response = $db->query($query);
        } else {
            $query = "INSERT INTO ratings (game_id, user_id, rating) VALUES ($gameID, $userID, $rating)";
            $response = $db->query($query);
        }

        // update of GAME DB
        $query = "SELECT AVG(rating) AS avg_rating FROM ratings WHERE game_id=$gameID";
        $response = $db->query($query);
        $data = $response->fetch();
        $db_rating_games = $data["avg_rating"];

        $query = "UPDATE games SET rating= '$db_rating_games' WHERE id=$gameID";
        $response = $db->query($query);
    }
} // end of the class
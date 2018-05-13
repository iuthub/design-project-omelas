<?php

class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {

    }



    public function getProducts() {
      $sql;

      $sql = "SELECT * FROM products";

      $result = $this->conn->query($sql);
      if ($result->num_rows > 0) {
          return $result;

      } else {
          return NULL;
      }
      $conn->close();
    }
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $userID, $password) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt

        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, name, userID, encrypted_password, salt, created_at) VALUES(?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $uuid, $name, $userID, $encrypted_password, $salt);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE userID = ?");
            $stmt->bind_param("s", $userID);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }
    public function getRequestHeaders() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}
    /**
     * Get user by userID and password
     */
    public function setUserToSession($userID){
        $takeSessionID = $this->conn->prepare("SELECT unique_id FROM users WHERE userID = ?");
        $takeSessionID->bind_param("s", $userID);
        $sResult = $takeSessionID->execute();

        $s = $takeSessionID->get_result()->fetch_assoc();
        $session = $s['unique_id'];
        $takeSessionID->close();


        $stmt = $this->conn->prepare("INSERT INTO session(userID, userSession) VALUES(?, ?)");
        $stmt->bind_param("ss", $userID, $session);
        $result = $stmt->execute();
        $stmt->close();
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM session WHERE userID = ?");
            $stmt->bind_param("s", $userID);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {

             $stmt2 = $this->conn->prepare("UPDATE session SET userSession = ? WHERE userID = ?");
             $stmt2->bind_param("ss", $session, $userID);
             $result2 = $stmt2->execute();
             $stmt2->close();

             if($result2){
                 $stmt2 = $this->conn->prepare("SELECT * FROM session WHERE userID = ?");
                 $stmt2->bind_param("s", $userID);
                 $stmt2->execute();
                 $user2 = $stmt2->get_result()->fetch_assoc();
                 $stmt2->close();

                 return $user2;
             } else{
                return false;
             }
        }
    }
    public function getUserBySession($sessionID){
        $stmt = $this->conn->prepare("SELECT * FROM session WHERE userSession = ?");
        $stmt->bind_param("s", $sessionID);
        $result = $stmt->execute();
        $userID = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($result) {
            $ID = $userID["userID"];
            $stmt2 = $this->conn->prepare("SELECT * FROM users WHERE userID = ?");
            $stmt2->bind_param("s", $ID);
            $stmt2->execute();
            $user = $stmt2->get_result()->fetch_assoc();


            $stmt2->close();
            return $user;
        } else {
            return NULL;
        }

    }

    public function testAPI() {
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $result = $stmt->execute();
        $userID = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($result) {
            return $userID;
        }
    }
    public function getUserByEmailAndPassword($userID, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE userID = ?");

        $stmt->bind_param("s", $userID);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }
    }

    /**
     * Check user is existed or not
     */
    public function logout($sessionID){
        $checkExist = $this->conn->prepare("SELECT * FROM session WHERE userSession = ?");
        $checkExist->bind_param("s", $sessionID);
        $resultExist = $checkExist->execute();
        $user = $checkExist->get_result()->fetch_assoc();
        $checkExist->close();
        if ($user){
            $stmt = $this->conn->prepare("DELETE FROM session WHERE userSession = ?");
            $stmt->bind_param("s", $sessionID);
            $result = $stmt->execute();
            if ($result) {
                $stmt->close();
                return TRUE;
            } else {
                return NULL;
             }
        } else {
            return NULL;
        }
    }
     public function showTable($show){
        $sql;
        if($show == "football"){
            $sql = "SELECT * FROM football";
        } else if ($show == "basketball") {
            $sql = "SELECT * FROM basketball";
        } else if ($show == "gym"){
            $sql = "SELECT * FROM gym";
        }
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result;

        } else {
            return NULL;
        }
        $conn->close();
    }
    // --------- FOOTBALL
    public function setFootball($startHour, $day,$month,$year, $sessionID){
        $stmt2 = $this->conn->prepare("SELECT * FROM session WHERE userSession = ?");
        $stmt2->bind_param("s", $sessionID);
        $result2 = $stmt2->execute();
        $userID = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();
        if ($result2) {
                $stmt = $this->conn->prepare("INSERT INTO football(startHour, endHour, day, month,year, userID) VALUES(?,?,?,?,?,?)");
                if ($startHour == 23){
                    $endHour = 1;
                } else if ($startHour == 24){
                    $endHour = 2;
                } else {
                    $endHour = $startHour+2;
                }
                $stmt->bind_param("ssssss", $startHour, $endHour, $day, $month, $year, $userID["userID"]);
                $result = $stmt->execute();
                $stmt->close();
                if ($result) {
                    $stmt3 = $this->conn->prepare("SELECT * FROM football WHERE (startHour, day, month, year, userID) = (?,?,?,?,?)");
                    $stmt3->bind_param("sssss", $startHour,$day,$month,$year, $userID["userID"]);
                    $stmt3->execute();
                    $user3 = $stmt3->get_result()->fetch_assoc();
                    $stmt3->close();
                    return $user3;
                } else {
                    return NULL;
                }

        }
    }
    public function isFootballExisted($startHour, $day, $month, $year){
        $stmt = $this->conn->prepare("SELECT * from football WHERE (startHour, day, month, year) = (?,?,?,?)");

        $stmt->bind_param("ssss", $startHour,$day,$month,$year);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows() > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    public function isFootballUserExisted($day,$month,$year,$sessionID){
    $stmt2 = $this->conn->prepare("SELECT * FROM session WHERE userSession = ?");
        $stmt2->bind_param("s", $sessionID);
        $result2 = $stmt2->execute();
        $userID = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();
        if ($result2) {
             $stmt = $this->conn->prepare("SELECT * from football WHERE (day, month, year,userID) = (?,?,?,?)");

            $stmt->bind_param("ssss", $day,$month,$year,$userID["userID"]);

            $stmt->execute();

            $stmt->store_result();

            if ($stmt->num_rows() > 0) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
    }
    // ------------- FOOTBALL
    //-------------- BASKETBALL
      public function setBasketball($startHour, $day,$month,$year, $sessionID){
        $stmt2 = $this->conn->prepare("SELECT * FROM session WHERE userSession = ?");
        $stmt2->bind_param("s", $sessionID);
        $result2 = $stmt2->execute();
        $userID = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();
        if ($result2) {
                $stmt = $this->conn->prepare("INSERT INTO basketball(startHour, endHour, day, month,year, userID) VALUES(?,?,?,?,?,?)");
                if ($startHour == 23){
                    $endHour = 1;
                } else if ($startHour == 24){
                    $endHour = 2;
                } else {
                    $endHour = $startHour+2;
                }
                $stmt->bind_param("ssssss", $startHour, $endHour, $day, $month, $year, $userID["userID"]);
                $result = $stmt->execute();
                $stmt->close();
                if ($result) {
                    $stmt3 = $this->conn->prepare("SELECT * FROM basketball WHERE (startHour, day, month, year, userID) = (?,?,?,?,?)");
                    $stmt3->bind_param("sssss", $startHour,$day,$month,$year, $userID["userID"]);
                    $stmt3->execute();
                    $user3 = $stmt3->get_result()->fetch_assoc();
                    $stmt3->close();
                    return $user3;
                } else {
                    return NULL;
                }

        }
    }
    public function isBasketballExisted($startHour, $day, $month, $year){
        $stmt = $this->conn->prepare("SELECT * from basketball WHERE (startHour, day, month, year) = (?,?,?,?)");

        $stmt->bind_param("ssss", $startHour,$day,$month,$year);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows() > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    public function isBasketballUserExisted($day,$month,$year,$sessionID){
    $stmt2 = $this->conn->prepare("SELECT * FROM session WHERE userSession = ?");
        $stmt2->bind_param("s", $sessionID);
        $result2 = $stmt2->execute();
        $userID = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();
        if ($result2) {
             $stmt = $this->conn->prepare("SELECT * from basketball WHERE (day, month, year,userID) = (?,?,?,?)");

            $stmt->bind_param("ssss", $day,$month,$year,$userID["userID"]);

            $stmt->execute();

            $stmt->store_result();

            if ($stmt->num_rows() > 0) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
    }
    //-------------- BASKETBALL
    //-------------- GYM
    public function setGym($startHour, $day,$month,$year, $sessionID){
        $stmt2 = $this->conn->prepare("SELECT * FROM session WHERE userSession = ?");
        $stmt2->bind_param("s", $sessionID);
        $result2 = $stmt2->execute();
        $userID = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();
        if ($result2) {
                $stmt = $this->conn->prepare("INSERT INTO gym(startHour, endHour, day, month,year, userID) VALUES(?,?,?,?,?,?)");
                $endHour;
                if ($startHour <= 22) {
                   $endHour = $startHour+2;
                } else if ($startHour == 23) {
                    $endHour = 1;
                } else if ($startHour == 24) {
                    $endHour = 2;
                }
                $stmt->bind_param("ssssss", $startHour, $endHour, $day, $month, $year, $userID["userID"]);
                $result = $stmt->execute();
                $stmt->close();
                if ($result) {
                    $stmt3 = $this->conn->prepare("SELECT * FROM gym WHERE (startHour, day, month, year, userID) = (?,?,?,?,?)");
                    $stmt3->bind_param("sssss", $startHour,$day,$month,$year, $userID["userID"]);
                    $stmt3->execute();
                    $user3 = $stmt3->get_result()->fetch_assoc();
                    $stmt3->close();
                    return $user3;
                } else {
                    return NULL;
                }

        }
    }
    public function isGymUserExisted($day,$month,$year,$sessionID){
    $stmt2 = $this->conn->prepare("SELECT * FROM session WHERE userSession = ?");
        $stmt2->bind_param("s", $sessionID);
        $result2 = $stmt2->execute();
        $userID = $stmt2->get_result()->fetch_assoc();
        $stmt2->close();
        if ($result2) {
             $stmt = $this->conn->prepare("SELECT * from gym WHERE (day, month, year,userID) = (?,?,?,?)");

            $stmt->bind_param("ssss", $day,$month,$year,$userID["userID"]);

            $stmt->execute();

            $stmt->store_result();

            if ($stmt->num_rows() > 0) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        }
    }
    public function isGymHavePlace($day,$month,$year,$startHour){
        $stmt = $this->conn->prepare("SELECT * from gym WHERE (day, month, year, startHour) = (?,?,?,?)");

        $stmt->bind_param("ssss", $day,$month,$year,$startHour);

        $stmt->execute();

        $stmt->store_result();
        if ($stmt->num_rows() <= 15) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }

    }
    //-------------- GYM
    public function isUserExisted($userID) {
        $stmt = $this->conn->prepare("SELECT userID from users WHERE userID = ?");
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }


    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function mkEncryption($hash){
        $encrypted_hash;
        for ($x = 0; $x < strlen($hash); $x++) {
            if ($hash[$x] === 'a'){
                $encrypted_hash = $encrypted_hash."0,2,1;";
            } else if ($hash[$x] === 'b') {
                $encrypted_hash = $encrypted_hash."0,2,2;";
            } else if ($hash[$x] === 'c') {
                $encrypted_hash = $encrypted_hash."0,2,3;";
            } else if ($hash[$x] === 'd') {
                $encrypted_hash = $encrypted_hash."0,3,1;";
            } else if ($hash[$x] === 'e') {
                $encrypted_hash = $encrypted_hash."0,3,2;";
            } else if ($hash[$x] === 'f') {
                $encrypted_hash = $encrypted_hash."0,3,3;";
            } else if ($hash[$x] === 'g') {
                $encrypted_hash = $encrypted_hash."0,4,1;";
            } else if ($hash[$x] === 'h') {
                $encrypted_hash = $encrypted_hash."0,4,2;";
            } else if ($hash[$x] === 'i') {
                $encrypted_hash = $encrypted_hash."0,4,3;";
            } else if ($hash[$x] === 'j') {
                $encrypted_hash = $encrypted_hash."0,5,1;";
            } else if ($hash[$x] === 'k') {
                $encrypted_hash = $encrypted_hash."0,5,2;";
            } else if ($hash[$x] === 'l') {
                $encrypted_hash = $encrypted_hash."0,5,3;";
            } else if ($hash[$x] === 'm') {
                $encrypted_hash = $encrypted_hash."0,6,1;";
            } else if ($hash[$x] === 'n') {
                $encrypted_hash = $encrypted_hash."0,6,2;";
            } else if ($hash[$x] === 'o') {
                $encrypted_hash = $encrypted_hash."0,6,3;";
            } else if ($hash[$x] === 'p') {
                $encrypted_hash = $encrypted_hash."0,7,1;";
            } else if ($hash[$x] === 'q') {
                $encrypted_hash = $encrypted_hash."0,7,2;";
            } else if ($hash[$x] === 'r') {
                $encrypted_hash = $encrypted_hash."0,7,3;";
            } else if ($hash[$x] === 's') {
                $encrypted_hash = $encrypted_hash."0,7,4;";
            } else if ($hash[$x] === 't') {
                $encrypted_hash = $encrypted_hash."0,8,1;";
            } else if ($hash[$x] === 'u') {
                $encrypted_hash = $encrypted_hash."0,8,2;";
            } else if ($hash[$x] === 'v') {
                $encrypted_hash = $encrypted_hash."0,8,3;";
            } else if ($hash[$x] === 'w') {
                $encrypted_hash = $encrypted_hash."0,9,1;";
            } else if ($hash[$x] === 'x') {
                $encrypted_hash = $encrypted_hash."0,9,2;";
            } else if ($hash[$x] === 'y') {
                $encrypted_hash = $encrypted_hash."0,9,3;";
            } else if ($hash[$x] === 'z') {
                $encrypted_hash = $encrypted_hash."0,9,4;";
            } else if ($hash[$x] === ' ') {
                $encrypted_hash = $encrypted_hash."0,0,0;";
            } else if ($hash[$x] === 'A'){
                $encrypted_hash = $encrypted_hash."1,2,1;";
            } else if ($hash[$x] === 'B') {
                $encrypted_hash = $encrypted_hash."1,2,2;";
            } else if ($hash[$x] === 'C') {
                $encrypted_hash = $encrypted_hash."1,2,3;";
            } else if ($hash[$x] === 'D') {
                $encrypted_hash = $encrypted_hash."1,3,1;";
            } else if ($hash[$x] === 'E') {
                $encrypted_hash = $encrypted_hash."1,3,2;";
            } else if ($hash[$x] === 'F') {
                $encrypted_hash = $encrypted_hash."1,3,3;";
            } else if ($hash[$x] === 'G') {
                $encrypted_hash = $encrypted_hash."1,4,1;";
            } else if ($hash[$x] === 'H') {
                $encrypted_hash = $encrypted_hash."1,4,2;";
            } else if ($hash[$x] === 'I') {
                $encrypted_hash = $encrypted_hash."1,4,3;";
            } else if ($hash[$x] === 'J') {
                $encrypted_hash = $encrypted_hash."1,5,1;";
            } else if ($hash[$x] === 'K') {
                $encrypted_hash = $encrypted_hash."1,5,2;";
            } else if ($hash[$x] === 'L') {
                $encrypted_hash = $encrypted_hash."1,5,3;";
            } else if ($hash[$x] === 'M') {
                $encrypted_hash = $encrypted_hash."1,6,1;";
            } else if ($hash[$x] === 'N') {
                $encrypted_hash = $encrypted_hash."1,6,2;";
            } else if ($hash[$x] === 'O') {
                $encrypted_hash = $encrypted_hash."1,6,3;";
            } else if ($hash[$x] === 'P') {
                $encrypted_hash = $encrypted_hash."1,7,1;";
            } else if ($hash[$x] === 'Q') {
                $encrypted_hash = $encrypted_hash."1,7,2;";
            } else if ($hash[$x] === 'R') {
                $encrypted_hash = $encrypted_hash."1,7,3;";
            } else if ($hash[$x] === 'S') {
                $encrypted_hash = $encrypted_hash."1,7,4;";
            } else if ($hash[$x] === 'T') {
                $encrypted_hash = $encrypted_hash."1,8,1;";
            } else if ($hash[$x] === 'U') {
                $encrypted_hash = $encrypted_hash."1,8,2;";
            } else if ($hash[$x] === 'V') {
                $encrypted_hash = $encrypted_hash."1,8,3;";
            } else if ($hash[$x] === 'W') {
                $encrypted_hash = $encrypted_hash."1,9,1;";
            } else if ($hash[$x] === 'X') {
                $encrypted_hash = $encrypted_hash."1,9,2;";
            } else if ($hash[$x] === 'Y') {
                $encrypted_hash = $encrypted_hash."1,9,3;";
            } else if ($hash[$x] === 'Z') {
                $encrypted_hash = $encrypted_hash."1,9,4;";
            } else if ($hash[$x] === '@') {
                 $encrypted_hash = $encrypted_hash."0,0,1;";
            }
        }
        return $encrypted_hash;
    }
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

}

?>

<?php
    require_once 'dbconnect.php';
    require_once '../../vendor/autoload.php';
    use \Firebase\JWT\JWT;

    // ENCRYPTION KEY HS256
    // => dodaj ga v samo bazo kot spremenljivko
    // https://www.grc.com/passwords.htm
    // define("ENCRYPTION_KEY", "Hyc2bPHvnoc3ECUyCED5PE3SJZyroJLh0sOt758g4oLI04yQS1ezoJ2GsH6EUX4");

    class Token extends JWT {
        private $token;
        private $refresh_token;
        private const ENCRYPTION_KEY = "Hyc2bPHvnoc3ECUyCED5PE3SJZyroJLh0sOt758g4oLI04yQS1ezoJ2GsH6EUX4";

        function __construct($token) {
            if(is_array($token)) {
                $this->token = self::encode($token, self::ENCRYPTION_KEY);

                $this->refresh_token = password_hash($token['username'] . time() . $token['exp'], PASSWORD_DEFAULT);
                self::updateDB($this->refresh_token, $token['username']);
                setcookie("refresh_token", $this->refresh_token , time() + 60 * 24 * 60 * 60, NULL, NULL, false, true);
            }
            else {
                if(self::isValid($token)) {
                    $this->token = $token;
                    if(!isset($_COOKIE['refresh_token'])) {
                        global $conn;
                        $q = "SELECT refresh_token FROM uporabnik
                        WHERE upime = ?";

                        $stmt = $conn->prepare($q);
                        $username = self::getUsername();
                        $stmt->bind_param("s", $username);
                        $stmt->execute();
                        
                        $result = $stmt->get_result();
                        $this->refresh_token = $result->fetch_assoc()['refresh_token'];
                        setcookie("refresh_token", $this->refresh_token , time() + 60 * 24 * 60 * 60, NULL, NULL, false, true);
                    } 
                    else
                        $this->refresh_token = $_COOKIE['refresh_token'];
                }
                else {
                    $this->token = self::encode($token, self::ENCRYPTION_KEY);

                    $this->refresh_token = password_hash($token['username'] . time() . $token['exp'], PASSWORD_DEFAULT);
                    self::updateDB($this->refresh_token, $token['username']);
                    setcookie("refresh_token", $this->refresh_token , time() + 60 * 24 * 60 * 60, NULL, NULL, false, true);
                }
            }
        }

        public function isValid($token) {
            try {
                $token_array = (array) parent::decode($token, self::ENCRYPTION_KEY, ['HS256']);
            }
            catch(Exception $e) {
                return false;
            }
            return $token_array['exp'] > time() ? true : false;
        }
        
        // POPRAVI
        public function isValidDB($username) {
            if(!isset($_COOKIE['refresh_token']))
                return false;

            global $conn;
            
            $q = "SELECT refresh_token, DATEDIFF(CURRENT_DATE, token_generated) AS date_diff
            FROM uporabnik
            WHERE upime = ?";

            $stmt = $conn->prepare($q);
            $stmt->bind_param("s", $username);
            $stmt->execute();

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if($row['date_diff'] < 60 AND $this->refresh_token == $row['refresh_token'])
                return true;
        }

        public function updateDB($refresh_token, $username) {
            global $conn;
            $q = "UPDATE uporabnik 
            SET refresh_token = ?, 
            token_generated = CURRENT_DATE
            WHERE upime = ?";
            
            $stmt = $conn->prepare($q);
            $stmt->bind_param("ss", $refresh_token, $username);
            $stmt->execute();
            return $stmt->affected_rows == 1 ? true : false;
        }

        // GETTERS
        public function getToken() {
            return $this->token;
        }

        public function getRefresh_token() {
            return $this->refresh_token;
        }

        public function getUsername() {
            try {
                $token_array = (array) parent::decode($this->token, self::ENCRYPTION_KEY, ['HS256']);
            }
            catch(Exception $e) {
                return "";
            }
            return $token_array['username'];
        }
    }

    // avtomatsko preveri, ali obstaja token preko phpinput-a in po potrebi zavrni transakcijo

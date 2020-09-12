<?php
    require_once 'dbconnect.php';
    require_once __ROOT__ . '/vendor/autoload.php';
    use \Firebase\JWT\JWT;
    // echo $_SERVER['DOCUMENT_ROOT'];
    // ENCRYPTION KEY HS256
    // => dodaj ga v samo bazo kot spremenljivko
    // https://www.grc.com/passwords.htm

    class Token extends JWT {
        private $token;
        private $refresh_token;
        private const ENCRYPTION_KEY = "Hyc2bPHvnoc3ECUyCED5PE3SJZyroJLh0sOt758g4oLI04yQS1ezoJ2GsH6EUX4";

        // types: new, token, cookie
        function __construct($vnos, $type = "new") {
            if($type == "new") 
                self::createToken($vnos);
            else if($type == "token") {
                if(self::isValid($vnos)) {
                    $this->token = $vnos;
                }
                else if(isset($_COOKIE['refresh_token'])){
                    // pogledam v bazo za veljavnost in ga po potrebi obnovim ali pa ne
                    $refresh_data =  self::refreshTokenData($_COOKIE['refresh_token']);
                    if($refresh_data !== false)
                        self::createToken($refresh_data['username']);
                    else// tukaj lahko zavrnem s headerjem access denied
                        http_response_code(403);
                }
                else
                    http_response_code(403);
            }
            else if($type == "cookie") {
                if(isset($_COOKIE['refresh_token'])){
                    // pogledam v bazo za veljavnost in ga po potrebi obnovim ali pa ne
                    $refresh_data =  self::refreshTokenData($_COOKIE['refresh_token']);
                    if($refresh_data !== false)
                        self::createToken($refresh_data['username']);
                    else
                        http_response_code(403);
                }
                else
                    http_response_code(403);
            }
            else
                http_response_code(403);
        }   
        
        public function refreshTokenData($refresh_token) {
            global $conn;
            
            $q = "SELECT refresh_token, upime, DATEDIFF(CURRENT_DATE, token_generated) AS date_diff
            FROM uporabnik
            WHERE refresh_token = ?";

            $stmt = $conn->prepare($q);
            $stmt->bind_param("s", $refresh_token);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows == 1) {
                $row = $result->fetch_assoc();

                $tokenData = [
                    "refresh_token" => $refresh_token,
                    "username" => $row['upime'],
                    "isValid" => $row['date_diff'] < 60 ? true : false
                ];
                return $tokenData;
            }
            else   
                return false;
        }
        public function createToken($username) {
            $token = [
                "username" => $username,
                "exp" => time() + 15 * 60
            ];
            $this->token = self::encode($token, self::ENCRYPTION_KEY);

            $this->refresh_token = password_hash($token['username'] . time() . $token['exp'], PASSWORD_DEFAULT);
            self::updateDB($this->refresh_token, $token['username']);
            setcookie("refresh_token", $this->refresh_token , time() + 60 * 24 * 60 * 60, "/", NULL, false, true);
            /*
                https://www.geeksforgeeks.org/http-headers-set-cookie/
                https://stackoverflow.com/questions/36877/how-do-you-set-up-use-httponly-cookies-in-php
            */
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

    /*
    // preverim, ali je poslan token
    if(isset($json_data['token']))
    {
        // ustvarim objekt
        // preverim, ali je token veljaven
        $token = new Token($json_data['data'], "token");
        echo "token preverjen";
        
    }
    // tukaj preverim, ali je prišlo do prijave oz registracije
    else if (isset($json_data['isLogin'])) 
    {
        // prijava

        // registracija
    }
    // če ne dobim tokena, ga moram prevzeti iz piškotka, v primeru, da obstaja
    else 
    {
        // piškotek
    }
    // če pa to sedaj ni nič delovalo, pa samo zavrnem transakcijo
    // http_response_code(403); => ACCESS DENIED
    // else {}
    */
    $token = new Token('merjan', "new");
    //header("Set-Cookie: refresh_token=vrednost.refresh.tokena; Path:'/'; Domain=localhost; httpOnly");
    // echo "ja";
    // setcookie("jan", "jerhar", time() + 60 * 60, null);
    // setcookie("refresh_token", $this->refresh_token , time() + 60 * 24 * 60 * 60, NULL, NULL, false, true);
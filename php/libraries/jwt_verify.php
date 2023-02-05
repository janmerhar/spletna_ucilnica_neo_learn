<?php
    require_once 'jwt.php';

    function getAuthorizationHeader(){
        $headers = null;

        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { 
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }

        return $headers;
    }

    function getBearerToken() {
        $headers = getAuthorizationHeader();
        
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    $bearer_token = getBearerToken();

    if ($bearer_token != null)
    {
        $token = new Token($bearer_token, "token");
        $response['token'] = $token->getToken();
    }
    // če ne dobim tokena, ga moram prevzeti iz piškotka, v primeru, da obstaja
    else if(isset($_COOKIE['refresh_token']))
    {
        // piškotek
        $token = new Token($_COOKIE['refresh_token'], "cookie");
        $response['token'] = $token->getToken();
    }
    // če pa to sedaj ni nič delovalo, pa samo zavrnem transakcijo
    // http_response_code(403); => ACCESS DENIED
    else 
    {
        // http_response_code(403);
        die(json_encode(["error" => "token"]));
    }
<?php
    require_once 'jwt.php';
    // preverim, ali je poslan token oz. če je NULL
    if(isset($json_data['token']))
    {
        // ustvarim objekt
        // preverim, ali je token veljaven
        $token = new Token($json_data['token'], "token");
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
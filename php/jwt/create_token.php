<?php
    // https://github.com/crmcmullen/jwtphpjquery
    // https://medium.com/better-programming/simple-example-using-json-web-tokens-with-php-and-jquery-c648a80854c

    require_once '../libraries/dbconnect.php';
    require_once '../../vendor/autoload.php';
    use \Firebase\JWT\JWT;

    // že pridobim uporabniško ime in preverim, ali je loginano
    $username = "merjan";
    $nbf = time();
    $exp = time() + 15 * 60;

    $jwt_array = [
        'username' => $username,
        'nbf' => $nbf,
        'exp' => $exp
    ];

    $jwt = JWT::encode($jwt_array, "Hyc2bPHvnoc3ECUyCED5PE3SJZyroJLh0sOt758g4oLI04yQS1ezoJ2GsH6EUX4");
    // v objekt dodaj še kdaj bo expired
    // https://hasura.io/blog/best-practices-of-using-jwt-with-graphql/#intro
    echo json_encode($jwt, JSON_PRETTY_PRINT) . '<br/><pre>';

    // preverjam, ali je še veljaven
    // implementiraj še try-catch za primere, ko token ni pravilno podpisan
    var_dump(JWT::decode($jwt, "Hyc2bPHvnoc3ECUyCED5PE3SJZyroJLh0sOt758g4oLI04yQS1ezoJ2GsH6EUX4", array('HS256')));
    
?>
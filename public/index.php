<?php
// front controller
// nous reçevons toutes nos requêtes ici

require_once __DIR__.'/../config/env.php';

// path = <website-url>/my-path
$path = $_SERVER['PATH_INFO'] ?? '/';

$content = '';
try {
    if ($path === '/') {
        $content = '<h1>Bienvenue sur notre site !</h1>';

        $sensitiveInfo = '';
        if ($_ENV['env'] !== 'production') {
            $sensitiveInfo = 'Informations sensibles...';
        }

        throw new Exception("Erreur de traitement : ".$sensitiveInfo);
    }

    else {
        throw new LogicException("<h1>Cette page n'existe pas!</h1>");
    }
} catch (LogicException $e) {
    http_response_code(404);
    $content = $e->getMessage();
} catch (Exception $e) {
    http_response_code(500);
    $content = $e->getMessage();
}

echo $content;




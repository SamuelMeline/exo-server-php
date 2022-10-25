<?php
// front controller
// nous reçevons toutes nos requêtes ici

require_once __DIR__.'/../config/env.php';

function render(string $viewPath): string
{
    ob_start();
        require_once __DIR__.'/../templates/'.ltrim($viewPath, '/');
    return ob_get_clean();
}

// path = <website-url>/my-path
$path = $_SERVER['PATH_INFO'] ?? '/';

$content = '';
try {
    if ($path === '/') {
        $content = render('home.html');
    }

    // créer une route /about

    // créer une route /posts

    // créer une route /posts/show qui prend un paramètre 'id'
    // 'id' doit représenter un numérique 1, 2, 100 etc.
    // afficher l'id dans votre page html, exemple : post n°<id>
    // attention aux failles de sécurité

    // créer une route api/token
    // renvoie un token au format json
    // regarder header, type-mime et Content-Type

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




<?php

    $path = (realpath(__DIR__ . '/..') . '/src');
    require $path.'/autoload.php';

    foreach ($Configuration->routes as $rts) {
        $router->match($rts['type'], $rts['pattern'], function($slug = null) use ($route, $rts) { ($route->load($rts['controller']))->index($_SERVER['REQUEST_METHOD'], (!empty($slug)? $slug: null), (isset($rts['auth']) && !empty($rts['auth'])? $rts['auth']: false), (isset($rts['injection']) && !empty($rts['injection'])? $rts['injection']: false)); });
    }

    $router->set404(function() use ($route) { ($route->load('Errors'))->NotFound(); });

    $router->run();

?>
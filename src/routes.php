<?php
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', function () {
        echo 123;
    });
    $r->addRoute('GET', '/test', 'test_handler');
    $r->addRoute('GET', '/best', function () {
        echo '000';
    });
});

$method = $_SERVER['REQUEST_METHOD'];
$uri    = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$info = $dispatcher->dispatch($method, $uri);
switch ($info[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo 'NOT FOUND';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $info[1];
        // ... 405 Method Not Allowed
        echo 'NOT ALLOWED';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $info[1];
        $vars    = $info[2];
        $handler($vars);
        break;
}

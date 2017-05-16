<?php

use benharold\webhook\NewRelicMessageController;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('POST', '/new-relic-alert', function () {
        $log = new Logger('webhook');
        $log->pushHandler(new StreamHandler(getenv('LOG_FILE_PATH'), Logger::WARNING));
        $log->debug('Data posted to `/test`:', $_POST);

        $c = new NewRelicMessageController($_POST);
        $c->run();
    });

    $r->addRoute('POST', '/sms/{uuid}', function (array $uuid) {
        //var_dump(preg_match("/^(\{)?[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}(?(1)\})$/i", $guid) ? "ok" : "not ok");
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

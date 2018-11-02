<?php
require "../vendor/autoload.php";

// load .env
use Dotenv\Dotenv;

// initialize aplication kernel
use Fratily\Kernel\KernelManager;
use Fratily\Http\Message\ServerRequestFactory;
use Fratily\Http\Message\UriFactory;
use Fratily\Http\Message\Response\Emitter;

// when not defind APP_ENV in server env, load .env file.
if(!isset($_ENV["APP_ENV"])){
    if(!class_exists(Dotenv::class)){
        throw new \RuntimeException(
            ""
        );
    }

    (new Dotenv(__DIR__ . "/.."))->load();
}

$env    = $_ENV["APP_ENV"] ?? "dev";
$debug  = (bool)($_ENV["APP_DEBUG"] ?? ("prod" !== $env));

// Setting debug view, if debug mode is enabled.
/*
if($debug){
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}
*/

$kernelManager  = new KernelManager(new App\KernelConfiguration($env, $debug));
$request        = (new ServerRequestFactory())->createServerRequest(
    $_SERVER["REQUEST_METHOD"],
    (new UriFactory)->createUriFromGlobal(),
    $_SERVER
);

$emitter    = new Emitter();
$emitter->emit($kernelManager->handle($request));
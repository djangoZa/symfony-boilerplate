<?php
use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

require_once __DIR__.'/../app/AppKernel.php';

$environment = ($_SERVER['HTTP_HOST'] == 'localhost') ? 'test' : array_shift(explode(".",$_SERVER['HTTP_HOST']));
$errorReporting = (in_array($environment, array('dev', 'test'))) ? true : false;
$kernel = new AppKernel($environment, $errorReporting);
$kernel->loadClassCache();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
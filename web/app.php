<?php

/*
 * This file is part of the broadway/broadway-demo package.
 *
 * (c) Qandidate.com <opensource@qandidate.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Qandidate\Stack\RequestId;
use Qandidate\Stack\UuidRequestIdGenerator;
use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__ .'/../vendor/autoload.php';

require __DIR__ . '/../app/AppKernel.php';

// Initialize an application aspect container
$applicationAspectKernel = \Aspect\ApplicationAspectKernel::getInstance();
$applicationAspectKernel->init(array(
    'debug' => true, // use 'false' for production mode
    // Cache directory
    'cacheDir'  => __DIR__ . '/../app/cache/aop',
    // Include paths restricts the directories where aspects should be applied, or empty for all source files
    'includePaths' => array(
        __DIR__ . '/../src'
    )
));

$debug       = true;
$environment = 'dev';

$kernel = new AppKernel($environment, $debug);

// Stack it!
$generator = new UuidRequestIdGenerator(42);
$requestId = new RequestId($kernel, $generator);

$kernel->loadClassCache();

$request = Request::createFromGlobals();
$response = $requestId->handle($request);
$response->send();
$kernel->terminate($request, $response);

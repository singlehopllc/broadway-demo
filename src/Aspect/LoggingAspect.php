<?php

namespace Aspect;


use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Core\AspectContainer;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\Around;
use Go\Lang\Annotation\Pointcut;
use Monolog;

class LoggingAspect implements Aspect
{
    /** @var Monolog\Logger */
    protected $logger;

    public function __construct()
    {
        $this->logger = new Monolog\Logger('test');
        $this->logger->pushHandler(new Monolog\Handler\StreamHandler(__DIR__ . '/../../app/logs/aspect_test.log', Monolog\Logger::INFO));
    }

    /**
     * Method that will be called before real method
     *
     * @param MethodInvocation $invocation Invocation
     * @Before("within(**)")
     */
    public function beforeMethodExecution(MethodInvocation $invocation)
    {
        $obj = $invocation->getThis();
        $class = $obj === (object)$obj ? get_class($obj) : $obj;
        $this->logger->info('Executing ' . $class . '->' . $invocation->getMethod()->name, $invocation->getArguments());
    }
}

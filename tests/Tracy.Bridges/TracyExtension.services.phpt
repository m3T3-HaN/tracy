<?php

/**
 * Test: TracyExtension accessors.
 */

use Nette\DI;
use Tracy\Bridges\Nette\TracyExtension;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


$compiler = new DI\Compiler;
$compiler->addExtension('tracy', new TracyExtension);

eval(@$compiler->compile([], 'Container')); // @ compatiblity with DI 2.3 & 2.4

$container = new Container;
Assert::type('Tracy\Logger', $container->getService('tracy.logger'));
Assert::type('Tracy\BlueScreen', $container->getService('tracy.blueScreen'));
Assert::type('Tracy\Bar', $container->getService('tracy.bar'));

Assert::same(Tracy\Debugger::getLogger(), $container->getService('tracy.logger'));
Assert::same(Tracy\Debugger::getBlueScreen(), $container->getService('tracy.blueScreen'));
Assert::same(Tracy\Debugger::getBar(), $container->getService('tracy.bar'));

<?php

declare(strict_types=1);

namespace Linio\SellerCenter\Unit\Service;

use GuzzleHttp\Client;
use Linio\SellerCenter\Application\Configuration;
use Linio\SellerCenter\Application\Parameters;
use Linio\SellerCenter\LinioTestCase;
use Linio\SellerCenter\Service\WebhookManager;
use Psr\Log\Test\TestLogger;
use ReflectionClass;

class WebhookManagerTest extends LinioTestCase
{
    public function testItReturnsTheTheLoggerWhenIsSet(): void
    {
        $configuration = $this->prophesize(Configuration::class);
        $client = $this->prophesize(Client::class);
        $parameters = $this->prophesize(Parameters::class);
        $logger = $this->prophesize(TestLogger::class);

        $webhookManager = new WebhookManager(
            $configuration->reveal(),
            $client->reveal(),
            $parameters->reveal(),
            $logger->reveal()
        );

        $reflectionClass = new ReflectionClass(WebhookManager::class);
        $property = $reflectionClass->getProperty('logger');
        $property->setAccessible(true);

        $setted = $property->getValue($webhookManager);

        $this->assertInstanceOf(TestLogger::class, $setted);
    }
}

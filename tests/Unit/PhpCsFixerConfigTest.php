<?php
declare(strict_types=1);

namespace WebProject\PhpCsFixerConfig\Tests\Unit;

use WebProject\PhpCsFixerConfig\PhpCsFixerConfig;
use WebProject\PhpCsFixerConfig\Tests\Support\UnitTester;

class PhpCsFixerConfigTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;

    // tests
    public function testNameIsSet(): void
    {
        // Arrange
        $config = new PhpCsFixerConfig()(__DIR__);
        // Act
        $name = $config->getName();
        // Assert
        self::assertSame(PhpCsFixerConfig::NAME, $name);
    }
}

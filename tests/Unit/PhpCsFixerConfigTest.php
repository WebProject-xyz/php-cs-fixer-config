<?php
declare(strict_types=1);

namespace WebProject\PhpCsFixerConfig\Tests\Unit;

use PhpCsFixer\Config as PhpCsFixerConfigModel;
use WebProject\PhpCsFixerConfig\PhpCsFixerConfigFactory as PhpCsFixerConfig;
use WebProject\PhpCsFixerConfig\Tests\Support\UnitTester;

class PhpCsFixerConfigTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    protected PhpCsFixerConfigModel $phpCsFixerConfig;

    protected function _setUp(): void
    {
        $this->phpCsFixerConfig = new PhpCsFixerConfig()(__DIR__);

        parent::_setUp();
    }

    // tests
    public function testNameIsSet(): void
    {
        // Arrange
        // Act
        $name = $this->phpCsFixerConfig->getName();
        // Assert
        self::assertSame(PhpCsFixerConfig::NAME, $name);
    }

    public function testRulesAreAsExpected(): void
    {
        // Arrange
        $expectedRules =  [
            '@PSR12'                 => true,
            '@Symfony'               => true,
            '@Symfony:risky'         => true,
            '@PhpCsFixer:risky'      => true,
            '@PHP8x3Migration'       => true,
            '@DoctrineAnnotation'    => true,
            'binary_operator_spaces' => [
                'default'   => 'align',
                'operators' => [
                    '??' => 'single_space',
                ],
            ],
            'concat_space' => [
                'spacing' => 'one',
            ],
            'blank_line_after_opening_tag' => false,
            'php_unit_dedicate_assert'     => [
                'target' => 'newest',
            ],
            'global_namespace_import' => [
                'import_classes'   => true,
                'import_functions' => true,
                'import_constants' => true,
            ],
            'phpdoc_to_comment'  => false,
        ];

        // Act
        $rulesFromConfig = $this->phpCsFixerConfig->getRules();

        // Assert
        self::assertSame($expectedRules, $rulesFromConfig);
    }
}

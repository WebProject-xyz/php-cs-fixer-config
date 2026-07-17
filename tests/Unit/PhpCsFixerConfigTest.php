<?php
declare(strict_types=1);

namespace WebProject\PhpCsFixerConfig\Tests\Unit;

use WebProject\PhpCsFixerConfig\PhpCsFixerConfig;
use WebProject\PhpCsFixerConfig\Tests\Support\UnitTester;

class PhpCsFixerConfigTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    protected \PhpCsFixer\Config $phpCsFixerConfig;

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
            'encoding'                     => true,
            'blank_lines_before_namespace' => true,
            'blank_line_after_opening_tag' => false,
            'strict_param'                 => true,
            'no_useless_else'              => true,
            'no_useless_return'            => true,
            'modernize_types_casting'      => true,
            'declare_strict_types'         => true,
            'dir_constant'                 => true,
            'php_unit_dedicate_assert'     => [
                'target' => 'newest',
            ],
            'combine_nested_dirname' => true,
            'ordered_imports'        => [
                'sort_algorithm' => 'alpha',
            ],
            'global_namespace_import' => [
                'import_classes'   => true,
                'import_functions' => true,
                'import_constants' => true,
            ],
            'phpdoc_to_comment'                                => false,
            'nullable_type_declaration_for_default_null_value' => true,
            'blank_line_between_import_groups'                 => false,
        ];

        // Act
        $rulesFromConfig = $this->phpCsFixerConfig->getRules();

        // Assert
        self::assertSame($expectedRules, $rulesFromConfig);
    }
}

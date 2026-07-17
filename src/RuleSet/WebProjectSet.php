<?php

declare(strict_types=1);

namespace WebProject\PhpCsFixerConfig\RuleSet;

final class WebProjectSet extends \PhpCsFixer\RuleSet\AbstractRuleSetDefinition
{
    public function getDescription(): string
    {
        return 'WebProject ruleset';
    }

    /**
     * @return array<string, array<string, array<string, string>|bool|string>|bool>
     */
    public function getRules(): array
    {
        return [
            /** symfony set @see \PhpCsFixer\RuleSet\Sets\PSR12Set */
            '@PSR12'                 => true,
            /** symfony set @see \PhpCsFixer\RuleSet\Sets\SymfonySet */
            '@Symfony'               => true,
            /** symfony set @see \PhpCsFixer\RuleSet\Sets\SymfonyRiskySet */
            '@Symfony:risky'           => true,
            '@PhpCsFixer:risky'        => true,
            '@PHP8x3Migration'         => true,
            '@DoctrineAnnotation'      => true,
            'binary_operator_spaces'   => [
                'default'   => 'align',
                'operators' => [
                    '??' => 'single_space',
                ],
            ],
            'concat_space'                                  => ['spacing' => 'one'],
            'blank_line_after_opening_tag'                  => false, // psr 12 = true
            'php_unit_dedicate_assert'                      => ['target' => 'newest'],
            'global_namespace_import'                       => [
                'import_classes'   => true,
                'import_functions' => true,
                'import_constants' => true,
            ],
            'phpdoc_to_comment' => false,
        ];
    }
}

<?php

declare(strict_types=1);

namespace WebProject\PhpCsFixerConfig;

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

final readonly class PhpCsFixerConfig
{
    public const string NAME = 'WebProject-Style';

    /**
     * @phpstan-param string|string[] $dirs
     * @phpstan-param string|string[] $excludeDirs
     */
    public function __invoke(array|string $dirs, array|string $excludeDirs = []): Config
    {
        return new Config(self::NAME)
            ->setRiskyAllowed(true)
            ->setRules($this->buildRules())
            ->setUsingCache(true)
            ->setLineEnding("\n")
            ->setRiskyAllowed(true)
            ->setParallelConfig(ParallelConfigFactory::detect())
            ->setUnsupportedPhpVersionAllowed(true)
            // 💡 by default, Fixer looks for `*.php` files excluding `./vendor/` - here, you can groom this config
            ->setFinder(
                new Finder()
                    // 💡 root folder to check
                    ->in($dirs)
                    // 💡 additional files, eg bin entry file
                    // ->append([__DIR__.'/bin-entry-file'])
                    // 💡 folders to exclude, if any
                    ->exclude($excludeDirs)
                    // 💡 path patterns to exclude, if any
                     ->notPath(['/_generated/'])
                // 💡 extra configs
                // ->ignoreDotFiles(false) // true by default in v3, false in v4 or future mode
                // ->ignoreVCS(true) // true by default
            );
    }

    /**
     * @phpstan-return array<string, array<string, array<string, string>|bool|string>|bool>
     */
    private function buildRules(): array
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

            'encoding'                                      => true,
            'blank_lines_before_namespace'                  => true,
            'blank_line_after_opening_tag'                  => false, // psr 12 = true
            'strict_param'                                  => true,
            'no_useless_else'                               => true,
            'no_useless_return'                             => true,
            'modernize_types_casting'                       => true,
            'declare_strict_types'                          => true,
            'dir_constant'                                  => true,

            'php_unit_dedicate_assert'                      => ['target' => 'newest'],
            'combine_nested_dirname'                        => true,

            'ordered_imports'                               => [
                'sort_algorithm' => 'alpha',
            ],

            'global_namespace_import'                       => [
                'import_classes'   => true,
                'import_functions' => true,
                'import_constants' => true,
            ],

            'phpdoc_to_comment'                                => false,
            'nullable_type_declaration_for_default_null_value' => true,
            // prevent mega diff
            'blank_line_between_import_groups'              => false, // PSR 12 = true
        ];
    }
}

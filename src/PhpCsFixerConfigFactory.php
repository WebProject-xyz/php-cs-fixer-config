<?php

declare(strict_types=1);

namespace WebProject\PhpCsFixerConfig;

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;
use WebProject\PhpCsFixerConfig\RuleSet\WebProjectSet;

final readonly class PhpCsFixerConfigFactory
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
            ->setFinder(
                $this->buildFinder($dirs, $excludeDirs)
            );
    }

    /**
     * @phpstan-return array<string, array<string, array<string, string>|bool|string>|bool>
     */
    private function buildRules(): array
    {
        return new WebProjectSet()->getRules();
    }

    /**
     * @phpstan-param string|string[] $dirs
     * @phpstan-param string|string[] $excludeDirs
     */
    private function buildFinder(array|string $dirs, array|string $excludeDirs = []): Finder
    {
        // 💡 by default, Fixer looks for `*.php` files excluding `./vendor/` - here, you can groom this config
        return new Finder()
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
        ;
    }
}

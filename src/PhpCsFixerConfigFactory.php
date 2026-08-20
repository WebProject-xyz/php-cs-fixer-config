<?php

declare(strict_types=1);

namespace WebProject\PhpCsFixerConfig;

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;
use Symfony\Component\Finder\SplFileInfo;
use WebProject\PhpCsFixerConfig\RuleSet\WebProjectSet;

use function basename;
use function debug_backtrace;
use function dirname;
use function in_array;

use const DEBUG_BACKTRACE_IGNORE_ARGS;

final readonly class PhpCsFixerConfigFactory
{
    public const string NAME = 'WebProject-Style';

    /**
     * @phpstan-param string|string[] $dirs
     * @phpstan-param string|string[] $excludeDirs
     * @phpstan-param string[] $append
     */
    public function __invoke(array|string $dirs = [], array|string $excludeDirs = [], array $append = [], bool $autoAppendFixerConfigFile = true): Config
    {
        $calledFromFilePath = $this->findConfigFile();

        // append config file formatting
        if ($autoAppendFixerConfigFile && $calledFromFilePath && !in_array($calledFromFilePath, $append, true)) {
            $append[] = $calledFromFilePath;
        }

        // no scan folder added -> scan project
        if ([] === $dirs && $calledFromFilePath) {
            $calledFromDir = dirname($calledFromFilePath);
            $dirs[]        = $calledFromDir;
        }

        return (new Config(self::NAME))
            ->setRiskyAllowed(true)
            ->setRules($this->buildRules())
            ->setUsingCache(true)
            ->setLineEnding("\n")
            ->setRiskyAllowed(true)
            ->setParallelConfig(ParallelConfigFactory::detect())
            ->setUnsupportedPhpVersionAllowed(true)
            ->setFinder(
                $this->buildFinder($dirs, $excludeDirs, $append)
            );
    }

    /**
     * @phpstan-return array<string, array<string, array<string, string>|bool|string>|bool>
     */
    private function buildRules(): array
    {
        return (new WebProjectSet())->getRules();
    }

    /**
     * @phpstan-param string|string[] $dirs
     * @phpstan-param string|string[] $excludeDirs
     * @phpstan-param iterable<SplFileInfo|\SplFileInfo|string> $append
     */
    private function buildFinder(array|string $dirs, array|string $excludeDirs = [], iterable $append = []): Finder
    {
        // 💡 by default, Fixer looks for `*.php` files excluding `./vendor/` - here, you can groom this config
        return (new Finder())
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
            ->append($append)
        ;
    }

    private function findConfigFile(): ?string
    {
        $calledFromFilePath = null;
        foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5) as $trace) {
            $calledFromFilePath = $trace['file'] ?? null;
            if (!$calledFromFilePath) {
                continue;
            }
            $calledFromFile = basename($calledFromFilePath);
            if ('.php-cs-fixer.php' === $calledFromFile || '.php-cs-fixer.php.dist' === $calledFromFile) {
                break;
            }
        }

        return $calledFromFilePath;
    }
}

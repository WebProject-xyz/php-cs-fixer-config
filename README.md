# php-cs-fixer-config

[![CI](https://github.com/WebProject-xyz/php-cs-fixer-config/actions/workflows/ci.yml/badge.svg)](https://github.com/WebProject-xyz/php-cs-fixer-config/actions/workflows/ci.yml)
[![Latest Stable Version](https://img.shields.io/packagist/v/webproject-xyz/php-cs-fixer-config.svg)](https://packagist.org/packages/webproject-xyz/php-cs-fixer-config)
[![PHP Version](https://img.shields.io/badge/php-%7E8.5.0-blue.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![Codeception](https://img.shields.io/badge/codeception-%5E5.3-red.svg)](https://codeception.com/)

> **Common PHP CS Fixer configuration for WebProject projects.**

Provides a standardized, robust, and modern PHP CS Fixer configuration.

---

## 🚀 Key Features

- **Preconfigured Rules:** Includes standard rule sets like `@PSR12`, `@Symfony`, `@Symfony:risky`, `@PhpCsFixer:risky`, and `@PHP8x3Migration`.
- **Parallel Execution:** Automatically detects and utilizes multiple CPU cores for faster analysis.
- **Risky Rules Enabled:** Risky refactorings are allowed by default.

---

## 📦 Installation

Install the package via Composer:

```bash
composer require --dev webproject-xyz/php-cs-fixer-config
```

### Prerequisites
- **PHP:** `~8.5.0`

---

## 🛠️ Usage

Create a `.php-cs-fixer.php` file in the root of your project:

```php
<?php

declare(strict_types=1);

return new \WebProject\PhpCsFixerConfig\PhpCsFixerConfigFactory()(__DIR__);
```

### Customizing Directories and Exclusions

You can pass specific directories to check, as well as directories to exclude:

```php
<?php

declare(strict_types=1);

return new \WebProject\PhpCsFixerConfig\PhpCsFixerConfigFactory()(
    dirs: [
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ],
    excludeDirs: [
        __DIR__ . '/tests/_output',
    ]
);
```

---

## 🧪 Development & Testing

We maintain high standards for this module:
- **Static Analysis:** PHPStan Level 8.
- **Coding Style:** Strict PSR-12/Symfony standards.
- **Automation:** GrumPHP hooks ensure all commits are verified.

### Commands
```bash
composer qa        # Run all Quality Assurance checks (build tests, fix CS, run tests, run phpstan)
composer stan      # Run static analysis
composer test      # Run unit tests
composer cs:check  # Check coding standards
composer cs:fix    # Fix coding standards automatically
```

---

## 🤝 Contributing

Contributions are welcome! Please see our [CONTRIBUTING.md](CONTRIBUTING.md) for details.

1. Fork the Project.
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`).
3. Commit your Changes (`git commit -m 'feat: Add some AmazingFeature'`).
4. Push to the Branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

---

## 📜 License

Distributed under the **MIT** License. See `LICENSE` for more information.

---

## ✉️ Support & Contact

- **Issues:** Please use the [GitHub Issue Tracker](https://github.com/WebProject-xyz/php-cs-fixer-config/issues).
- **Website:** [webproject.xyz](https://www.webproject.xyz)

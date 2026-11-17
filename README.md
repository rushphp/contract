![PHP](https://img.shields.io/badge/PHP-%20^8.3-777BB4)
![PHPStan-Level](https://img.shields.io/badge/PHPStan-Level%209-224488)
![License](https://img.shields.io/badge/License-MIT-777)

# RUSH Contract

**RUSH** — Registry-driven Unified Shell Helper.

Contracts that guide the RUSH manager and every tool built for it. This package
contains only interfaces and small value types; it has no runtime dependencies.

## ✨ Features

- **Registry-ready**: every tool exposes a stable `key()` and `commands()`.
- **Unified commands**: one `CommandInterface` for every CLI command.
- **Standard I/O**: `InputInterface` and `OutputInterface` keep tools decoupled
  from any concrete terminal implementation.
- **Configuration export**: `ProvidesConfigInterface` lets tools publish
  side-effect-free config defaults.
- **Manager boundary**: `ToolManagerInterface` defines the lifecycle the runtime
  must implement.

## 📦 Installation

```bash
composer require rushphp/contract
```

### Requirements

- PHP 8.3 or newer.
- No runtime dependencies.

## 🧩 Contracts

| Contract | Purpose |
| --- | --- |
| `ToolInterface` | A tool: key, metadata, commands and install layout. |
| `CommandInterface` | A CLI command: metadata, options and execution. |
| `InputInterface` | Normalized option/argument access. |
| `OutputInterface` | Standard line/info/success/warning/error output. |
| `ProvidesConfigInterface` | Side-effect-free configuration defaults. |
| `ToolManagerInterface` | Attach, boot, run and terminate tools. |
| `Option` | Command option value type. |
| `ExitCode` | Stable process exit codes. |

## 🛠️ Writing a tool

```php
<?php declare(strict_types=1);

namespace Acme\Tool\Deploy;

use Rush\Contract\CommandInterface;
use Rush\Contract\ToolInterface;

final class DeployTool implements ToolInterface
{
    public function key(): string
    {
        return 'deploy';
    }

    public function name(): string
    {
        return 'Deploy';
    }

    public function description(): string
    {
        return 'Deploys the application.';
    }

    public function version(): string
    {
        return '1.0.0';
    }

    /** @return array<string, CommandInterface> */
    public function commands(string $projectRoot): array
    {
        return [
            'deploy push' => new PushCommand($projectRoot),
        ];
    }

    /** @return list<string> */
    public function install(string $projectRoot): array
    {
        return [];
    }
}
```

Register the tool class in `composer.json`:

```json
"extra": {
    "rush": {
        "tool": "Acme\\Tool\\Deploy\\DeployTool"
    }
}
```

Then enable it in the project's `rush.json`:

```json
{
    "tools": {
        "deploy": true
    }
}
```

## 🧠 Design pillars

1. Simplicity
2. Maintainability
3. Performance
4. Portability (decoupling)
5. Security

The contracts stay intentionally small. Features are added only when there is a
real consumer, not speculatively.

## 🤝 Contributions

Contributions are welcome. Open an issue or submit a pull request.

## 📄 License

MIT. See [LICENSE](LICENSE).

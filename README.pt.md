[English](README.md) | [Português](README.pt.md)

![PHP](https://img.shields.io/badge/PHP-%20^8.3-777BB4)
![PHPStan-Level](https://img.shields.io/badge/PHPStan-Level%209-224488)
![License](https://img.shields.io/badge/License-MIT-777)

# RUSH Contract

**RUSH** — Registry-driven Unified Shell Helper.

Contratos que orientam o manager do RUSH e qualquer tool criado para ele. Este
pacote contém apenas interfaces e tipos de valor pequenos; não possui
dependências de runtime.

## ✨ Recursos

- **Pronto para o registry**: cada tool expõe um `key()` e `commands()` estáveis.
- **Comandos unificados**: um único `CommandInterface` para todo comando de CLI.
- **I/O padrão**: `InputInterface` e `OutputInterface` mantêm as tools
  desacopladas de qualquer implementação concreta de terminal.
- **Exportação de configuração**: `ProvidesConfigInterface` permite que as tools
  publiquem defaults de configuração sem efeitos colaterais.
- **Fronteira do manager**: `ToolManagerInterface` define o lifecycle que o
  runtime deve implementar.

## 📦 Instalação

```bash
composer require rushphp/contract
```

### Requisitos

- PHP 8.3 ou superior.
- Sem dependências de runtime.

## 🧩 Contratos

| Contrato | Finalidade |
| --- | --- |
| `ToolInterface` | Uma tool: key, metadados, comandos e layout de instalação. |
| `CommandInterface` | Um comando de CLI: metadados, opções e execução. |
| `InputInterface` | Acesso normalizado a opções e argumentos. |
| `OutputInterface` | Saída padronizada de linha/info/sucesso/aviso/erro. |
| `ProvidesConfigInterface` | Defaults de configuração sem efeitos colaterais. |
| `ToolManagerInterface` | Anexar, inicializar, executar e encerrar tools. |
| `Option` | Tipo de valor de uma opção de comando. |
| `ExitCode` | Códigos de saída estáveis do processo. |

## 🛠️ Escrevendo uma tool

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

Registre a classe da tool no `composer.json`:

```json
"extra": {
    "rush": {
        "tool": "Acme\\Tool\\Deploy\\DeployTool"
    }
}
```

Depois habilite-a no `rush.json` do projeto:

```json
{
    "tools": {
        "deploy": true
    }
}
```

## 🤝 Contribuições

Contribuições são bem-vindas. Abra uma issue ou envie um pull request.

## 📄 Licença

MIT. Consulte [LICENSE](LICENSE).

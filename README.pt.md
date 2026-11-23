[English](README.md) | [Português](README.pt.md)

![PHP](https://img.shields.io/badge/PHP-%20^8.3-777BB4)
![PHPStan-Level](https://img.shields.io/badge/PHPStan-Level%209-224488)
![License](https://img.shields.io/badge/License-MIT-777)

# RUSH Contract

**RUSH** — Registry-driven Unified Shell Helper.

Contratos que orientam o manager do RUSH e qualquer tool criado para ele. Este
pacote contém apenas interfaces e tipos de valor pequenos; não possui
dependências de runtime.

> **Pré-1.0:** releases minor podem incluir mudanças incompatíveis.

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
| `OperatorPolicyInterface` | Opcional: dispensa a tool do gate de operador. |
| `Option` | Tipo de valor de uma opção de comando. |
| `ExitCode` | Códigos de saída estáveis do processo. |

### Semântica de opções

- `takesValue` define se `--name valor` / `--name=valor` é aceito.
- `default` é aplicado pelo manager quando a opção está ausente (string, int ou bool).
- `required` faz o manager rejeitar uma opção ausente.
- `required` tem precedência sobre `default`.
- `short` mapeia uma flag de um caractere (`-n`), incluindo clusters (`-abc`).
- `repeatable` acumula cada ocorrência em uma lista, lida via `InputInterface::strings()`.
- `InputInterface::hasValue()` informa se a opção está presente com valor.
- `OutputInterface::write()` escreve sem quebra de linha.

Tools que não implementam `OperatorPolicyInterface` exigem um operador
configurado para seus comandos, preservando o comportamento padrão de auditoria.

### Requisitos de uma tool

- Classes de tool devem ser instanciáveis sem argumentos de construtor.
- `install()` é obrigatório; retorne uma lista vazia quando não houver nada a instalar.

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
        return '0.1.0';
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

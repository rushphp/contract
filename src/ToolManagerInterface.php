<?php declare(strict_types=1);

namespace Rush\Contract;


interface ToolManagerInterface
{
    public function attach(ToolInterface $tool): void;

    /** @return array<string, ToolInterface> */
    public function tools(): array;

    /**
     * Collects the defaults exported by tools that provide configuration.
     *
     * @return array<string, mixed>
     */
    public function exportConfig(): array;

    public function boot(): void;

    /** @param list<string> $argv */
    public function run(array $argv): int;

    public function terminate(): void;
}

<?php declare(strict_types=1);

namespace Rush\Contract;


interface InputInterface
{
    public function has(string $name): bool;

    public function bool(string $name): bool;

    public function string(string $name, ?string $default = null): ?string;

    public function int(string $name, int $default): int;

    /**
     * Values of a repeatable option, in the order they were provided.
     *
     * @return list<string>
     */
    public function strings(string $name): array;

    /**
     * Whether the option is present with a usable value.
     */
    public function hasValue(string $name): bool;

    /** @return list<string> */
    public function arguments(): array;
}

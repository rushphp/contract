<?php declare(strict_types=1);

namespace Rush\Contract;


final class Option
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly bool $takesValue = false,
        public readonly null|string|int|bool $default = null,
        public readonly bool $required = false,
        public readonly string $valueName = 'value',
        public readonly ?string $short = null,
        public readonly bool $repeatable = false,
    ) {
    }
}

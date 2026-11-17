<?php declare(strict_types=1);

namespace Rush\Contract;


interface ProvidesConfigInterface
{
    /**
     * Default configuration exported by the tool.
     *
     * Implementations MUST be side-effect free and MUST NOT resolve
     * container services. Keys are namespaced by the tool key.
     *
     * @return array<string, mixed>
     */
    public function config(): array;
}

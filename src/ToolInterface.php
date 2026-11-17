<?php declare(strict_types=1);

namespace Rush\Contract;


interface ToolInterface
{
    /**
     * Unique machine identifier of the tool (e.g. "code", "schema", "app").
     */
    public function key(): string;

    /**
     * Human readable name.
     */
    public function name(): string;

    public function description(): string;

    public function version(): string;

    /**
     * Commands exposed by this tool, keyed by the command name.
     *
     * @return array<string, CommandInterface>
     */
    public function commands(string $projectRoot): array;

    /**
     * Creates the tool's local control layout.
     *
     * @return list<string> Human readable lines describing what was created.
     */
    public function install(string $projectRoot): array;
}

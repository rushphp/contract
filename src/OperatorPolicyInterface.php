<?php declare(strict_types=1);

namespace Rush\Contract;


interface OperatorPolicyInterface
{
    /**
     * Whether commands from this tool require a configured operator.
     *
     * Tools that do not implement this interface are treated as requiring
     * an operator, preserving the default audit behaviour.
     */
    public function requiresOperator(): bool;
}

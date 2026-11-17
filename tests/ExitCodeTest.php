<?php declare(strict_types=1);

use Rush\Contract\ExitCode;

it('exposes stable exit codes', function (): void {
    expect(ExitCode::Success->value)->toBe(0)
        ->and(ExitCode::Failure->value)->toBe(1)
        ->and(ExitCode::Invalid->value)->toBe(2)
        ->and(ExitCode::CheckFailed->value)->toBe(3);
});

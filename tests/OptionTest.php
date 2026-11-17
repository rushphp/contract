<?php declare(strict_types=1);

use Rush\Contract\Option;

it('builds a flag option with defaults', function (): void {
    $option = new Option('verbose', 'Verbose output');

    expect($option->name)->toBe('verbose')
        ->and($option->description)->toBe('Verbose output')
        ->and($option->takesValue)->toBeFalse()
        ->and($option->default)->toBeNull()
        ->and($option->required)->toBeFalse()
        ->and($option->valueName)->toBe('value');
});

it('builds a required value option', function (): void {
    $option = new Option('target', 'Target name', true, null, true, 'name');

    expect($option->takesValue)->toBeTrue()
        ->and($option->required)->toBeTrue()
        ->and($option->valueName)->toBe('name');
});

it('accepts a default value', function (): void {
    $option = new Option('format', 'Output format', true, 'text');

    expect($option->default)->toBe('text');
});

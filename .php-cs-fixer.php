<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['vendor', 'node_modules', 'public']);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,

        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['default' => 'single_space'],

        'ordered_imports' => true,
        'no_unused_imports' => true,

        'trailing_comma_in_multiline' => ['elements' => ['arrays']],

        // optional, but recommended
        // 'declare_strict_types' => true,
    ])
    ->setFinder($finder);

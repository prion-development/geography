<?php

namespace PrionDevelopment\Geography\Contracts;

interface ProviderInterface
{
    public function boot(): void;

    public function register(): void;
}

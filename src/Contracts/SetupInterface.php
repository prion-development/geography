<?php

namespace PrionDevelopment\Geography\Contracts;

interface SetupInterface
{
    public function boot(): void;

    public function register(): void;
}

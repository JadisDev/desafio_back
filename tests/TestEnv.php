<?php

namespace App\Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

abstract class TestEnv extends TestCase
{
    public function setUp(): void
    {
        $dotenv = Dotenv::createMutable(__DIR__ . '/../');
        $dotenv->load();
    }
}

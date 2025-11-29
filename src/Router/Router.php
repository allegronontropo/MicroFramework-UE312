<?php

namespace UE312\Router;

use Symfony\Component\HttpFoundation\Request;
use UE312\Template\InterfaceRenderer;

interface Router {
    public function register(string $path, string $viewClass): void;
    public function serve(): void;
}

<?php

namespace UE312\Views;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UE312\Template\Renderer;

abstract class BaseView {
    protected Renderer $renderer;

    public function __construct(Renderer $renderer) {
        $this->renderer = $renderer;
    }

    abstract protected function use_template(): bool;
    abstract public function render(Request $request): Response;

    protected function get(Request $request): array { return []; }
    protected function post(Request $request): array { return []; }
}
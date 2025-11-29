<?php

namespace UE312\Views;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HtmlView extends BaseView {
    protected function use_template(): bool {
        return false;
    }

    public function render(Request $request): Response {
        $method = strtolower($request->getMethod());
        $data = $this->$method($request);
        
        return new Response($data['content'] ?? '', 200, ['Content-Type' => 'text/html']);
    }
}
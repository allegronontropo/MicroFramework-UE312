<?php

namespace UE312\Views;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class JsonView extends BaseView {
    protected function use_template(): bool {
        return false;
    }

    public function render(Request $request): Response {
        $method = strtolower($request->getMethod());
        $data = $this->$method($request);
        
        return new Response(
            json_encode($data), 
            200, 
            ['Content-Type' => 'application/json']
        );
    }
}
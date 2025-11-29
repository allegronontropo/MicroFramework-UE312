<?php

namespace UE312\Views;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UE312\Template\Renderer;

class TemplateView extends BaseView {
    protected function use_template(): bool {
        return true;
    }

    public function render(Request $request): Response {
        $method = strtolower($request->getMethod());
        $data = $this->$method($request);
        
        // eregistrer le chemin des templates pour cette classe (static::class) comme demandé ;)
        $className = static::class;
        $templatePath = __DIR__ . '/../../templates/';
        // $templatePath = __DIR__ . '/../../templates/' . $className;
        $this->renderer->register($className, $templatePath);
        
        $content = $this->renderer->render($data['template'] ?? 'index.twig', $data);
        
        return new Response($content);
    }
}
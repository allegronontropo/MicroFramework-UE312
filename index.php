<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';

use UE312\Router\SimpleRouter;
use UE312\Template\TwigRenderer;
use UE312\Views\TemplateView;
use Symfony\Component\HttpFoundation\Request;

class Book extends TemplateView {
    protected function get(Request $request): array {
        return [
            'template' => 'book.twig',
            'id' => $request->attributes->get('id'),
            'title' => 'Livre',
            'msg' => '', //chaine vide pour differencier
        ];
    }
    
    protected function post(Request $request): array {
        return [
            'template' => 'book.twig',
            'id' => $request->attributes->get('id'),
            'title' => 'Mon Livre',
            'msg' => 'Mon Livre livré par POST!'
        ];
    }
}

$engine = new TwigRenderer(__DIR__ . '/templates/');
$router = new SimpleRouter($engine);
$router->register('/book/:id', 'Book');
$router->serve();
<?php

namespace UE312\Router;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; 
use UE312\Template\Renderer;
use UE312\Views\BaseView;

class SimpleRouter implements Router {
    private array $routes = [];
    private Renderer $renderer;

    public function __construct(Renderer $renderer) {
        $this->renderer = $renderer;
    }

    public function register(string $path, string $viewClass): void {
        $this->routes[$path] = $viewClass;
    }

    public function serve(): void {
        //créer une nouvelle requete
        $request = Request::createFromGlobals();
        //récupère la view correspandante
        $path = $request->getPathInfo();
        //puis appelle la méthode render() de la view , cela sera envoyer à l'aide de send() 
        foreach ($this->routes as $route => $viewClass) {
            if ($this->matchRoute($route, $path, $request)) {
                $view = new $viewClass($this->renderer);
                $response = $view->render($request);
                $response->send();
                return;
            }
        }

    }

    private function matchRoute(string $route, string $path, Request $request): bool {
        $routeParts = explode('/', trim($route, '/'));
        $pathParts = explode('/', trim($path, '/'));

        if (count($routeParts) !== count($pathParts)) {
            return false;
        }

        for ($i = 0; $i < count($routeParts); $i++) {
            if (strpos($routeParts[$i], ':') === 0) {
                $paramName = substr($routeParts[$i], 1);
                $request->attributes->set($paramName, $pathParts[$i]);
            } elseif ($routeParts[$i] !== $pathParts[$i]) {
                return false;
            }
        }

        return true;
    }
}
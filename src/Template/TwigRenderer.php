<?php

namespace UE312\Template;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use UE312\Template\Renderer;

class TwigRenderer implements Renderer {
    private Environment $twig;

    public function __construct(string $templatesPath) {
        $loader = new FilesystemLoader($templatesPath);
        $this->twig = new Environment($loader);
    }

    public function render(string $template, array $data): string {
        return $this->twig->render($template, $data);
    }

    public function register(string $tag, string $path): void {
        $this->twig->getLoader()->addPath($path, $tag);
    }
}
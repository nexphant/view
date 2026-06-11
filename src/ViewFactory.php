<?php

namespace Nexph\View;

class ViewFactory
{
    public function __construct(
        private string $basePath
    ) {}

    public function make(string $view, array $data = []): View
    {
        $base = $this->basePath . '/' . str_replace('.', '/', $view);
        $path = file_exists($base . '.nx.php') ? $base . '.nx.php' : $base . '.php';
        return new View($path, $data);
    }
}

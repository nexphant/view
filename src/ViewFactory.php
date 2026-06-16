<?php

namespace nexphant\View;

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

    public function raw(string $path): string
    {
        $file = $this->basePath . '/' . ltrim($path, '/');
        return file_exists($file) ? file_get_contents($file) : '';
    }
}

<?php

namespace nexphant\View;

class View
{
    public function __construct(
        private string $path,
        private array $data = []
    ) {}

    public function render(): string
    {
        $basePath = defined('nexphant_BASE_PATH') ? nexphant_BASE_PATH : getcwd();
        $compiled = (new ViewCompiler($basePath . '/storage/nexphant/views'))->compile($this->path);
        extract($this->data);
        ob_start();
        require $compiled;
        return ob_get_clean();
    }

    public function with(string $key, mixed $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }
}

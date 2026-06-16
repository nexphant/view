<?php

namespace nexphant\View;

class ViewResponse
{
    public function __construct(
        private View $view
    ) {}

    public function render(): string
    {
        return $this->view->render();
    }
}

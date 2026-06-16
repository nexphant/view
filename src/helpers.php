<?php

namespace Nexphant\View {
    if (!function_exists(__NAMESPACE__ . '\\view')) {
        function view(string $view, array $data = []): ViewResponse
        {
            static $factory = null;
            if ($factory === null) {
                $basePath = defined('NEXPHANT_BASE_PATH') ? NEXPHANT_BASE_PATH : getcwd();
                $viewPath = defined('NEXPHANT_VIEW_PATH') ? NEXPHANT_VIEW_PATH : $basePath . '/resources/views';
                $factory = new ViewFactory($viewPath);
            }
            return new ViewResponse($factory->make($view, $data));
        }
    }

    if (!function_exists(__NAMESPACE__ . '\\raw')) {
        function raw(string $path): string
        {
            static $factory = null;
            if ($factory === null) {
                $basePath = defined('NEXPHANT_BASE_PATH') ? NEXPHANT_BASE_PATH : getcwd();
                $viewPath = defined('NEXPHANT_VIEW_PATH') ? NEXPHANT_VIEW_PATH : $basePath . '/resources/views';
                $factory = new ViewFactory($viewPath);
            }
            return $factory->raw($path);
        }
    }

    if (!function_exists(__NAMESPACE__ . '\\nx')) {
        function nx(mixed $value): string
        {
            return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
        }
    }

    if (!function_exists(__NAMESPACE__ . '\\nx_json')) {
        function nx_json(mixed $data): string
        {
            return htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
        }
    }

    if (!function_exists(__NAMESPACE__ . '\\nx_asset')) {
        function nx_asset(string $path): string
        {
            return '/' . ltrim($path, '/');
        }
    }

    if (!function_exists(__NAMESPACE__ . '\\nx_island')) {
        function nx_island(string $name, array $props): string
        {
            $encoded = htmlspecialchars(json_encode($props), ENT_QUOTES, 'UTF-8');
            return sprintf('<div nx-island="%s" nx-props="%s"></div>', nx($name), $encoded);
        }
    }

    if (!function_exists(__NAMESPACE__ . '\\nx_mount')) {
        function nx_mount(string $name, array $props): string
        {
            $encoded = htmlspecialchars(json_encode($props), ENT_QUOTES, 'UTF-8');
            return sprintf('<div nx-mount="%s" nx-props="%s"></div>', nx($name), $encoded);
        }
    }
}

namespace {
    if (!function_exists('raw')) {
        function raw(string $path): string
        {
            return \Nexphant\View\raw($path);
        }
    }

    if (!function_exists('nx')) {
        function nx(mixed $value): string
        {
            return \Nexphant\View\nx($value);
        }
    }

    if (!function_exists('nx_json')) {
        function nx_json(mixed $data): string
        {
            return \Nexphant\View\nx_json($data);
        }
    }

    if (!function_exists('nx_asset')) {
        function nx_asset(string $path): string
        {
            return \Nexphant\View\nx_asset($path);
        }
    }

    if (!function_exists('nx_island')) {
        function nx_island(string $name, array $props): string
        {
            return \Nexphant\View\nx_island($name, $props);
        }
    }

    if (!function_exists('nx_mount')) {
        function nx_mount(string $name, array $props): string
        {
            return \Nexphant\View\nx_mount($name, $props);
        }
    }
}

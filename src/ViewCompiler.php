<?php

namespace nexphant\View;

class ViewCompiler
{
    private string $cachePath;

    public function __construct(string $cachePath)
    {
        $this->cachePath = $cachePath;
        if (!is_dir($cachePath)) {
            mkdir($cachePath, 0755, true);
        }
    }

    public function compile(string $path): string
    {
        $hash = md5($path);
        $compiled = $this->cachePath . '/' . $hash . '.php';

        if (!file_exists($compiled) || (file_exists($path) && filemtime($path) > filemtime($compiled))) {
            $content = file_get_contents($path);
            $content = $this->compileDirectives($content);
            file_put_contents($compiled, $content);
        }

        return $compiled;
    }

    private function compileDirectives(string $content): string
    {
        $content = preg_replace('/\{\{\s*(.+?)\s*\}\}/', '<?= nx($1) ?>', $content);
        $content = preg_replace('/\{!!\s*(.+?)\s*!!\}/', '<?= $1 ?>', $content);
        $content = preg_replace('/@if\s*\((.+?)\)/', '<?php if ($1): ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);
        $content = preg_replace('/@foreach\s*\((.+?)\)/', '<?php foreach ($1): ?>', $content);
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);
        $content = preg_replace('/@include\([\'"](.+?)[\'"]\)/', '<?php include view(\'$1\')->render(); ?>', $content);
        $content = preg_replace('/@extends\([\'"](.+?)[\'"]\)/', '<?php $__layout = \'$1\'; ?>', $content);
        $content = preg_replace('/@section\([\'"](.+?)[\'"]\)/', '<?php ob_start(); $__section = \'$1\'; ?>', $content);
        $content = preg_replace('/@endsection/', '<?php $__sections[$__section] = ob_get_clean(); ?>', $content);
        $content = preg_replace('/@yield\([\'"](.+?)[\'"]\)/', '<?= $__sections[\'$1\'] ?? \'\' ?>', $content);
        $content = preg_replace('/@island\([\'"](.+?)[\'"]\s*,\s*(\[.+?\])\)/', '<?= nx_island(\'$1\', $2) ?>', $content);
        $content = preg_replace('/@mount\([\'"](.+?)[\'"]\s*,\s*(\[.+?\])\)/', '<?= nx_mount(\'$1\', $2) ?>', $content);
        return $content;
    }
}

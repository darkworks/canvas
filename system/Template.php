<?php
/**
 * Designed to work with templates
 */
class Template
{

    /**
     * Render templatet
     * @param  string $name   template name
     * @param  array  $params paramt for template
     * @return void
     */
    public static function render($name, $params = [])
    {
        $templatePath = SYSPATH . 'view/' . $name . '.php';

        if (file_exists($templatePath)) {
            extract($params, EXTR_SKIP);
            include ($templatePath);
        }
    }
}

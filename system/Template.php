<?php

class Template
{
    public static function render($name, $params = [])
    {
        $templatePath = SYSPATH . 'view/' . $name . '.php';

        if (file_exists($templatePath)) {
            extract($params, EXTR_SKIP);
            include ($templatePath);
        }
    }
}

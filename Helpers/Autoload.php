<?php declare( strict_types = 1 );

/**
 * Custom simple autoload for classes
 */
spl_autoload_register(function ($class){
    if (file_exists(str_replace('\\', '/', $class).'.php'))
        require_once str_replace('\\', '/', $class).'.php';
});
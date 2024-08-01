<?php 

spl_autoload_register(function ($class){
    $dirs = ['gamemodels','utils','services','exceptions','core', 'config', 'controller', 'database', 'model', 'responses', 'vendor','tests'];
    foreach ($dirs as $dir) {
        $filename = $dir . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($filename)) {
            include $filename;
            return;
        }
    }
});

// spl_autoload_register(function ($class) {
//     $dirs = ['services', 'exceptions', 'core', 'config', 'controller', 'database', 'model', 'responses', 'vendor', 'tests'];
//     foreach ($dirs as $dir) {
//         $filename = $dir . DIRECTORY_SEPARATOR . $class . '.php';
//         if (file_exists($filename)) {
//             include $filename;
//             return;
//         }
//     }

// });
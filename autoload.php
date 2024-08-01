<?php 

spl_autoload_register(function ($class){
    $dirs = ['games/Eleven5','games/Fast3','games/FiveD','games/Happy8','games/Mark6','games/Pk10','games/ThreeD','utils','services','exceptions','core', 'config', 'controller', 'database', 'model', 'responses', 'vendor','tests'];
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
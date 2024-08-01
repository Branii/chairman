<?php 

class Exceptions {
    public static function panic (Throwable $th) : void {
        
        $errorInfo = [
            'status'  => 'error',
            'message' => $th->getMessage(),
            'line'    => $th->getLine(),
            'file'    => $th->getFile(),
            'trace'   => $th->getTrace()
        ];

        $path = './log.txt';
        file_put_contents($path, json_encode($errorInfo) . PHP_EO , FILE_APPEND);

    }

}
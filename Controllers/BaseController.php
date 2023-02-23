<?php 
class BaseController {
    protected $data;
    public function view($viewName, $pram = []) {
        ob_start();
        $this->data = $pram;
        if(file_exists(__DIR__."/../Views/$viewName")){
            include(__DIR__ . "/../Views/$viewName");
        }
        else {
            include(__DIR__ . "/../Views/404.php");
        }
        $str = ob_get_contents();
        ob_end_clean();
        echo $str;
    }
}
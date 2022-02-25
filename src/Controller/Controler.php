<?php

namespace App\Controller;

class Controler
{
    public function render(string $view, string $tittle, array $data = null)
    {
        ob_start();
        require dirname(__FILE__) . "/../../templates/$view";
        $html = ob_get_clean();
        //require dirname(__FILE__) . "/../../templates/_partials/base.view.php";
    }
}
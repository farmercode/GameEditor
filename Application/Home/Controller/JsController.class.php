<?php

namespace Home\Controller;

class JsController extends BaseController{

    function loots(){
        $model = D("Lootbase");
        $json = $model->getLootsJsonData();
        $content = "var Loots= ".$json;
        $content .= ";";
        echo $content;
    }
}
<?php
//Main Controller
//play as a bridge to connect db to view
class Controller
{
    public function model($model)
    {
        require_once 'mvc/model/' . $model . '.php';
        return new $model;
    }

    public function view($view, $data = []){
        require_once 'mvc/view/'.$view.'.php';
    }
}

<?php
class BaseController
{
    public function model($model)
    {
        require_once "./App/models/" . $model . ".php";
        return new $model;
    }

    public function view($view, $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        require_once "./App/views/layouts/" . $view . ".php";
    }
}

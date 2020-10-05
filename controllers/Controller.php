<?php

class Controller
{
    protected $request;
    protected $view;
    protected $model;

    public function __construct()
    {
        $this->request = new Request();
        $this->loadModel(get_called_class());
    }

    public function loadView($view_name, $data)
    {
        $view_path = DIR_VIEW . ltrim($view_name, '/') . '.php';
        if (file_exists($view_path)) {
            require_once($view_path);
            return true;
        } else {
            return false;
        }
    }
    
    public function loadModel($model_name)
    {
        $model_name .= 'Model';
        $this->model = new $model_name();
    }
    
}

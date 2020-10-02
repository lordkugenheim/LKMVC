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

    public function loadView($view_name)
    {
        $this->view = new $view_name();
    }
    
    public function loadModel($model_name)
    {
        $model_name .= 'Model';
        $this->model = new $model_name();
    }
    
}

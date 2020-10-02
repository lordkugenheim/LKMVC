<?php

class Repeat extends Controller
{
    public function httpGet()
    {
        $request_data = $this->request->other_parameters;
        $model_data = $this->model->httpGet($request_data);
        var_dump($model_data);
    }
}

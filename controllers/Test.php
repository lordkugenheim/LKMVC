<?php

class Test extends Controller
{
    public function httpGet()
    {
        $request_data = $this->request->other_parameters;
        $model_data = $this->model->httpGet($request_data);
        $this->loadView('json', $model_data);
    }
}

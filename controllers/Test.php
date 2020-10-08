<?php

class Test extends Controller
{
    public function httpGet()
    {
        $request_data = Request::otherParameters();
        $model_data = $this->model->httpGet($request_data);
        $this->loadView('json', $model_data);
    }
}

<?php

/**
 * Test Controller
 *
 * Simple endpoint that will return the input value as json
 *
 * @author Ben Taylor-Wilson <ben@ben-taylor.co.uk>
 * @see http://www.ben-taylor.co.uk/LKMVC
 */
class Test extends Controller
{
    /**
     * Get Endpoint
     * for example:'http://www.ben.taylor.co.uk/test/'
     */
    public function httpGet()
    {
        $request_data = Request::otherParameters();
        $model_data = $this->model->httpGet($request_data);
        Controller::loadView('json', $model_data);
    }
}

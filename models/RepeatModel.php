<?php

class RepeatModel
{
    public function httpGet($data)
    {
        if (!empty($data)) {
            return [
                'data' => $data[0],
                'status' => 'success',
                'http_status' => 200,
            ];
        } else {
            return [
                'data' => 'no repeat value sent',
                'status' => 'error',
                'http_status' => 400,
            ];
        }
    }
}

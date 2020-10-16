<?php

/**
 * View to create a json response
 *
 * Requires a $data array containing
 * @param 'http_status' int
 * @param 'status' friendly status message
 * @param 'data' payload
 *
 * @author Ben Taylor-Wilson <ben@ben-taylor.co.uk>
 * @see http://www.ben-taylor.co.uk/LKMVC
 */

header('Content-Type: application/json');
http_response_code($data['http_status']);
echo json_encode([
    'status' => $data['status'],
    'message' => $data['data'],
]);

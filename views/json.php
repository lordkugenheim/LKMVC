<?php

header('Content-Type: application/json');
http_response_code($data['http_status']);
echo json_encode([
    'status:' => $data['status'],
    'message' => $data['data'],
]);

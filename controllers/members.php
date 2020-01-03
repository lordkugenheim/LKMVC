<?php

$response = Core\Response::getInstance();
$response->setSuccess(true);
$response->setHttpCode(200);
$response->addOutput(['message'=>'We did something harrumble!']);

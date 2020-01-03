<?php

$response = Core\Response::getInstance();
$response->setSuccess(true);
$response->addOutput(['message'=>'We did something harrumble!']);

<?php

Core\Controller::getInstance()->setSuccess(true);
Core\Controller::getInstance()->setHttpCode(200);
Core\Controller::getInstance()->addOutput(['message'=>'We did something harrumble!']);

<?php

namespace Core;

class Repeat extends Controller
{
    const ALLOWED_METHODS = [
        'POST',
    ];

    public function __construct()
    {
        echo 'happy days';
        parent::__construct();
    }
}



//TODO build a set of re-usable responses?
// switch () {
//     case 'POST':
//         if (isset($_POST['message'])) {
//             $output = trim($_POST['message']);
//             Core\Controller::getinstance()->setHttpCode(200);
//         } else {
//             $output = 'Malformed request';
//         }
//         break;
//     default:
//         $header = 'Allow: POST';
//         $output = 'Invalid request method. Allowed methods are POST';
//         Core\Controller::getinstance()->addHeader($header);
//         Core\Controller::getinstance()->setHttpCode(405);
//         break;
// }

// Core\Controller::getinstance()->addOutput(['message' => $output]);

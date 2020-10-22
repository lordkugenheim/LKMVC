# LKMVC

A simple PHP framework providing a MVC workflow that is suitable for app development or website development or both if you really want to. Includes database connector using PDO. 

## Installation

Clone this repo into your root directory
in `config/database.php` set your own database variables
in `public/.htaccess` change `RewriteBase` (line 4) to your own path to the public folder

## Usage

You can change how this framework behaves using the `SECOND_PARAM_METHOD` (found in `/config/core.php`). With this set to true, URLs are processed as `www.example.com/controller/method/param1/param2/...`. With this set to false, URLs are processed as `www.example.com/controller/param1/param2/...` and using the http request type as the method.

When adding your own endpoints, you must name your controller and model classes to match the endpoint name. For example the `www.example.com/test/` endpoint must have a file named `/controllers/Test.php` and `/controllers/TestModel.php`. 

The controller class must have a method either matching the second parameterin the url or the http request method (with `http` as a prefix) depending on `SECOND_PARAM_METHOD` (as above).

A test endpoint is included that will return whatever string you send to it as a JSON object.

## Database Class

## Authors

* **Ben Taylor-Wilson** - [Ben-Taylor.co.uk](https://www.ben-taylor.co.uk/)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

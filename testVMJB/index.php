<?php
require 'vendor/autoload.php';


use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

$validator = new EmailValidator();
$emailValid = $validator->isValid("example@example.com", new RFCValidation());
var_dump($emailValid);



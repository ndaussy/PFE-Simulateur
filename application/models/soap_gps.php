<?php

class Soap_gps extends CI_Model  {
    private $user_is_valid;

    function MyHeader($header) {
        if ((isset($header->Username)) && (isset($header->Password))) {
            if (ValidateUser($header->Username, $header->Password)) {
                $user_is_valid = true;
            }
        }
    }

    function MySoapRequest($request) {
        if ($this->user_is_valid) {
            // process request
        }
        else {
            throw new MyFault("MySoapRequest", "User not valid.");
        }
    }
}


?>
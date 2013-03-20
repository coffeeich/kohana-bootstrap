<?php defined('SYSPATH') OR die('No direct script access.');

class HTTP_Exception extends Kohana_HTTP_Exception {

    public function get_response() {
        return Kohana::$errors === TRUE ? parent::get_response() : '';
    }

}
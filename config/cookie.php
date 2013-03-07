<?php

return array(
    'salt'       => $_SERVER['SERVER_NAME'],
    'domain'     => '.' . join('.', array_slice(explode('.', $_SERVER['HTTP_HOST'], 2), 1)),
    'path'       => '/',
    'expiration' => 0,
    'secure'     => false,
    'httponly'   => false,
);
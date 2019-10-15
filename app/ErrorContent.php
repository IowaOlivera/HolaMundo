<?php


namespace App;


class ErrorContent
{
    public $code;
    public $title;

    function __construct($code, $title) {
        $this->code = $code;
        $this->title = $title;
    }
}

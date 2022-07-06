<?php

namespace controllers;

class Security
{
    public static function secureHTML($string)
    {
        return htmlentities($string);
    }
}

<?php

namespace RPurinton\Discommand;

class Config
{
    public static function get($name)
    {
        return json_decode(file_get_contents(__DIR__ . "/../conf/$name.json"), true);
    }
}

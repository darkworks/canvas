<?php

class System
{
    public static function crypt($password)
    {
        return md5($password);
    }
}
<?php

namespace AppBundle\Utils;

class Utils {

    public static function slugify($string) {
        $slug = str_replace(array(' ', '/'), array('-', '_'), $string);
        return $slug ? $slug : "-";
    }

    public static function unslugify($string) {
        //return str_replace(array('-', '_', '   '), array(' ', '/', ' - '), $string);
        return str_replace(array('-', '_', '+'), array(' ', '/', ' '), $string);
    }


    

    

    
    
    
}

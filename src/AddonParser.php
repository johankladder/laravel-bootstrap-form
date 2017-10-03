<?php


namespace JohanKladder\BootstrapTable;


class AddonParser
{

    public static function parse($addon, $value)
    {
        switch ($addon) {
            case 'url':
                return self::parseUrl($value);
                break;
            case 'imageurl':
                return self::parseImageUrl($value);
                break;
        }
    }

    private static function parseUrl($input)
    {
        return '<a href="' . $input . '">' . $input . '</a>';
    }

    private static function parseImageUrl($input) {
        return '<img class="table-image" src="' . $input .'">';
    }

}
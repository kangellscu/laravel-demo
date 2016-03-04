<?php

namespace App\Utils;

class MoneyUnitConvertUtil
{
    /**
     * Convert money unit from yuan to fen,
     * 
     * @param float|string $yuan
     *
     * @return int fen
     */
    public static function yuanToFen($yuan)
    {        
        $fenStr = (string) ($yuan * 100);
        if ($pointIndex = strpos($fenStr, '.')) {
            return (int) substr($fenStr, 0, strpos($fenStr, '.'));
        } else {
            return (int) $fenStr;
        }
    }

    /**
     * Convert money unit from fen to yuan
     *
     * @param int $fen
     *
     * @return string yuan
     */
    public static function fenToYuan($fen)
    {
        return sprintf('%.2f', $fen / 100);
    }
}

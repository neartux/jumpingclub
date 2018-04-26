<?php
/**
 * User: ricardo
 * Date: 21/02/18
 */

namespace App\Utils\common;


use App\Utils\Keys\common\ApplicationKeys;

final class CommonsUtils {

    const NUMBER_ZERO = 0;
    const NUMBER_ONE = 1;
    const NUMBER_TWO = 2;
    const NUMBER_TRHEE = 3;
    const DASH = "-";


    public static function sum($number1, $number2) {
        if(empty($number1) || empty($number2)) {
            throw new \Exception('Invalid Numbers');
        }
        return floatval($number1) + floatval($number2);
    }

    public static function stringToDate($dateString) {
        $dateParts = explode('/', $dateString);
        return $dateParts[self::NUMBER_TWO].self::DASH.$dateParts[self::NUMBER_ONE].self::DASH.$dateParts[self::NUMBER_ZERO];
    }

}
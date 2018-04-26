<?php
/**
 * User: ricardo
 * Date: 24/04/18
 * Time: 08:17 PM
 */

namespace App\Repository\sale;


interface SaleInterface {

    public function findAllSalesByDates($startDate, $endDate, $typeDate);

}
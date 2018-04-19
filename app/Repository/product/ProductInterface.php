<?php

/**
 * User: ricardo
 * Date: 12/03/18
 */

namespace App\Repository\product;

interface ProductInterface {

    public function findProductType();

    public function findProductByProductType($productType);
}
<?php
/**
 * User: ricardo
 * Date: 12/03/18
 * Time: 07:42 PM
 */

namespace App\Repository\product;


use App\Models\Adjustment;
use App\Models\Client;
use App\Models\Deparment;
use App\Models\Product;
use App\Utils\Keys\common\ApplicationKeys;
use App\Utils\Keys\common\StatusKeys;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface {

    private $product;

    function __construct(Product $product) {
        $this->product = $product;
    }

    public function findProductType() {
        return DB::select('SELECT * FROM product_type WHERE product_type.status_id = '.StatusKeys::STATUS_ACTIVE);
    }

    public function findProductByProductType($productType) {
        return DB::select('SELECT * FROM product WHERE product.product_type_id = '.$productType.' AND product.status_id = '.StatusKeys::STATUS_ACTIVE);
    }
}
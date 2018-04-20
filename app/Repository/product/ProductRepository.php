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
use App\Models\ProductImage;
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

    public function findImagesByProduct($productId) {
        return DB::select("SELECT * FROM product_image WHERE product_image.product_id = ".$productId." AND product_image.status_id = ".StatusKeys::STATUS_ACTIVE." ORDER BY `order`");
    }

    public function findNextProductFolio() {
        return (DB::selectOne('SELECT max(id) AS folio FROM product_image')->folio) + 1;
    }

    public function createProduct($productValues) {
        $product = new Product();
        $product->status_id = StatusKeys::STATUS_ACTIVE;
        $product->product_type_id = $productValues['product_type_id'];
        $product->creation_date = Carbon::now();
        $product->name = $productValues['name'];
        $product->description = $productValues['description'];
        $product->area = $productValues['area'];
        $product->price = floatval($productValues['price']);
        $product->stock = floatval($productValues['stock']);
        $product->public = false;
        $product->save();
    }

    public function updateProduct($productValues) {
        $product = $this->product->findById($productValues['id']);
        if (!$product) {
            throw new \Exception("El product no se encontro");
        }
        $product->product_type_id = $productValues['product_type_id'];
        $product->name = $productValues['name'];
        $product->description = $productValues['description'];
        $product->area = $productValues['area'];
        $product->price = floatval($productValues['price']);
        $product->stock = floatval($productValues['stock']);
        $product->save();
    }

    public function publicProductById($productId, $isPublic) {
        $product = $this->product->findById($productId);
        if (!$product) {
            throw new \Exception("El product no se encontro");
        }
        $product->public = $isPublic == "true" ? true : false;
        $product->save();
    }

    public function deleteProduct($productId) {
        $product = $this->product->findById($productId);
        if (!$product) {
            throw new \Exception("El product no se encontro");
        }
        $product->status_id = StatusKeys::STATUS_INACTIVE;
        $product->save();
    }

    public function createProductImage($productId, $originalName, $name, $typeFile, $path) {
        $productImage = new ProductImage();
        $productImage->status_id = StatusKeys::STATUS_ACTIVE;
        $productImage->product_id = $productId;
        $productImage->original_name = $originalName;
        $productImage->name = $name;
        $productImage->type_file = $typeFile;
        $productImage->path = $path;
        $productImage->creation_date = Carbon::now();
        $productImage->main = false;

        $productImage->save();
    }
}
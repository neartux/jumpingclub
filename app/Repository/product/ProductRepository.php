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
use App\Models\ProductType;
use App\Utils\Keys\common\ApplicationKeys;
use App\Utils\Keys\common\StatusKeys;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductInterface {

    private $product;
    private $productImage;
    private $productType;

    function __construct(Product $product, ProductImage $productImage, ProductType $productType) {
        $this->product = $product;
        $this->productImage = $productImage;
        $this->productType = $productType;
    }

    public function findProductType() {
        return DB::select('SELECT * FROM product_type WHERE product_type.status_id = '.StatusKeys::STATUS_ACTIVE);
    }

    public function findProductByProductType($productType) {
        return DB::select('SELECT * FROM product WHERE product.product_type_id = '.$productType.' AND product.status_id = '.StatusKeys::STATUS_ACTIVE. ' ORDER BY product.id');
    }

    public function findImagesByProduct($productId) {
        return DB::select("SELECT * FROM product_image WHERE product_image.product_id = ".$productId." AND product_image.status_id = ".StatusKeys::STATUS_ACTIVE." ORDER BY `order`");
    }

    public function findNextProductFolio() {
        return (DB::selectOne('SELECT max(id) AS folio FROM product_image')->folio) + 1;
    }

    private function updateMainImagesByProduct($productId) {
        DB::table('product_image')->where('product_id', $productId)->update(['main' => false]);
    }

    public function createProduct($productValues) {
        $product = new Product();
        $product->status_id = StatusKeys::STATUS_ACTIVE;
        $product->product_type_id = $productValues['product_type_id'];
        $product->creation_date = Carbon::now();
        $product->name = $productValues['name'];
        $product->description = $productValues['description'];
        $product->area = $productValues['area'];
        $product->purchase_price = floatval($productValues['purchase_price']);
        $product->sale_price = floatval($productValues['sale_price']);
        $product->stock = floatval($productValues['stock']);
        $product->public = false;
        $product->save();

        return $product->id;
    }

    public function createProductType($values) {
        $type = new ProductType();
        $type->description = $values['description'];
        $type->status_id = StatusKeys::STATUS_ACTIVE;

        $type->save();

        return $type->id;
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
        $product->purchase_price = floatval($productValues['purchase_price']);
        $product->sale_price = floatval($productValues['sale_price']);
        $product->stock = floatval($productValues['stock']);
        $product->save();
    }

    public function updateTypeProduct($values) {
        $type = $this->productType->findById($values['id']);
        if (!$type) {
            throw new \Exception("La categoria no se encontro");
        }
        $type->description = $values['description'];
        $type->save();
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

    public function deleteProductType($id) {
        $type = $this->productType->findById($id);
        if (!$type) {
            throw new \Exception("La categoria no se encontro");
        }
        $type->status_id = StatusKeys::STATUS_INACTIVE;
        $type->save();
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
        $productImage->order = null;
        $productImage->main = false;

        $productImage->save();
    }

    public function findProductImageById($imageId) {
        return $this->productImage->findById($imageId);
    }

    public function setPrincipalImageByProduct($productImageId, $productId) {
        // Coloca en falta main todas las imagenes de un producto
        $this->updateMainImagesByProduct($productId);
        // Busca la imagen seleccionada y la coloca como principal
        $image = $this->findProductImageById($productImageId);
        if(! $image){
            throw new \Exception("No se encontro la imagen");
        }
        $image->main = true;

        $image->save();
    }

    public function deleteProductImage($imageId) {
        $image = $this->findProductImageById($imageId);
        if(! $image){
            throw new \Exception("No se encontro la imagen");
        }
        $image->status_id = StatusKeys::STATUS_INACTIVE;

        $image->save();
    }

    public function changeOrderImage($imageId, $order) {
        $image = $this->findProductImageById($imageId);
        if(! $image){
            throw new \Exception("No se encontro la imagen");
        }
        $image->order = $order;

        $image->save();
    }

    public function findProductByCodeOrDescription($re) {
        return DB::select('SELECT * FROM product WHERE status_id = '.StatusKeys::STATUS_ACTIVE.' AND (name LIKE \'%'.$re.'%\' OR description LIKE \'%'.$re.'%\')');
    }
}
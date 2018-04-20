<?php
/**
 * User: ricardo
 * Date: 27/02/18
 */

namespace App\Http\Controllers;


use App\Repository\product\ProductInterface;
use App\Utils\Keys\common\ApplicationKeys;
use Illuminate\Http\Request;

class ProductController extends Controller {

    private $product;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductInterface $product) {
        $this->middleware('auth');
        $this->product = $product;
    }

    public function productList() {
        return view('/admin/product/productlist');
    }

    public function findProductTypes() {
        return response()->json($this->product->findProductType());
    }

    public function findProductsByType($productTypeId) {
        return response()->json($this->product->findProductByProductType($productTypeId));
    }

    public function createProduct(Request $request) {
        try {
            $this->product->createProduct($request->all());
            return response()->json(array("error" => false, "message" => "se ha creado el producto correctamente"));
        } catch (\Exception $e) {
            return response()->json(array("error" => true, "message" => $e->getMessage()));
        }
    }

    public function updateProduct(Request $request) {
        try {

            $this->product->updateProduct($request->all());
            return response()->json(array("error" => false, "message" => "se ha actualizado el producto correctamente"));
        } catch (\Exception $e) {
            return response()->json(array("error" => true, "message" => $e->getMessage()));
        }
    }

    public function publicProduct(Request $request) {
        try {

            $this->product->publicProductById($request->input('productId'), $request->input('isPublic'));
            return response()->json(array("error" => false, "message" => "Realizado correctamente"));
        } catch (\Exception $e) {
            return response()->json(array("error" => true, "message" => $e->getMessage()));
        }
    }

    public function deleteProduct($id) {
        try {
            $this->product->deleteProduct($id);
            return response()->json(array("error" => false, "message" => "Producto eliminado"));
        } catch (\Exception $e) {
            return response()->json(array("error" => true, "message" => $e->getMessage()));
        }
    }

    public function findImagesByProduct($id) {
        return response()->json($this->product->findImagesByProduct($id));
    }

    public function uploadImages(Request $request) {
        echo "HER";
        try {
            // Valida que exista una imagen
            if ($request->hasFile('file')) {
                $productId = $request->input('productId');
                $image = $request->file('file');
                $extension = $image->getClientOriginalExtension();
                $folio = $this->product->findNextProductFolio();
                $nameFile = explode(".", $image->getClientOriginalName())[0]."-".$folio.".".$extension;
                $path = base_path() . ApplicationKeys::URL_SAVE_JUMPING_IMAGES . "/" . $productId;
                $image->move($path, $nameFile);
                //$this->deleteImage();
                return response()->json("Se ha subido correctamente la imagen");
            }
            return response()->json("No hay imagen por subir");

        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
        }
    }

    public function deleteImage() {
        try {
            if (unlink(base_path() . ApplicationKeys::URL_SAVE_JUMPING_IMAGES."/img-tours.png")){
                return response()->json("Se ha eliminado la imagen");
            }
        } catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
    }
}
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

    public function uploadImages(Request $request) {
        try {
            // Valida que exista una imagen
            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $extension = $image->getClientOriginalExtension();
                $folio = "001"; // TODO find this value to DB
                $nameFile = explode(".", $image->getClientOriginalName())[0]."-".$folio.".".$extension;
                $image->move(base_path() . ApplicationKeys::URL_SAVE_JUMPING_IMAGES, $nameFile);
                $this->deleteImage();
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
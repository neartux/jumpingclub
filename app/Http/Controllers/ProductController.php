<?php
/**
 * User: ricardo
 * Date: 27/02/18
 */

namespace App\Http\Controllers;


use App\Utils\Keys\common\ApplicationKeys;
use Illuminate\Http\Request;

class ProductController extends Controller {

    /**
     * Show the application products.
     *
     * @return \Illuminate\Http\Response
     */
    public function productList() {
        return view('/admin/product/productlist');
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
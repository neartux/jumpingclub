<?php

/**
 * User: ricardo
 * Date: 12/03/18
 */

namespace App\Repository\product;

interface ProductInterface {

    public function findProductType();

    public function findProductByProductType($productType);

    public function findImagesByProduct($productId);

    public function findNextProductFolio();

    public function createProductType($values);

    public function createProduct($productValues);

    public function updateProduct($productValues);

    public function publicProductById($productId, $isPublic);

    public function updateTypeProduct($values);

    public function deleteProduct($productId);

    public function deleteProductType($id);

    public function createProductImage($productId, $originalName, $name, $typeFile, $path);

    public function findProductImageById($imageId);

    public function setPrincipalImageByProduct($productImageId, $productId);

    public function deleteProductImage($imageId);

    public function changeOrderImage($imageId, $order);

    public function findProductByCodeOrDescription($re);
}
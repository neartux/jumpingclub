<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $table = 'product';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the status record associated with the status.
     */
    public function status() {
        return $this->hasOne('App\Models\Status', 'id', 'status_id');
    }

    /**
     * Get the status record associated with the productType.
     */
    public function productType() {
        return $this->hasOne('App\Models\ProductType', 'id', 'product_type_id');
    }

    /**
     * Get the productImages for the product.
     */
    public function productImages() {
        return $this->hasMany('App\Models\ProductImage');
    }
}

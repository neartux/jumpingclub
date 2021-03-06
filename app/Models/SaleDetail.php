<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model {

    protected $table = 'sale_detail';

    public $timestamps = false;

    /**
     * Get the status record associated with the sale detail.
     */
    public function status() {
        return $this->hasOne('App\Models\Status', 'id', 'status_id');
    }

    /**
     * Get the sale record associated with the sale detail.
     */
    public function sale() {
        return $this->hasOne('App\Models\Sale', 'id', 'sale_id');
    }

    /**
     * Get the product record associated with the sale detail.
     */
    public function product() {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}

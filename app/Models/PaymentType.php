<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model {
    
    protected $table = 'payment_type';

    public $timestamps = false;


    /**
     * Get the status record associated with the payment type.
     */
    public function status() {
        return $this->hasOne('App\Models\Status', 'id', 'status_id');
    }
}

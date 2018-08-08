<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model {

    protected $table = 'sale';

    public $timestamps = false;

    /**
     * Get the status record associated with the sale.
     */
    public function status() {
        return $this->hasOne('App\Models\Status', 'id', 'status_id');
    }

    /**
     * Get the user record associated with the sale.
     */
    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    /**
     * Get the client record associated with the sale.
     */
    public function client() {
        return $this->hasOne('App\Models\Client', 'id', 'client_id');
    }

    /**
     * Get the personalData record associated with the sale.
     */
    public function personalData() {
        return $this->hasOne('App\Models\PersonalData', 'id', 'personal_data_id');
    }

    /**
     * Get the locationData record associated with the sale.
     */
    public function locationData() {
        return $this->hasOne('App\Models\LocationData', 'id', 'location_data_id');
    }

    /**
     * Get the payment type record associated with the sale.
     */
    public function paymentType() {
        return $this->hasOne('App\Models\PaymentType', 'id', 'payment_type_id');
    }

    /**
     * Get the sale details for the sale.
     */
    public function saleDetails() {
        return $this->hasMany('App\Models\SaleDetail');
    }

    /**
     * The payment_methods that belong to the sale.
     */
    public function paymentMethods() {
        return $this->belongsToMany('App\Models\PaymentMethod', 'sale_payment_methods')
            ->withPivot('sale_id', 'payment_method_id', 'amount');
    }

    public function findById($id) {
        return Sale::findOrFail($id);
    }
}

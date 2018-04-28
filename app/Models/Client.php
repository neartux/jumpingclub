<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model {

    protected $table = 'client';

    public $timestamps = false;

    /**
     * Get the status record associated with the client.
     */
    public function status() {
        return $this->hasOne('App\Models\Status', 'id', 'status_id');
    }

    /**
     * Get the personalData record associated with the client.
     */
    public function personalData() {
        return $this->hasOne('App\Models\PersonalData', 'id', 'personal_data_id');
    }

    /**
     * Get the locationData record associated with the client.
     */
    public function locationData() {
        return $this->hasOne('App\Models\LocationData', 'id', 'location_data_id');
    }

    public function findById($id) {
        return Client::findOrFail($id);
    }

    public function findClientById($id) {

        return DB::table('client')->select('client.id', 'personal_data.name', 'personal_data.last_name', 'location_data.address',
            'location_data.postal_code', 'location_data.city', 'location_data.phone', 'location_data.cell_phone', 'location_data.email')
            ->join('personal_data', function ($join) use ($id) {
                $join->on('client.personal_data_id', '=', 'personal_data.id')
                    ->where('client.id', '=', $id);
            })->join('location_data', function ($join) use ($id) {
                $join->on('client.location_data_id', '=', 'location_data.id')
                    ->where('client.id', '=', $id);
            })
            ->first();
    }
}

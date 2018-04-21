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
        return DB::table('clients')->select('clients.id', 'personal_data.name', 'personal_data.last_name')
            ->join('personal_data', function ($join) use ($id) {
                $join->on('clients.personal_data_id', '=', 'personal_data.id')
                    ->where('clients.id', '=', $id);
            })
            ->first();
    }
}

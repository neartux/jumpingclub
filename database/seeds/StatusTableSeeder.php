<?php

use App\Utils\Keys\common\StatusKeys;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $status = [
            ['id' => StatusKeys::STATUS_ACTIVE, 'name' => 'Active'],
            ['id' => StatusKeys::STATUS_INACTIVE, 'name' => 'Inactive'],
        ];

        DB::table('status')->insert($status);
    }
}

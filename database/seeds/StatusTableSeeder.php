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
            ['id' => StatusKeys::STATUS_RESERVADO, 'name' => 'Reservado'],
            ['id' => StatusKeys::STATUS_PAGADO, 'name' => 'Pagado'],
            ['id' => StatusKeys::STATUS_ENVIADO, 'name' => 'Enviado'],
            ['id' => StatusKeys::STATUS_FINALIZADO, 'name' => 'Finalizado'],
        ];

        DB::table('status')->insert($status);
    }
}

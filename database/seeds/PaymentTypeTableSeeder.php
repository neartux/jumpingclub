<?php

use App\Utils\Keys\common\ApplicationKeys;
use App\Utils\Keys\common\StatusKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypeTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        $full = [
            array('id' => ApplicationKeys::PAYMENT_TYPE_FULL_PAYMENT, 'status_id' => StatusKeys::STATUS_ACTIVE, 'name' => 'Pago Completo', 'description' => 'Cuando la reserva se va a cubrir por completo al momento de crearla')
        ];
        $pending = [
            array('id' => ApplicationKeys::PAYMENT_TYPE_PENDING_PAYMENT, 'status_id' => StatusKeys::STATUS_ACTIVE, 'name' => 'Pago Pendiente', 'description' => 'Cuando la reserva no se pago en la creacion, se paga poteriormente')
        ];
        $credit = [
            array('id' => ApplicationKeys::PAYMENT_TYPE_ADVANCE_PAYMENT, 'status_id' => StatusKeys::STATUS_ACTIVE, 'name' => 'Pago Abono', 'description' => 'Cuando se hace un anticipo de pago cuando se crea la reserva')
        ];

        DB::table('payment_type')->insert($full);
		DB::table('payment_type')->insert($pending);
		DB::table('payment_type')->insert($credit);
    }
}

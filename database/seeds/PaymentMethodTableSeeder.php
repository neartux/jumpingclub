<?php

use App\Utils\Keys\common\ApplicationKeys;
use App\Utils\Keys\common\StatusKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $cash = [
            array('id' => ApplicationKeys::PAYMENT_METHOD_CASH, 'status_id' => StatusKeys::STATUS_ACTIVE, 'description' => 'Efectivo', 'abbreviation' => 'C')
        ];
        $cc = [
            array('id' => ApplicationKeys::PAYMENT_METHOD_CREDIT_CARD, 'status_id' => StatusKeys::STATUS_ACTIVE, 'description' => 'TC', 'abbreviation' => 'CC')
        ];
        $transfer = [
            array('id' => ApplicationKeys::PAYMENT_METHOD_TRANSFER, 'status_id' => StatusKeys::STATUS_ACTIVE, 'description' => 'Transferencia', 'abbreviation' => 'T')
        ];
        $deposit = [
            array('id' => ApplicationKeys::PAYMENT_METHOD_DEPOSIT, 'status_id' => StatusKeys::STATUS_ACTIVE, 'description' => 'Deposito', 'abbreviation' => 'D')
        ];

        DB::table('payment_method')->insert($cash);
        DB::table('payment_method')->insert($cc);
        DB::table('payment_method')->insert($transfer);
        DB::table('payment_method')->insert($deposit);
    }
}

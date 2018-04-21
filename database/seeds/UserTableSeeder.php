<?php

use App\Utils\Keys\common\StatusKeys;
use App\Utils\Keys\store\StoreKeys;
use App\Utils\Keys\user\UserKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $personalData = [
            ['id' => 1, 'name' => 'Ricardo', 'last_name' => 'Dzul', 'company_name' => ''],
        ];

        $locationData = [
            ['id' => 1, 'address' => 'Merida', 'postal_code' => '97000', 'city' => 'Merida', 'phone' => '9993599516', 'cell_phone' => '9993599516', 'email' => UserKeys::EMAIL_ROOT_USER]
        ];
        // TODO remember: after insert the seeders, especificly user we have to update password, because in this mode is expose for all people
        $user = [
            ['id' => UserKeys::USER_ROOT_ID, 'status_id' => StatusKeys::STATUS_ACTIVE, 'personal_data_id' => 1, 'location_data_id' => 1, 'user_name' => UserKeys::USER_ROOT, 'password' => bcrypt(UserKeys::PASSWORD_USER_ROOT)]
        ];

        DB::table('personal_data')->insert($personalData);

        DB::table('location_data')->insert($locationData);

        DB::table('users')->insert($user);
    }

}

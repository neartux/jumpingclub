<?php

use App\Utils\Keys\common\ApplicationKeys;
use App\Utils\Keys\common\StatusKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $jumping = [
            ['id' => ApplicationKeys::PRODUCT_TYPE_JUMPING, 'status_id' => StatusKeys::STATUS_ACTIVE, 'description' => 'Brincolines'],
        ];

        $games = [
            ['id' => ApplicationKeys::PRODUCT_TYPE_TABLE_GAMES, 'status_id' => StatusKeys::STATUS_ACTIVE, 'description' => 'Juegos de Mesa'],
        ];

        $skydancer = [
            ['id' => ApplicationKeys::PRODUCT_TYPE_SKYDANCERS, 'status_id' => StatusKeys::STATUS_ACTIVE, 'description' => 'Skydancer'],
        ];

        $snack = [
            ['id' => ApplicationKeys::PRODUCT_TYPE_SNACKS, 'status_id' => StatusKeys::STATUS_ACTIVE, 'description' => 'Snack'],
        ];

        DB::table('product_type')->insert($jumping);
        DB::table('product_type')->insert($games);
        DB::table('product_type')->insert($skydancer);
        DB::table('product_type')->insert($snack);
    }
}

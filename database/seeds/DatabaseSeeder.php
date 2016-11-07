<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Carbon\Carbon;

use App\Genre;
use App\CouponType;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('GenresMasterTableSeeder');
        $this->call('CouponsTypesMasterTableSeeder');

        Model::reguard();
    }
}

// ジャンル種別
class GenresMasterTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('genres_master')->delete();

        Genre::create([
            'genre_name' => 'ピザ'
        ]);
        Genre::create([
            'genre_name' => 'サイド'
        ]);
        Genre::create([
            'genre_name' => 'ドリンク'
        ]);
    }
}

class CouponsTypesMasterTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('coupons_types_master')->delete();

        CouponType::create([
            'coupon_type' => 'sample01'
        ]);
        CouponType::create([
            'coupon_type' => 'sample02'
        ]);
        CouponType::create([
            'coupon_type' => 'sample03'
        ]);
    }
}

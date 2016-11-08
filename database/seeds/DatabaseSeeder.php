<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Carbon\Carbon;

use App\Genre;
use App\Gender;
use App\CouponType;
use App\Authority;

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
        $this->call('GendersMasterTableSeeder');
        $this->call('AuthoritiesMasterTableSeeder');

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

// クーポン種別
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

// 性別
class GendersMasterTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('genders_master')->delete();

        Gender::create([
            'gender_name' => '男'
        ]);
        Gender::create([
            'gender_name' => '女'
        ]);
    }
}
//　権限
class AuthoritiesMasterTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('authorities_master')->delete();

        Authority::create([
            'authority_name' => 'administrator'
        ]);
        Authority::create([
            'authority_name' => 'employee'
        ]);
    }
}

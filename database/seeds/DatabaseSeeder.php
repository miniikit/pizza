<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Carbon\Carbon;

use App\Genre;
use App\Gender;
use App\Coupontype;
use App\Authority;
use App\Product;
use App\ProductPrice;
use App\State;
use App\Order;

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

        $this->call('GenresMasterSeeder');
        $this->call('CouponsTypesMasterSeeder');
        $this->call('GendersMasterSeeder');
        $this->call('AuthoritiesMasterSeeder');
        $this->call('ProducstMasterSeeder');
        $this->call('ProductsPricesMasterSeeder');
        $this->call('StatesMasterSeeder');
        $this->call('OrdersMasterSeeder');

        Model::reguard();
    }
}

// ジャンル種別
class GenresMasterSeeder extends Seeder
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


// 性別
class GendersMasterSeeder extends Seeder
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

// クーポン種別
class CouponsTypesMasterSeeder extends Seeder
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

//　権限
class AuthoritiesMasterSeeder extends Seeder
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

//商品
class ProducstMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('products_master')->delete();

        Product::create([
            'product_name' => '明太バターチーズ',
            'price_id' => '1',
            'product_image' => 'public/images/product/1.jpg',
            'product_text' => '大きくカットしたポテトにコーンとベーコンをトッピングして、明太クリームソース、バター、チーズを合わせた、家族で楽しめるピザです。',
            'genre_id' => '1',
            'sales_start_date' => Carbon::now(),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => 'じゃがバターベーコン',
            'price_id' => '2',
            'product_image' => 'public/images/product/2.jpg',
            'product_text' => 'ホクホクのポテトと旨味が凝縮されたベーコンを特製マヨソースで味わって頂く商品です。バター風味豊かなキューブチーズが食材の味を一層引き立てます。',
            'genre_id' => '1',
            'sales_start_date' => Carbon::tomorrow(),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => 'フレッシュモッツァレラのジェノベーゼ',
            'price_id' => '3',
            'product_image' => 'public/images/product/3.jpg',
            'product_text' => '生クリームを加えたバジルの香り豊かなジェノベーゼソースと、まろやかでクセのないフレッシュモッツァレラの香りと濃厚チーズの組み合わせが大人向けの商品',
            'genre_id' => '1',
            'sales_start_date' => Carbon::today(),
            'sales_end_date' => null,
        ]);
    }
}

//商品価格
class ProductsPricesMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('products_prices_master')->delete();

        ProductPrice::create([
            'product_id' => '1',
            'product_price' => '1990',
            'price_change_startdate' => Carbon::today(),
            'price_change_enddate' => null,
            'employee_id' => '1',
        ]);
        ProductPrice::create([
            'product_id' => '2',
            'product_price' => '2200',
            'price_change_startdate' => Carbon::today(),
            'price_change_enddate' => null,
            'employee_id' => '2',
        ]);
        ProductPrice::create([
            'product_id' => '3',
            'product_price' => '1800',
            'price_change_startdate' => Carbon::today(),
            'price_change_enddate' => null,
            'employee_id' => '3',
        ]);
    }
}

//状態
class StatesMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('states_master')->delete();

        State::create([
            'state_name' => '未完了'
        ]);
        State::create([
            'state_name' => '完了'
        ]);

    }
}

//注文
class OrdersMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('orders_master')->delete();

        Order::create([
            'order_date' => Carbon::now(),
            'order_appointment_date' => Carbon::tomorrow(),
            'coupon_id' => '1',
            'state_id' => '1'
        ]);
        Order::create([
            'order_date' => Carbon::now(),
            'order_appointment_date' => Carbon::tomorrow(),
            'coupon_id' => '2',
            'state_id' => '2'
        ]);
        Order::create([
            'order_date' => Carbon::now(),
            'order_appointment_date' => Carbon::tomorrow(),
            'coupon_id' => '2',
            'state_id' => '1'
        ]);

    }
}

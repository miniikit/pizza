<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Genre;
use App\Gender;
use App\Coupon;
use App\CouponType;
use App\Authority;
use App\Product;
use App\ProductPrice;
use App\State;
use App\Order;
use App\OrderDetail;
use App\Campaign;
use App\User;
use App\Employee;


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
        $this->call('ProductsMasterSeeder');
        $this->call('ProductsPricesMasterSeeder');
        $this->call('StatesMasterSeeder');
        $this->call('OrdersMasterSeeder');
        $this->call('OrdersDetailsTableSeeder');
        $this->call('CouponsMasterSeeder');
        $this->call('CampaignsMasterSeeder');
        $this->call('UsersSeeder');
        $this->call('EmployeeMasterSeeder');

        Model::reguard();
    }
}

//会員
class UsersSeeder extends Seeder
{

    public function run()
    {

        $faker = Faker::create('ja_JP');


        DB::table('users')->delete();

        //1 テストデータ：管理者
        User::create([
            'name' => '管理者',
            'kana' => 'カンリシャ',
            'email' => 'admin@oic.jp',
            'password' => bcrypt('root'),
            'postal' => 5900014,
            'address1' => '大阪府堺市堺区登坂町',
            'address2' => '8-5',
            'address3' => '910号室',
            'phone' => '09064325841',
            'gender_id' => 1,
            'birthday' => 19961111,
            'authority_id' => 1,
        ]);
        //2 テストデータ：従業員
        User::create([
            'name' => '濱田真旗',
            'kana' => 'ハマダマサキ',
            'email' => 'B5163@oic.jp',
            'password' => bcrypt('djmasaki'),
            'postal' => 5550011,
            'address1' => '大阪府大阪市大正区北恩加島',
            'address2' => '2-8-1',
            'address3' => null,
            'phone' => '07038461049',
            'gender_id' => 1,
            'birthday' => 19960607,
            'authority_id' => 2,
        ]);
        //3 テストデータ：従業員
        User::create([
            'name' => '兵頭佑一',
            'kana' => 'ヒョウドウユウイチ',
            'email' => 'B5123@oic.jp',
            'password' => bcrypt('19970221'),
            'postal' => 5320003,
            'address1' => '大阪府大阪市淀川区宮原町',
            'address2' => '2-8-1',
            'address3' => '312号室',
            'phone' => '09019384468',
            'gender_id' => 1,
            'birthday' => 19970221,
            'authority_id' => 2,
        ]);
        //4 テストデータ：従業員
        User::create([
            'name' => '土屋百合',
            'kana' => 'ツチヤユリ',
            'email' => 'tsuchiya@oic.jp',
            'password' => bcrypt('tsuchiya'),
            'postal' => 8099999,
            'address1' => $faker->prefecture.$faker->city,
            'address2' => $faker->streetAddress,
            'address3' => null,
            'phone' => '09019384468',
            'gender_id' => 2,
            'birthday' => 19970221,
            'authority_id' => 2,
        ]);
        //5 テストデータ：従業員
        User::create([
            'name' => '森山みくり',
            'kana' => 'モリヤマミクリ',
            'email' => 'moriyama@oic.jp',
            'password' => bcrypt('moriyama'),
            'postal' => 4532255,
            'address1' => $faker->prefecture.$faker->city,
            'address2' => $faker->streetAddress,
            'address3' => null,
            'phone' => '09019384468',
            'gender_id' => 2,
            'birthday' => 19970221,
            'authority_id' => 2,
        ]);
        //6 テストデータ：従業員
        User::create([
            'name' => '津崎 平匡',
            'kana' => 'ツザキヒロマサ',
            'email' => 'tsuzaki@oic.jp',
            'password' => bcrypt('tsuzaki'),
            'postal' => 4532255,
            'address1' => $faker->prefecture.$faker->city,
            'address2' => $faker->streetAddress,
            'address3' => null,
            'phone' => str_replace(array('-', 'ー'), '', $faker->phoneNumber),
            'gender_id' => 1,
            'birthday' => 19970221,
            'authority_id' => 2,
        ]);
        //7 テストデータ：WEB会員
        User::create([
            'name' => '大阪太郎',
            'kana' => 'オオサカタロウ',
            'email' => 'B5216@oic.jp',
            'password' => bcrypt('chikazawa'),
            'postal' => 5430001,
            'address1' => '大阪府大阪市天王寺区',
            'address2' => '6丁目8-4',
            'address3' => null,
            'phone' => str_replace(array('-', 'ー'), '', $faker->phoneNumber),
            'gender_id' => 1,
            'birthday' => 19960607,
            'authority_id' => 3,
        ]);
        //8 テストデータ：WEB会員
        User::create([
            'name' => 'Josh',
            'kana' => 'josh',
            'email' => 'B5212@oic.jp',
            'password' => bcrypt('josh'),
            'postal' => 5550012,
            'address1' => '大阪府大阪市大正区北恩加島',
            'address2' => '2-8-2',
            'address3' => null,
            'phone' => str_replace(array('-', 'ー'), '', $faker->phoneNumber),
            'gender_id' => 1,
            'birthday' => null,
            'authority_id' => 3,
        ]);
        //9 テストデータ：電話会員（電話番号が同じ）
        User::create([
            'name' => '野比のび太',
            'kana' => 'ノビノビタ',
            'email' => null,
            'password' => null,
            'postal' => 1111111,
            'address1' => '大阪府大阪市西区土佐堀',
            'address2' => '１丁目２−１−５０３',
            'address3' => null,
            'phone' => '08000000000',
            'gender_id' => null,
            'birthday' => null,
            'authority_id' => 4,
        ]);
        //10 テストデータ：電話会員（電話番号が同じ）
        User::create([
            'name' => '野比静香',
            'kana' => 'ノビシズカ',
            'email' => null,
            'password' => null,
            'postal' => 1111111,
            'address1' => '大阪府大阪市西区土佐堀',
            'address2' => '１丁目２−１−５０３',
            'address3' => null,
            'phone' => '08000000000',
            'gender_id' => null,
            'birthday' => null,
            'authority_id' => 4,
        ]);

        //11以降 テストデータ：WEB会員
        for ($i=0; $i < 10; $i++) {

            User::create([
                'name' => $faker->name,
                'kana' => 'テスト',
                'email' => $i.$faker->email,
                'password' => bcrypt('faker'),
                'postal' => $faker->postcode,
                'address1' => $faker->prefecture.$faker->city,
                'address2' => $faker->streetAddress,
                'address3' => null,
                'phone' => str_replace(array('-', 'ー'), '', $faker->phoneNumber),
                'gender_id' => rand(1, 2),
                'birthday' => $faker->dateTimeBetween('-80 years', '-20years')->format('Ymd'),
                'authority_id' => 3,
            ]);

        }

    }
}

class EmployeeMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('employees_master')->delete();

        //テストデータ：契約中
        Employee::create([
            'users_id' => 1,    //管理者
            'emoloyee_agreement_date' => Carbon::parse('2010-01-01'),
            'emoloyee_agreement_enddate' => null,
        ]);

        //テストデータ：契約中
        Employee::create([
            'users_id' => 2,
            'emoloyee_agreement_date' => Carbon::parse('2011-03-10'),
            'emoloyee_agreement_enddate' => null,
        ]);

        //テストデータ：契約中
        Employee::create([
            'users_id' => 3,
            'emoloyee_agreement_date' => Carbon::parse('2016-10-10'),
            'emoloyee_agreement_enddate' => null,
        ]);

        //テストデータ：契約中
        Employee::create([
            'users_id' => 4,
            'emoloyee_agreement_date' => Carbon::parse('2016-10-10'),
            'emoloyee_agreement_enddate' => null,
        ]);

        //テストデータ：本日まで
        Employee::create([
            'users_id' => 5,
            'emoloyee_agreement_date' => Carbon::parse('2016-10-10'),
            'emoloyee_agreement_enddate' => Carbon::today(),
        ]);

        //テストデータ：契約終了
        Employee::create([
            'users_id' => 6,
            'emoloyee_agreement_date' => Carbon::parse('2016-10-10'),
            'emoloyee_agreement_enddate' => Carbon::yesterday(),
        ]);


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

//クーポン
class CouponsMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('coupons_master')->delete();

        //1 テストデータ：（キャンペーンと整合性 // プレゼント・全員・2000以上・焼きたてポテト無料・1人1回まで）(本日まで)
        Coupon::create([
            'coupons_types_id' => '2',
            'coupon_name' => '1人1回まで 2000円以上で焼きたてポテトが無料クーポン',
            'coupon_discount' => 410,
            'coupon_conditions_money' => 2000,
            'product_id' => 4,
            'coupon_start_date' => Carbon::parse('2016-12-06'),
            'coupon_end_date' => Carbon::today(),
            'coupon_number' => 'GIFTPOTATO',
            'coupon_conditions_count' => 1,
            'coupon_conditions_first' => 0, //全員
        ]);
        //2 テストデータ：（キャンペーンと整合性 // 値引き・全員・5000以上・1000円引き・1人1回まで）
        Coupon::create([
            'coupons_types_id' => '1',
            'coupon_name' => '全員対象 5000円以上で1000円引きクーポン',
            'coupon_discount' => 1000,
            'coupon_conditions_money' => 5000,
            'product_id' => null,
            'coupon_start_date' => Carbon::parse('2016-12-06'),
            'coupon_end_date' => Carbon::parse('2017-06-07'),
            'coupon_number' => '1000OFF',
            'coupon_conditions_count' => 1,
            'coupon_conditions_first' => 0, //全員
        ]);
        //3 テストデータ：（キャンペーンと整合性 // プレゼント・全員・2500以上・コーラ無料・1人1回まで）
        Coupon::create([
            'coupons_types_id' => '2',
            'coupon_name' => '全員対象 2500円以上でコーラ無料クーポン',
            'coupon_discount' => 162,
            'coupon_conditions_money' => 2500,
            'product_id' => 7,
            'coupon_start_date' => Carbon::parse('2016-12-06'),
            'coupon_end_date' => Carbon::parse('2017-08-31'),
            'coupon_number' => 'GIFTCOLA',
            'coupon_conditions_count' => 1,
            'coupon_conditions_first' => 0, //全員
        ]);

        //4 テストデータ：（キャンペーンと整合性 // 値引き・全員・3000以上・500円OFF・1人1回まで）
        Coupon::create([
            'coupons_types_id' => '1',
            'coupon_name' => '期間限定 500円引きクーポン',
            'coupon_discount' => 500,
            'coupon_conditions_money' => 3000,
            'product_id' => null,
            'coupon_start_date' => Carbon::parse('2016-08-04'),
            'coupon_end_date' => Carbon::parse('2018-12-31'),
            'coupon_number' => '500OFF',
            'coupon_conditions_count' => 1,
            'coupon_conditions_first' => 0, //全員
        ]);
        //5 テストデータ：開催中 （プレゼント・全員対象・2000円以上・十勝産コーンポタージュ・無制限）
        Coupon::create([
            'coupons_types_id' => '2',
            'coupon_name' => '2000円以上で十勝産コーンポタージュ無料',
            'coupon_discount' => 400,
            'coupon_conditions_money' => 2000,
            'product_id' => 5,
            'coupon_start_date' => Carbon::parse('2014-01-01'),
            'coupon_end_date' => Carbon::parse('2018-12-31'),
            'coupon_number' => 'FREEPOTARGE',
            'coupon_conditions_count' => null,
            'coupon_conditions_first' => 0,  //全員
        ]);
        //6 テストデータ：終了 （値引き・初回限定・500円以上・コーラ無料・無制限）
        Coupon::create([
            'coupons_types_id' => '2',
            'coupon_name' => 'プレゼントクーポン',
            'coupon_discount' => 2200,
            'coupon_conditions_money' => 1,
            'product_id' => 2,
            'coupon_start_date' => Carbon::today()->subMonth(),
            'coupon_end_date' => Carbon::today()->subDay(),
            'coupon_number' => 'SUMMER',
            'coupon_conditions_count' => null,
            'coupon_conditions_first' => 1,  //初回限定
            'deleted_at' => Carbon::today()->subDay()
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
            'coupon_type' => '値引きクーポン'
        ]);
        CouponType::create([
            'coupon_type' => 'プレゼントクーポン'
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
            'authority_name' => '管理者'
        ]);
        Authority::create([
            'authority_name' => '従業員'
        ]);
        Authority::create([
            'authority_name' => 'WEB会員'
        ]);
        Authority::create([
            'authority_name' => '電話会員'
        ]);
    }
}

//商品
class ProductsMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('products_master')->delete();

        Product::create([
            'product_name' => '明太バターチーズ',
            'price_id' => 1,
            'product_image' => '/images/product/1.jpg',
            'product_text' => '大きくカットしたポテトにコーンとベーコンをトッピングして、明太クリームソース、バター、チーズを合わせた、家族で楽しめるピザです。',
            'genre_id' => 1,
            'sales_start_date' => Carbon::parse('2016-10-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => 'じゃがバターベーコン',
            'price_id' => 2,
            'product_image' => '/images/product/2.jpg',
            'product_text' => 'ホクホクのポテトと旨味が凝縮されたベーコンを特製マヨソースで味わって頂く商品です。バター風味豊かなキューブチーズが食材の味を一層引き立てます。',
            'genre_id' => 1,
            'sales_start_date' => Carbon::parse('2016-10-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => 'フレッシュモッツァレラのジェノベーゼ',
            'price_id' => 3,
            'product_image' => '/images/product/3.jpg',
            'product_text' => '生クリームを加えたバジルの香り豊かなジェノベーゼソースと、まろやかでクセのないフレッシュモッツァレラの香りと濃厚チーズの組み合わせが大人向けの商品',
            'genre_id' => 1,
            'sales_start_date' => Carbon::parse('2016-10-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => '焼きたてポテト',
            'price_id' => 4,
            'product_image' => '/images/product/4.jpg',
            'product_text' => '少量を食べたいときにおすすめ。皮つきのうまさ！外はカリッ、中はホックリ！お子様にも大人気です！口に運べば、バターの風味とポテトの旨みが広がります。',
            'genre_id' => 2,
            'sales_start_date' => Carbon::parse('2016-10-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => '十勝産コーンポタージュ',
            'price_id' => 5,
            'product_image' => '/images/product/5.jpg',
            'product_text' => 'コーンをふんだんに入れ、濃厚で上品な甘さが特徴のスープです。北海道十勝産スイートコーンを使用したクリーミーなスープに仕上げました。',
            'genre_id' => 2,
            'sales_start_date' => Carbon::parse('2016-10-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => 'ローストチキンレッグ',
            'price_id' => 6,
            'product_image' => '/images/product/6.jpg',
            'product_text' => '旨みたっぷりの骨付き鶏肉をガーリックなどの香辛料とハーブで味付けし、表面はパリｯと、中はジューシーにローストしたクリスマスにぴったりのローストチキンです。',
            'genre_id' => 2,
            'sales_start_date' => Carbon::parse('2016-10-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => 'コカ・コーラ',
            'price_id' => 7,
            'product_image' => '/images/product/7.jpg',
            'product_text' => '税抜き150円',
            'genre_id' => 3,
            'sales_start_date' => Carbon::parse('2016-10-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => '綾鷹',
            'price_id' => 8,
            'product_image' => '/images/product/8.jpg',
            'product_text' => '税抜き150円',
            'genre_id' => 3,
            'sales_start_date' => Carbon::parse('2016-10-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => 'Qooみかん',
            'price_id' => 9,
            'product_image' => '/images/product/9.jpg',
            'product_text' => '税抜き150円',
            'genre_id' => 3,
            'sales_start_date' => Carbon::parse('2016-10-10'),
            'sales_end_date' => null,
        ]);

        Product::create([
            'product_name' => '【期間限定】もち明太グラタン',
            'price_id' => 10,
            'product_image' => '/images/product/10.jpg',
            'product_text' => 'まろやかな明太子クリームソースとホワイトソースを一緒に味わって頂く商品です。',
            'genre_id' => 2,
            'sales_start_date' => Carbon::parse('2016-12-20'),
            'sales_end_date' => Carbon::parse('2017-03-31'),
        ]);

        Product::create([
            'product_name' => '【期間限定】越後産ズワイガニのご馳走ピザ',
            'price_id' => 11,
            'product_image' => '/images/product/11.jpg',
            'product_text' => '越後産のズワイガニをふんだんに使用したご馳走ピザです。',
            'genre_id' => 1,
            'sales_start_date' => Carbon::parse('2016-12-01'),
            'sales_end_date' => Carbon::parse('2017-03-30'),
        ]);
        Product::create([
            'product_name' => 'ミートスペシャル',
            'price_id' => 12,
            'product_image' => '/images/product/12.jpg',
            'product_text' => 'トマト・クリームソースに、３種類のウインナーをトッピング。飽きのこないシンプルな味に仕上げました。',
            'genre_id' => 1,
            'sales_start_date' => Carbon::parse('2016-12-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => 'アスパラゴールデン',
            'price_id' => 13,
            'product_image' => '/images/product/13.jpg',
            'product_text' => '光輝くアスパラを、程よい柔らかさに焼き上げました。トマト・ベーコンとの相性は抜群です。',
            'genre_id' => 1,
            'sales_start_date' => Carbon::parse('2016-12-10'),
            'sales_end_date' => null,
        ]);
        Product::create([
            'product_name' => 'ホワイトモッツァレラ',
            'price_id' => 14,
            'product_image' => '/images/product/14.jpg',
            'product_text' => '北海道産モッツァレラチーズに、イベリコ豚のスライスをトッピング。',
            'genre_id' => 1,
            'sales_start_date' => Carbon::parse('2016-12-10'),
            'sales_end_date' => null,
        ]);

        // 販売終了
        Product::create([
            'product_name' => '海のミックスコラボ',
            'price_id' => 15,
            'product_image' => '/images/product/15.jpg',
            'product_text' => '海の幸をふんだんに使用した、シーフードずきにはたまらない一品です。',
            'genre_id' => 1,
            'sales_start_date' => Carbon::parse('2016-12-10'),
            'sales_end_date' => Carbon::yesterday(),
        ]);

        // 本日まで
        Product::create([
            'product_name' => 'ミックスパーティー',
            'price_id' => 16,
            'product_image' => '/images/product/16.jpg',
            'product_text' => '子供から大人まで幅広い年代の方に支持される、大人気ミックスピザです。',
            'genre_id' => 1,
            'sales_start_date' => Carbon::parse('2016-12-10'),
            'sales_end_date' => Carbon::today(),
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
            'product_id' => 1,
            'product_price' => '1990',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 1,
        ]);
        ProductPrice::create([
            'product_id' => 2,
            'product_price' => '2200',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 2,
        ]);
        ProductPrice::create([
            'product_id' => 3,
            'product_price' => '1800',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 4,
            'product_price' => '410',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 5,
            'product_price' => '400',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 6,
            'product_price' => '734',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 7,
            'product_price' => '162',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 8,
            'product_price' => '162',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 9,
            'product_price' => '162',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 10,
            'product_price' => '680',
            'price_change_startdate' => Carbon::parse('2016-10-10'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        //冬限定　ズワイガニのご馳走ピザ
        ProductPrice::create([
            'product_id' => 11,
            'product_price' => '2480',
            'price_change_startdate' => Carbon::parse('2016-12-01'),
            'price_change_enddate' => Carbon::parse('2016-03-30'),
            'employee_id' => 3,
        ]);
        //ミートスペシャル
        ProductPrice::create([
            'product_id' => 12,
            'product_price' => '2740',
            'price_change_startdate' => Carbon::parse('2016-12-01'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        //アスパラゴールデン
        ProductPrice::create([
            'product_id' => 13,
            'product_price' => '2100',
            'price_change_startdate' => Carbon::parse('2016-12-01'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 14,
            'product_price' => '2980',
            'price_change_startdate' => Carbon::parse('2016-12-01'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 15,
            'product_price' => '3200',
            'price_change_startdate' => Carbon::parse('2016-12-01'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
        ProductPrice::create([
            'product_id' => 16,
            'product_price' => '2600',
            'price_change_startdate' => Carbon::parse('2016-12-01'),
            'price_change_enddate' => null,
            'employee_id' => 3,
        ]);
    }
}

//状態
class StatesMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('states_master')->delete();

        //1 未だ
        State::create([
            'state_name' => '未完了'
        ]);

        //2 完了
        State::create([
            'state_name' => '完了'
        ]);

        //3 破棄
        State::create([
            'state_name' => '破棄'
        ]);

    }
}

//注文
class OrdersMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('orders_master')->delete();

        // WEBとPHONEの生成数（過去の合計）
        $max = 300; //この値を変更する場合の注意点：この数値を、orders_details_tableの先頭行$maxの値に代入すること

        // 注文を行う「会員ID」の最小値と最大値
        $userIdMin = 7;
        $userIdMax = 20;

        // 注文を受理する「会員ID（担当者）」の最小値と最大値
        $employeeIdMin = 1;
        $employeeIdMax = 6;

        // 注文の比率
        $past = $max * 0.8;  // 過去
        $recently = $max * 0.15;  // 近日
        $near = $max * 0.05; // 本日頃
        
        // 遠い過去の注文を生成(WEB+PHONE)
        for($i = 1; $i<= $past; $i++){

            // $iの値が増えるたびに、徐々に小さくなる値
            $rand = ($past-$i) * 3;

            // 注文日
            $orderDate = Carbon::today()->subDay($rand);
            $today = Carbon::today();

            // 配達希望日時は、１−１６時間後に設定する
            $appointment_date = $orderDate;
            $addHour = rand(1,4) * rand(1,4);
            $appointment_date = $appointment_date->addHour($addHour);

            // 状態ID（配達希望日時が過去であれば、「完了」または「キャンセル」にセット）
            if($appointment_date <= $today){
                $state_id = rand(2,3);

            // 状態ID（配達希望日が未来であれば、「未完了」または「キャンセル」にセット）
            }else{
                //状態を、1または3に設定する。（１は未完了・３はキャンセル）
                $state_id = rand(1,3);
                if($state_id == 2){
                    $state_id = 1;
                }
            }

            // PHONE注文か、WEB注文かを指定
            $type = rand(1,2);

            // SQL処理
            if($type == 1) { // WEB注文
                Order::create(['order_date' => $orderDate, 'order_appointment_date' => $appointment_date, 'coupon_id' => null, 'state_id' => $state_id, 'user_id' => rand($userIdMin, $userIdMax), 'employee_id' => NULL,]);
            }else { // PHONE注文
                Order::create(['order_date' => $orderDate, 'order_appointment_date' => $appointment_date, 'coupon_id' => null, 'state_id' => $state_id, 'user_id' => rand($userIdMin, $userIdMax), 'employee_id' => rand($employeeIdMin, $employeeIdMax),]);
            }

        }

        // 近い過去の注文を生成(WEB+PHONE)
        for($i = 1; $i<= $recently; $i++){

            //徐々に小さくなる値
            $rand = ($recently - $i + 10) * 5;

            // 注文日時
            $orderDate = Carbon::now()->subHour($rand);
            $today = Carbon::today();

            // 配達希望日時は、１−１６時間後に設定する
            $appointment_date = $orderDate;
            $addHour = rand(1,4) * rand(1,4);
            $appointment_date = $appointment_date->addHour($addHour);

            //状態ID（もし、配達希望日時が過去であれば、「完了」または「キャンセル」にセット
            if($appointment_date <= $today){
                $state_id = rand(2,3);

            //配達希望日が未来である
            }else{
                //状態を、1または3に設定する。（１は未完了・３はキャンセル）
                $state_id = rand(1,3);
                if($state_id == 2){
                    $state_id = 1;
                }
            }

            $type = rand(1,2);
            if($type == 1) { // WEB会員
                Order::create(['order_date' => $orderDate, 'order_appointment_date' => $appointment_date, 'coupon_id' => NULL, 'state_id' => $state_id, 'user_id' => rand($userIdMin, $userIdMax), 'employee_id' => NULL,]);
            }else { // PHONE会員
                Order::create(['order_date' => $orderDate, 'order_appointment_date' => $appointment_date, 'coupon_id' => NULL, 'state_id' => $state_id, 'user_id' => rand($userIdMin, $userIdMax), 'employee_id' => rand($employeeIdMin, $employeeIdMax),]);
            }

        }

        // 本日頃の注文を生成(WEB+PHONE)
        for($i = 1; $i<= $near; $i++){

            //徐々に小さくなる値
            $rand = ($near - $i + 3) * 2;

            // 注文日時
            $orderDate = Carbon::now()->subHour($rand);
            $today = Carbon::today();
            $now = Carbon::now();

            // 配達希望日は、１−１６時間後に設定する
            $appointment_date = $orderDate;
            $addHour = rand(1,4) * rand(1,4);
            $appointment_date = $appointment_date->addHour($addHour);

            //状態ID（もし、配達希望日時が過去であれば、「完了」または「キャンセル」にセット
            if($appointment_date <= $today){
                $state_id = rand(2,3);

            //配達希望日が未来である
            }else{
                //状態を、1または3に設定する。（１は未完了・３はキャンセル）
                $state_id = rand(1,3);
                if($state_id == 2){
                    $state_id = 1;
                }
            }

            $type = rand(1,2);
            if($type == 1) { // WEB会員
                Order::create(['order_date' => $orderDate, 'order_appointment_date' => $appointment_date, 'coupon_id' => NULL, 'state_id' => $state_id, 'user_id' => rand($userIdMin, $userIdMax), 'employee_id' => NULL,]);
            }else { // PHONE会員
                Order::create(['order_date' => $orderDate, 'order_appointment_date' => $appointment_date, 'coupon_id' => NULL, 'state_id' => $state_id, 'user_id' => rand($userIdMin, $userIdMax), 'employee_id' => rand($employeeIdMin, $employeeIdMax),]);
            }

        }


        // クーポン1 使用時（商品ID4 かつ 2000円以上）
        Order::create([
            'order_date' => Carbon::now()->subHour(rand(7,8)),
            'order_appointment_date' => Carbon::tomorrow()->addHour(rand(8,20)),
            'coupon_id' => 1,
            'state_id' => 1,
            'user_id' => 8,
            'employee_id' => NULL,
        ]);
        // クーポン2 使用時（5000円以上）
        Order::create([
            'order_date' => Carbon::now()->subHour(rand(6,7)),
            'order_appointment_date' => Carbon::tomorrow()->addHour(rand(8,20)),
            'coupon_id' => 2,
            'state_id' => 1,
            'user_id' => 10,
            'employee_id' => NULL,
        ]);
        // クーポン3 使用時（商品ID7 かつ 2500円以上）
        Order::create([
            'order_date' => Carbon::now()->subHour(rand(5,6)),
            'order_appointment_date' => Carbon::tomorrow()->addHour(rand(8,20)),
            'coupon_id' => 3,
            'state_id' => 1,
            'user_id' => 3,
            'employee_id' => NULL,
        ]);
        // クーポン5 使用時（商品ID5 かつ 2000円以上）
        Order::create([
            'order_date' => Carbon::now()->subHour(rand(4,5)),
            'order_appointment_date' => Carbon::tomorrow()->addHour(rand(8,20)),
            'coupon_id' => 5,
            'state_id' => 1,
            'user_id' => 7,
            'employee_id' => NULL,
        ]);
        // 電話注文サンプル
        Order::create([
            'order_date' => Carbon::now()->subHour(rand(3,4)),
            'order_appointment_date' => Carbon::tomorrow()->addHour(rand(8,20)),
            'coupon_id' => null,
            'state_id' => 1,
            'user_id' => 9,
            'employee_id' => 2,
        ]);
    }
}

//注文明細
class OrdersDetailsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('orders_details_table')->delete();

        // orderマスタのfor文の件数を変更した場合、ここを変更
        $max = 300;

        // WEB会員からの注文 + 電話会員からの注文（クーポンなし）
        // orders_masterの注文IDと整合性を保っています
        for($i = 1; $i<= $max; $i++){
            $orderCnt = rand(1,5);
            $randomCnt = rand(0,10);
            for($k = 1; $k <= $orderCnt; $k++){
                OrderDetail::create([
                    'id' => $i,
                    'price_id' => $k+$randomCnt,
                    'number' => rand(1,7),
                ]);
           }
        }

        OrderDetail::create([
            'id' => $max + 1,
            'price_id' => 1,
            'number' => 1,
        ]);
        OrderDetail::create([
            'id' => $max + 1,
            'price_id' => 2,
            'number' => 2,
        ]);
        OrderDetail::create([
            'id' => $max + 1,
            'price_id' => 3,
            'number' => 3,
        ]);
        OrderDetail::create([
            'id' => $max + 2,
            'price_id' => 4,
            'number' => 3,
        ]);
        OrderDetail::create([
            'id' => $max + 2,
            'price_id' => 7,
            'number' => 3,
        ]);
        OrderDetail::create([
            'id' => $max + 3,
            'price_id' => 8,
            'number' => 3,
        ]);
        OrderDetail::create([
            'id' => $max + 4,
            'price_id' => 1,
            'number' => 3,
        ]);
        OrderDetail::create([
            'id' => $max + 4,
            'price_id' => 2,
            'number' => 3,
        ]);
        OrderDetail::create([
            'id' => $max + 5,
            'price_id' => 1,
            'number' => 3,
        ]);
        OrderDetail::create([
            'id' => $max + 5,
            'price_id' => 2,
            'number' => 3,
        ]);
    }
}

//キャンペーン
class CampaignsMasterSeeder extends Seeder
{

    public function run()
    {
        DB::table('campaigns_master')->delete();

        // 3000円以上で500円OFF
        Campaign::create([
            'campaign_title' => '12月末まで！500円OFFキャンペーン',
            'campaign_banner' => '/images/campaign_banner/1.jpg',
            'campaign_image' => '/images/campaign/1.jpg',
            'campaign_text' => '3000円以上ご注文の際、クーポンコードのご入力で500円OFF',
            'campaign_note' => 'ご注文の際、クーポンコード「500OFF」をご入力ください。お一人様１回までご利用いただけます。',
            'campaign_subject' => '全会員',
            'campaign_start_day' => Carbon::parse('2016-08-04'),
            'campaign_end_day' => Carbon::parse('2017-06-07'),
        ]);

        // 2000円以上で焼きたてポテト無料(本日まで)
        Campaign::create([
            'campaign_title' => '名脇役！焼きたてポテト無料キャンペーン',
            'campaign_banner' => '/images/campaign_banner/2.jpg',
            'campaign_image' => '/images/campaign/2.jpg',
            'campaign_text' => '2000円以上ご注文の祭、クーポンコードのご入力で「焼きたてポテト」を無料プレゼント',
            'campaign_note' => 'ご注文の際、「焼きたてポテト」をカートに入れた状態でクーポンコード「GIFTPOTATO」をご入力ください。お一人様１回までご利用いただけます。',
            'campaign_subject' => '全会員',
            'campaign_start_day' => Carbon::parse('2016-12-01'),
            'campaign_end_day' => Carbon::today(),
        ]);
        // 5000円以上で1000円OFF
        Campaign::create([
            'campaign_title' => '2017年ロケットパーティー応援キャンペーン',
            'campaign_banner' => '/images/campaign_banner/3.jpg',
            'campaign_image' => '/images/campaign/3.jpg',
            'campaign_text' => '5000円以上ご注文の祭、クーポンコードのご入力で1000円OFF',
            'campaign_note' => 'ご注文の際、クーポンコード「1000OFF」をご入力ください。お一人様１回までご利用いただけます。',
            'campaign_subject' => '全会員',
            'campaign_start_day' => Carbon::parse('2016-12-07'),
            'campaign_end_day' => Carbon::parse('2017-06-07'),
        ]);
        // 2500円以上でコーラ1本無料
        Campaign::create([
            'campaign_title' => 'コーラで盛り上がろう！キャンペーン',
            'campaign_banner' => '/images/campaign_banner/4.jpg',
            'campaign_image' => '/images/campaign/4.jpg',
            'campaign_text' => '2500円以上ご注文の祭、クーポンコードのご入力でコーラ1本無料',
            'campaign_note' => 'ご注文の際、カートに「コーラ」を入れた状態でクーポンコード「GIFTCOLA」をご入力ください。お一人様１回までご利用いただけます。',
            'campaign_subject' => '全会員',
            'campaign_start_day' => Carbon::parse('2016-12-07'),
            'campaign_end_day' => Carbon::parse('2017-08-31'),
        ]);
        // お正月フェア(終了)
        Campaign::create([
            'campaign_title' => '冬フェア開催中',
            'campaign_banner' => '/images/campaign_banner/4.jpg',
            'campaign_image' => '/images/campaign/4.jpg',
            'campaign_text' => '冬限定メニューが続々登場！冬の味覚をお楽しみ下さい！',
            'campaign_note' => 'スタッフ一押しの越後産ズワイガニをふんだんに使用したピザが登場しています。ぜひご確認ください！',
            'campaign_subject' => null,
            'campaign_start_day' => Carbon::parse('2016-12-01'),
            'campaign_end_day' => Carbon::yesterday(),
        ]);

    }



}

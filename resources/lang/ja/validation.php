<?php  // resources/lang/ja/validation.php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attributeを承認してください。',
    'active_url'           => ':attributeは正しいURLではありません。',
    'after'                => ':attributeは:date以降の日付にしてください。',
    'alpha'                => ':attributeは英字のみにしてください。',
    'alpha_dash'           => ':attributeは英数字とハイフンのみにしてください。',
    'alpha_num'            => ':attributeは英数字のみにしてください。',
    'array'                => ':attributeは配列にしてください。',
    'before'               => ':attributeは:date以前の日付にしてください。',
    'between'              => [
        'numeric' => ':attributeは:min〜:maxまでにしてください。',
        'file'    => ':attributeは:min〜:max KBまでのファイルにしてください。',
        'string'  => ':attributeは:min〜:max文字にしてください。',
        'array'   => ':attributeは:min〜:max個までにしてください。',
    ],
    'boolean'              => ':attributeはtrueかfalseにしてください。',
    'confirmed'            => ':attributeは確認用項目と一致していません。',
    'date'                 => ':attributeは正しい日付ではありません。',
    'date_format'          => ':attributeは":format"書式と一致していません。',
    'different'            => ':attributeは:otherと違うものにしてください。',
    'digits'               => ':attributeは:digits桁にしてください',
    'digits_between'       => ':attributeは:min〜:max桁にしてください。',
    'email'                => ':attributeを正しいメールアドレスにしてください。',
    'filled'               => ':attributeは必須です。',
    'exists'               => '選択された:attributeは正しくありません。',
    'image'                => ':attributeは画像にしてください。',
    'in'                   => '選択された:attributeは正しくありません。',
    'integer'              => ':attributeは整数にしてください。',
    'ip'                   => ':attributeを正しいIPアドレスにしてください。',
    'max'                  => [
        'numeric' => ':attributeは:max以下にしてください。',
        'file'    => ':attributeは:max KB以下のファイルにしてください。.',
        'string'  => ':attributeは:max文字以下にしてください。',
        'array'   => ':attributeは:max個以下にしてください。',
    ],
    'mimes'                => ':attributeは:valuesタイプのファイルにしてください。',
    'min'                  => [
        'numeric' => ':attributeは:min以上にしてください。',
        'file'    => ':attributeは:min KB以上のファイルにしてください。.',
        'string'  => ':attributeは:min文字以上にしてください。',
        'array'   => ':attributeは:min個以上にしてください。',
    ],
    'not_in'               => '選択された:attributeは正しくありません。',
    'numeric'              => ':attributeは数字にしてください。',
    'regex'                => ':attributeの書式が正しくありません。',
    'required'             => ':attributeが入力されていません。',
    'required_if'          => ':otherが:valueの時、:attributeは必須です。',
    'required_with'        => ':valuesが存在する時、:attributeは必須です。',
    'required_with_all'    => ':valuesが存在する時、:attributeは必須です。',
    'required_without'     => ':valuesが存在しない時、:attributeは必須です。',
    'required_without_all' => ':valuesが存在しない時、:attributeは必須です。',
    'same'                 => ':attributeと:otherは一致していません。',
    'size'                 => [
        'numeric' => ':attributeは:sizeにしてください。',
        'file'    => ':attributeは:size KBにしてください。.',
        'string'  => ':attribute:size文字にしてください。',
        'array'   => ':attributeは:size個にしてください。',
    ],
    'string'               => ':attributeは文字列にしてください。',
    'timezone'             => ':attributeは正しいタイムゾーンをしていしてください。',
    'unique'               => ':attributeは既に存在します。',
    'url'                  => ':attributeを正しい書式にしてください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'password' => [
            'required' => 'パスワードを入力してください',
        ],
        'name' => [
            'requied' => '氏名を入力してください',
            'max' => '氏名は50文字以下で入力してください',
        ],
        'kana' => [
            'required'  => 'フリガナを入力してください',
            'max' => 'フリガナは100文字以下で入力してください',
        ],
        'postal' => [
            'required' => '郵便番号を入力してください',
            'size' => '郵便番号は７桁で入力してください',
            'string' => '郵便番号は半角数字で入力してください',
        ],
        'address1' => [
            'max' => '住所は２５５文字以下で入力してください',
        ],
        'address2' => [
            'required' => '番地が入力されてません',
            'max' => '番地は２５５文字以下で入力してください',
        ],
        'address3' => [
            'max' => '建物名は２５５文字以下で入力してください',
        ],
        'birthday' => [
            'required' => '生年月日が入力されていません',
            'date' => '生年月日が不正です',
        ],
        'phone' => [
            'required' => '電話番号が入力されていません',
            'between' => '電話番号の桁数が正しくありません',
        ],
        'gender_id' => [
            'required' => '性別が選択されていません',
        ],
        'email' => [
            'required' => 'メールアドレスが入力されていません',
            'email' => 'メールアドレスが正しくありません',
        ],
        'new_password' => [
            'min' => '新しいパスワードは最低８文字以上に設定してください',
            'max' => '新しいパスワードは１２８文字以下にご設定ください',
            'regex' => '新しいパスワードは半角「英小文字」「英大文字」「数字」を１種類ずつ、８文字以上で設定してください',
            'same' => '新しいパスワードが新しいパスワード（確認）と一致しません',
        ],
        'new_password_confirm' => [
            'different' => '新しいパスワードと現在のパスワードが同じです',
        ],
        'confirm_password' => [
            'required' => '現在のパスワード（必須）が入力されていません',
        ],
        //
        //  管理者　メニュー編集
        //
        'product_id' => [
            'required' => '処理エラー！　メニュー 一覧へ一度お戻りください',
            'integer' => '処理エラー！ メニュー 一覧へ一度お戻りください',
        ],
        'product_name' => [
            'required' => '商品名を入力してください',
            'max' => '商品名は２５５文字以下で入力してください',
        ],
        'product_text' => [
            'required' => '商品説明を入力してください',
        ],
        'product_price' => [
            'required' => '商品価格を入力してください',
            'integer' => '商品価格は半角数字で入力してください',
        ],
        'product_img' => [
            'mimes' => 'アップロードできるのはJPG/JPEG形式の画像のみです',
            'max' => 'アップロードできるのは1500KBまでのファイルのみです',
            'required' => '画像を選択してください',
        ],
        'product_genre_id' => [
            'required' => '商品ジャンルを選択してください',
        ],
        'product_sales_start_day' => [
            'date' => '販売開始日エラー！ 一度メニューへお戻りください',
            'required' => '販売開始日を選択してください',
        ],
        'product_sales_end_day' => [
            'date' => '販売開始日エラー！ 一度メニューへお戻りください',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'title' => 'タイトル',
        'body' => '本文',
        'published_at' => '公開日',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'address1' => '住所',
        'emoloyee_agreement_date' => '契約開始日',
        'kana' => 'フリガナ',
        'name' => '名前',
        'password_confirm' => 'パスワード(確認)',
        //クーポン新規発券
        'coupon_name' => 'クーポン名',
        'coupon_num' => 'クーポン番号',
        'coupon_discount_price' => '値引き額',
        'coupon_max' => '利用上限回数',
        'coupon_conditions_price' => '利用条件金額',
        'coupon_conditions_first' => '対象者',
        'coupon_type_id' => 'クーポン種別',
        'product_id' => '商品名',  //だぶり
        'coupon_product_id' => '商品名',   //だぶり
        'coupon_start_date' => '利用開始日',
        'coupon_end_date' => '利用終了日',
        'coupon_present_product_id' => '使用条件商品',
        //顧客側キャンペーン
        'campaign_name' => 'キャンペーン名',
        'campaign_text' => 'キャンペーン説明文',
        'campaign_note' => '注意事項',
        'campaign_subject' => 'キャンペーン対象者',
        'campaign_start_day' => '掲載開始日',
        'campaign_end_day' => '掲載終了日',
        'file1' => 'メイン画像',
        'file2' => 'バナー画像',

    ],
];

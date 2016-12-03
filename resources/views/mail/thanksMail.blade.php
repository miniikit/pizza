<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <p>
            この度はOIC PIZZAをご利用下さいまして誠に有難うございます。<br>
            下記の通りご注文をお受けいたしましたのでご確認をお願いいたします。<br>
        </p>
        <br>
        <div>
            <p>--配達予定時刻--</p>
            <div>{{$datetime}}</div>
        </div>
        <br>
        <div>
            <p>--お届け先情報--</p>
            <div>名前: {{$user->name}}</div>
            <div>郵便番号: {{$user->postal}}</div>
            <div>住所: {{$user->address1.$user->address2.$user->address3}}</div>
            <div>電話番号: {{$user->phone}}</div>
        </div>
        <br>
        <div>
            <p>--注文内容--</p>
            @foreach ($products as $product)
                <div>商品名: {{$product->product_name}}</div>
                <div>金額: {{number_format($product->productPrice->product_price)}}円</div>
                <div>数量: {{$productCount[$product->id]}}</div>
            @endforeach
        </div>
        <br>
        <div>
            <p>--クーポン--</p>
            @if (empty($coupon))
                <div>なし</div>
            @else
                <div>あり</div>
                <div>クーポン名: {{$coupon->coupon_name}}</div>
                <div>値引き額: {{$coupon->coupon_discount}}</div>
            @endif
        </div>
        <br>
        <div>
            <p>--合計金額--</p>
            @if (empty($coupon))
            <div>{{number_format($total)}}円</div>
            @else
            <div>{{number_format($total - $coupon->coupon_discount)}}円</div>
            @endif
        </div>
        <br>
        <br>
        <p>
            ＊--------------------------------------------------------＊<br>
            　OIC PIZZA<br>
            　〒000-0000 東京都XX区XX XXビル XF<br>
            　TEL: 00-0000-0000 FAX: 00-0000-0000<br>
            　Email: oicpizza@gmail.com<br>
            ＊--------------------------------------------------------＊<br>
        </p>
    </body>
</html>

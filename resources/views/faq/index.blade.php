
@extends('template/master')

@section('title', 'よくある質問')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        <h1>よくある質問</h1>
        <table id="faq">
          <tbody>
            <tr>
              <td class="title">
                Q.会員登録はどうやってすればいいですか?
              </td>
              <td class="answer">
              　A.こちら（会員登録のページ）からお手続きしてください。
              </td>

              <td class="title">
                Q.入会費や年会費はいくらですか?
              </td>
              <td class="answer">
              　A.無料です。
              </td>

              <td class="title">
                Q.会員情報を変更したいです。
              </td>
              <td class="answer">
              　A.こちら（会員登録のページ）からお手続きしてください。
              </td>

              <td class="title">
                Q.支払い方法はなんですか?
              </td>
              <td class="answer">
              　A.現金代引きのみです。クレジットカード等はお使いいただけません。
              </td>

              <td class="title">
                Q.クーポンはどこで確認できますか?
              </td>
              <td class="answer">
              　A.キャンペンページにて随時更新させて頂きます。
              </td>

              <td class="title">
                Q.クーポンはどんな種類がありますか?
              </td>
              <td class="answer">
              　A.値引きと無料プレゼントの２種類を用意しております。
              </td>

              <td class="title">
                Q.ネット注文と電話注文では、メニューの価格は同じですか?
              </td>
              <td class="answer">
              　A.同様の価格です。
              </td>

              <td class="title">
                Q.パスワードを忘れました、どうすればいいですか?
              </td>
              <td class="answer">
              　A.こちら(link)にて、お手続きください。
              </td>

              <td class="title">
                Q.会員を退会したい。
              </td>
              <td class="answer">
              　A.こちらにて、お手続きください。
              </td>
            </tr>
          </tbody>
        </table>
    </div>
@endsection

@section('scrip')

@endsection

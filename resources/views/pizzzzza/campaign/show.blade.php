@extends('template/admin')

@section('title', 'キャンペーン詳細')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/index/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        @if(preg_match('{history}',$_SERVER["HTTP_REFERER"]))
            <li><a href="/pizzzzza/campaign/history">キャンペーン履歴</a></li>
        @else
            <li><a href="/pizzzzza/campaign">キャンペーン一覧</a></li>
        @endif
        <li class="active">キャンペーン詳細</li>
    </ol>
@endsection

@section('main')
    <h1>キャンペーン詳細</h1>
    <div class="row">
        <div class="col-md-7">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center">タイトル</th>
                    <td>{{ $campaign->campaign_title }}</td>
                </tr>
                <tr>
                    <th class="text-center">説明文</th>
                    <td>{{ $campaign->campaign_text }}</td>
                </tr>
                <tr>
                    <th class="text-center">その他</th>
                    <td>{{ $campaign->campaign_note }}</td>
                </tr>
                <tr>
                    <th class="text-center">対象者</th>
                    <td>{{ $campaign->campaign_subject }}</td>
                </tr>
                <tr>
                    <th class="text-center">メイン画像</th>
                    <td><img src="{{ $campaign->campaign_image }}"></td>
                </tr>
                <tr>
                    <th class="text-center">バナー画像</th>
                    <td><img src="{{ $campaign->campaign_banner }}"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center">キャンペーンID</th>
                    <td>{{ $campaign->id }}</td>
                </tr>
                <tr>
                    <th class="text-center">掲載開始日</th>
                    <td>{{ \Carbon\Carbon::parse($campaign->campaign_start_day)->format('Y年m月d日') }}</td>
                </tr>
                <tr>
                    <th class="text-center">掲載終了日</th>
                    <td>
                        @if($campaign->campaign_end_day == null)
                            未設定
                        @else
                            {{ \Carbon\Carbon::parse($campaign->campaign_end_day)->format('Y年m月d日') }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="text-center">登録日</th>
                    <td>{{ \Carbon\Carbon::parse($campaign->created_at)->format('Y年m月d日') }}</td>
                </tr>
                <tr>
                    <th class="text-center">更新日</th>
                    <td>{{ \Carbon\Carbon::parse($campaign->updated_at)->format('Y年m月d日') }}</td>
                </tr>
                </tbody>
            </table>
            <form class="ar" action="/pizzzzza/campaign/{{$campaign->id}}/delete" method="post">
                <a href="/pizzzzza/campaign/{{$campaign->id}}/edit" class="btn btn-default btn-sm">編集</a>
                @if (is_null($campaign->deleted_at))
                    <input class="btn btn-danger btn-sm ml" type="submit" name="delete" value="削除">
                @endif
                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-md-4 col-md-offset-4 mt">
            @if(preg_match('{history}',$_SERVER["HTTP_REFERER"]))
                <a href="/pizzzzza/campaign/history" class="btn btn-default btn-lg btn-block">戻る</a>
            @else
                <a href="/pizzzzza/campaign" class="btn btn-default btn-lg btn-block">戻る</a>
            @endif
        </div>
    </div>
@endsection


@section('script')
    <script style="text/javascript">
        {{-- thをwidth:50%に --}}
        $(document).ready(function () {
            $('th').addClass('th-50');
        });
    </script>
@endsection

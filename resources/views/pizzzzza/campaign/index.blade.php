@extends('template/admin')

@section('title', 'キャンペーン一覧')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active">キャンペーン一覧</li>
    </ol>
@endsection

@section('main')
    <h1>キャンペーン一覧</h1>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>キャンペーン名</th>
                <th>開始日</th>
                <th>終了日</th>
                <th>更新日時</th>
            </tr>
            </thead>
            <tbody>
            @foreach($campaigns as $campaign)
                <tr class="link" data-href="/pizzzzza/campaign/{{$campaign->id}}/show">
                    <td>{{ $campaign->id }}</td>
                    <td>{{ $campaign->campaign_title }}</td>

                    <td>{{ \Carbon\Carbon::parse($campaign->campaign_start_day)->format('Y年m月d日') }}</td>
                    <td>
                        @if($campaign->campaign_end_day == null)
                            未設定
                        @else
                            {{ \Carbon\Carbon::parse($campaign->campaign_end_day)->format('Y年m月d日') }}
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($campaign->updated_at)->format('Y年m月d日') }}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.table tr[data-href]').addClass('clickable').click(function () {
            window.location = $(this).attr('data-href');
        }).find('a').hover(function () {
            $(this).parents('tr').unbind('click');
        }, function () {
            $(this).parents('tr').click(function () {
                window.location = $(this).attr('data-href');
            });
        });
    </script>
@endsection

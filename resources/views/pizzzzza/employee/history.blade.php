@extends('template/admin')

@section('title', '従業員履歴')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active">従業員履歴</li>
    </ol>
@endsection

@section('main')
    <h1>従業員履歴</h1>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>契約開始日</th>
                <th>契約終了日</th>
                <th>更新日時</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr class="link" data-href="/pizzzzza/employee/{{$employee->id}}/show">
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($employee->emoloyee_agreement_date)->format('Y年m月d日') }}</td>
                    <td>
                        @if($employee->emoloyee_agreement_enddate == null)
                            未設定
                        @else
                            {{ \Carbon\Carbon::parse($employee->emoloyee_agreement_enddate)->format('Y年m月d日') }}
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($employee->updated_at)->format('Y年m月d日') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
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

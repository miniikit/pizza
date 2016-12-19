@extends('template/admin')

@section('title', 'キャンペーン編集')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li><a href="/pizzzzza/campaign">キャンペーン一覧</a></li>
        <li><a href="/pizzzzza/campaign/{{ $id }}/show">キャンペーン詳細</a></li>
        <li class="active">キャンペーン編集</li>
    </ol>
@endsection

@section('main')
    <h1>キャンペーン編集</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group" id="menuadd">
        <form action="/pizzzzza/campaign/{{ $id }}/update" method="post" id="AddButton" enctype="multipart/form-data">
            <table id="menu-add-table" class="table table-bordered">
                <tbody>
                <tr>
                    <th>キャンペーン名</th>
                    <td><input class="form-control" type="text" name="campaign_name" value="{{ old('campaign_name',$campaign->campaign_title) }}"></td>
                </tr>
                <tr>
                    <th>説明文</th>
                    <td><textarea class="form-control" id="exampleTextarea" rows="6" name="campaign_text" maxlength="255"
                                  resize="none">{{ old('campaign_text',$campaign->campaign_text) }}</textarea></td>
                </tr>
                <tr>
                    <th>その他</th>
                    <td><textarea class="form-control" id="exampleTextarea" rows="6" name="campaign_note" maxlength="255"
                                  resize="none">{{ old('campaign_note',$campaign->campaign_note) }}</textarea></td>
                </tr>
                <tr>
                    <th>対象者</th>
                    <td>
                        <select name="campaign_subject" id="">
                            @if(old('campaign_subject'))
                                @if(old('campaign_subject') == 1)
                                    <option value="1" selected>全会員</option>
                                    <option value="2">初回利用者限定</option>
                                @else
                                    <option value="1">全会員</option>
                                    <option value="2" selected>初回利用者限定</option>
                                @endif
                            @else
                                <option value="1">全会員</option>
                                <option value="2">初回利用者限定</option>
                            @endif
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>掲載開始日</th>
                    <td>
                        {{ \Carbon\Carbon::parse($campaign->campaign_start_day)->format('Y年m月d日') }}
                    </td>
                </tr>
                <tr>
                    <th>掲載終了日</th>
                    <td><input class="form-control" id="example-date-input" type="date" name="campaign_end_day"
                               size="5" value="{{ old('campaign_end_day',$campaign->campaign_end_day) }}">
                    </td>
                </tr>
                <tr>
                    <th>メイン画像</th>
                    <td class="imgInput">
                        <img class="mb imgView" src="{{ $campaign->campaign_image }}" alt="">
                        <input type="file" id="getfile" name="file1" value="" />
                        <div class="caption mt">※ 横:1200px 縦:400px 拡張子: jpg jpeg</div>
                    </td>
                </tr>
                <tr>
                    <th>バナー画像</th>
                    <td class="imgInput">
                        <img class="mb imgView" src="{{ $campaign->campaign_banner }}" alt="">
                        <input type="file" id="getfile" name="file2" value="" />
                        <div class="caption mt">※ 横:100px 縦:440px 拡張子: jpg jpeg</div>
                    </td>
                </tr>
                </tbody>
            </table>
            <input id="postButton" type="submit" name="post" style="display:none">
            <div class="menu">
                <a href="/pizzzzza/menu/" class="add-button btn btn-default btn-lg" name="button">戻る</a>
                <input type="submit" class="add-button btn btn-primary btn-lg" name="submit" value="更新">
            </div>
            {{ csrf_field() }}
        </form>

    </div>

@endsection


@section('script')
    <script>
        $(function(){

            var setFileInput = $('.imgInput'),
                    setFileImg = $('.imgView');

            setFileInput.each(function(){
                var selfFile = $(this),
                        selfInput = $(this).find('input[type=file]'),
                        prevElm = selfFile.find(setFileImg),
                        orgPass = prevElm.attr('src');

                selfInput.change(function(){
                    var file = $(this).prop('files')[0],
                            fileRdr = new FileReader();

                    if (!this.files.length){
                        prevElm.attr('src', orgPass);
                        return;
                    } else {
                        if (!file.type.match('image.*')){
                            prevElm.attr('src', orgPass);
                            return;
                        } else {
                            fileRdr.onload = function() {
                                prevElm.attr('src', fileRdr.result);
                            }
                            fileRdr.readAsDataURL(file);
                        }
                    }
                });
            });
        });
    </script>
@endsection
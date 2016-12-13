@extends('template/admin')

@section('title', 'キャンペーン追加')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active">キャンペーン追加</li>
    </ol>
@endsection

@section('main')
    <h1>キャンペーン追加</h1>
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
        <form action="/pizzzzza/campaign/store" method="post" id="AddButton" enctype="multipart/form-data">
            <table id="menu-add-table" class="table table-bordered">
                <tbody>
                <tr>
                    <th>キャンペーン名</th>
                    <td><input class="form-control" type="text" name="campaign_name" value=""></td>
                </tr>
                <tr>
                    <th>キャンペーン説明文</th>
                    <td><textarea class="form-control" id="exampleTextarea" rows="6" name="campaign_text" maxlength="255"
                                  resize="none"></textarea></td>
                </tr>
                <tr>
                    <th>注意事項</th>
                    <td><textarea class="form-control" id="exampleTextarea" rows="6" name="campaign_note" maxlength="255"
                                  resize="none"></textarea></td>
                </tr>
                <tr>
                    <th>キャンペーン対象者</th>
                    <td>
                        <select name="campaign_subject" id="">
                            <option value="1">全会員</option>
                            <option value="2">初回利用者限定</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>掲載開始日</th>
                    <td><input class="form-control" id="example-date-input" type="date" name="campaign_start_day"
                               value="" size="5">
                    </td>
                </tr>
                <tr>
                    <th>掲載終了日</th>
                    <td><input class="form-control" id="example-date-input" type="date" name="campaign_end_day"
                               value="" size="5">
                    </td>
                </tr>
                <tr>
                    <th>メイン画像</th>
                    <td class="imgInput">
                        <img class="mb imgView" src="/images/campaign/noimage.jpg" alt="">
                        <input type="file" id="getfile" name="file1" value="" />
                        <div class="caption mt">※ 横:1200px 縦:400px 拡張子: jpg jpeg</div>
                    </td>
                </tr>
                <tr>
                    <th>バナー画像</th>
                    <td class="imgInput">
                        <img class="mb imgView" src="/images/campaign_banner/noimage.jpg" alt="">
                        <input type="file" id="getfile" name="file2" value="" />
                        <div class="caption mt">※ 横:100px 縦:440px 拡張子: jpg jpeg</div>
                    </td>
                </tr>
                </tbody>
            </table>
            <input id="postButton" type="submit" name="post" style="display:none">
            <div class="menu">
                <a href="/pizzzzza/menu/" class="add-button btn btn-default btn-lg" name="button">戻る</a>
                <input type="submit" class="add-button btn btn-primary btn-lg" name="submit" value="追加">
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
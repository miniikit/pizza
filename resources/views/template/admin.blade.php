<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>@yield('title') | 管理画面 </title>

<meta name="description" itemprop="description" content="@yield('description')">
<meta name="keywords" itemprop="keywords" content="@yield('keywords')">
<link href="/css/common/font-awesome.min.css" rel="stylesheet">
<link href="/css/common/bootstrap.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/js/common/bootstrap.min.js"></script>
<link href="/css/common/reset.css" rel="stylesheet">
<link href="/css/common/admin.css"  rel="stylesheet">
<link rel="stylesheet" href="/plug/featherlight/featherlight.css">
<script src="/plug/featherlight/featherlight.js" charset="utf-8"></script>
@yield('css')



@yield('js')

</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/pizzzzza/order/">管理画面</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/pizzzzza/order/">注文確認</a></li>
                <li><a href="/pizzzzza/order/accept">電話注文</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">売上&売れ筋<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/pizzzzza/analysis/earning">売上</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/pizzzzza/analysis/popular">売れ筋</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">メニュー<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/pizzzzza/menu/">メニュー一覧</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/pizzzzza/menu/add">メニュー追加</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">クーポン<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/pizzzzza/coupon">クーポン一覧</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/pizzzzza/add">クーポン追加</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/pizzzzza/history">クーポン履歴</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">従業員<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/pizzzzza/employee">従業員一覧</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/pizzzzza/employee/add">従業員追加</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<main class="main">
<div class="container">

@yield('main')
</main>
</div>

</div>
</main>

</body>
</html>

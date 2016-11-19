<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>@yield('title') | 会員 </title>

<meta name="description" itemprop="description" content="@yield('description')">
<meta name="keywords" itemprop="keywords" content="@yield('keywords')">
<link href="/css/common/font-awesome.min.css" rel="stylesheet">
<link href="/css/common/bootstrap.min.css" rel="stylesheet">
<link href="/css/common/reset.css" rel="stylesheet">
<link href="/css/common/admin.css"  rel="stylesheet">

@yield('css')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/js/common/bootstrap.min.js"></script>

@yield('js')

</head>
<body>

<main class="main">
<div class="container">

@yield('main')
</main>
</div>

</div>
</main>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<title>@yield('title') | 管理画面 </title>

<meta name="description" itemprop="description" content="@yield('description')">
<meta name="keywords" itemprop="keywords" content="@yield('keywords')">
<link href="/css/common/font-awesome.min.css" rel="stylesheet">
<link href="/css/common/bootstrap.min.css" rel="stylesheet">
<link href="/css/common/reset.css" rel="stylesheet">
<link href="/css/common/main.css"  rel="stylesheet">
 
@yield('css') 
 
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/js/common/bootstrap.min.js"></script>
</head>
<body>

<main id="main">
<div class="container">

@yield('main')

</div>
</main>

</body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> @yield('title') | OIC PIZZA</title>
        <script src="/js/common/jQuery.js" charset="utf-8"></script>
        <script src="/js/common/util.js" charset="utf-8"></script>
        <script src="/js/common/main.js" charset="utf-8"></script>
        <link rel="stylesheet" href="/plug/fontawesome/css/font-awesome.min.css" media="screen" title="no title">
        <link rel="stylesheet" href="/css/common/reset.css" media="all" title="no title">
        <link rel="stylesheet" href="/css/common/main.css" media="all" title="no title">
        @yield('css')
        @yield('plug')
    </head>
    <body id="app">
        <header id="header">
            <div class="wrap">
                <h1><a href="/"><img src="images/common/logo.png" alt="OIC PIZZA" /></a></h1>
                <nav id="gNav">
                    <ul>
                        <li id="gTop"><a href="#">TOP</a></li>
                        <li id="gMenu"><a href="#">MENU</a></li>
                        <li id="gTopics"><a href="#">TOPICS</a></li>
                        <li id="gContact"><a href="#">CONTACT</a></li>
                        <li id="cart"><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                        <li id="gMenubar"><i class="fa fa-bars" aria-hidden="true"></i></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div id="spMenu">
            <div class="inner">
                <ul>
                    <li><a href="#"><span>TOP</span></a></li>
                    <li><a href="#"><span>MENU</span></a></li>
                    <li><a href="#"><span>TOPICS</span></a></li>
                    <li><a href="#"><span>CONTACT</span></a></li>
                </ul>
            </div>
        </div>

        <main id="main">
            <div class="container">
                @yield('main')
            </div>
        </main>

        <div id="arrow"><a href="#app"><i class="fa fa-chevron-up" aria-hidden="true"></i></a></div>
        <footer id="footer">
            <div class="wrap container">
                <div class="nav">
                    <ul>
                        <li><a href="#">会社概要</a></li>
                        <li><a href="#">個人情報保護方針</a></li>
                        <li><a href="#">会員規約</a></li>
                        <li><a href="#">よくある質問</a></li>
                        <li><a href="#">お問い合わせ</a></li>
                    </ul>
                </div>
            </div>
        </footer>
        <div id="copyright">
            Copyright (c) 2016 Copyright Holder All Rights Reserved.
        </div>

        <script type="text/javascript">
            $(window).load(function() {
                $('.flexslider').flexslider({
                    animation: "slide"
                });
            });
        </script>
    </body>
</html>

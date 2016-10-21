
@extends('template/master')

@section('title', 'トップ')

@section('css')
    <link rel="stylesheet" href="/css/index/index.css" media="all" title="no title">
@endsection

@section('plug')
    <script src="/plug/flexSlier/jquery.flexslider-min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/plug/flexSlier/flexslider.css" media="screen" title="no title">
@endsection
@section('main')
    <div class="flexslider">
      <ul class="slides">
          <li><img src="images/index/pizza01.png" /></li>
          <li><img src="images/index/pizza02.png" /></li>
          <li><img src="images/index/pizza03.png" /></li>
          <li><img src="images/index/pizza04.png" /></li>
          <li><img src="images/index/pizza05.png" /></li>
      </ul>
    </div>
    <div class="container wrap">
        <div class="campaign">
            <ul>
                <li><img src="images/index/banner02.png" alt="" /></li>
                <li><img src="images/index/banner01.png" alt="" /></li>
                <li><img src="images/index/banner01.png" alt="" /></li>
                <li><img src="images/index/banner01.png" alt="" /></li>
                <li><img src="images/index/banner01.png" alt="" /></li>
                <li><img src="images/index/banner01.png" alt="" /></li>
            </ul>
        </div>
    </div>
@endsection

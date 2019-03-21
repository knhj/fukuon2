<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') </title>
        
        <!--For Bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
　　　　<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
　　　　<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
       
       <!--for api-->
       <script src="{{ secure_asset('js/api_ajax.js') }}" defer></script>
       
       <!--for css-->
      <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}" />
       
        <!--- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-134638381-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-134638381-1');
</script>
        
        

    </head>
    <body>
        
        <!---->
           <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <div class="navbar-brand" style='font-size:2em;' ><a class="bar_top" href="/">Fukuon</a></div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
               
           <li class="nav-item active">
              <a class="nav-link" href="/">副音声検索 </a>
            </li> 
              
              
            <li class="nav-item active">
              <a class="nav-link" href="/part">動画検索 </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="/newlist">新着副音声</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="/ranking">ランキング</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="/mypage">マイページ</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
        
        <!---->
        
        
    <!--<div class="container">-->
    <!--    <div class="header clearfix">-->
    <!--        <nav>-->
    <!--          <ul class="nav nav-pills float-right">-->
    <!--              <li class="nav-item">-->
                      
                <!--<input type="text" class="form-control"  placeholder="動画タイトルを検索">-->
    <!--                <a class="nav-link" href="/part">-->
    <!--                    検索ページ-->
    <!--                </a> -->
    <!--            </li>-->
                <!-- <li class="nav-item">-->
                <!--    <a class="nav-link" href="/">-->
                <!--        kano-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li class="nav-item">-->
                <!--    <a class="nav-link" href="/">-->
                <!--        ログアウト-->
                <!--    </a>-->
                <!--</li>-->
                <!--<li class="nav-item">-->
                <!--     <a class="nav-link" href="/">新規会員登録</a>-->
                <!--</li>-->
                <!--<li class="nav-item">-->
                <!--    <a class="nav-link" href="">ログイン</a>-->
                <!--</li>-->
        <!--      </ul>-->
        <!--    </nav>-->
        <!--<h3 class="text-muted mt-2">Fukuon</h3>-->
        <!--</div>-->

        <div class="container my-5">
             @yield('content')
        </div>
        
         <!-- Footer -->
    <footer class="py-4 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Fukuon 2018</p>
      </div>
    </footer>
        
        
        <!--<footer class="footer">-->
        <!--    <nav class="navbar navbar-toggleable-md navbar-light">-->
        <!--        <div class="collapse navbar-collapse" id="navbarNavDropdown">-->
        <!--            <ul class="navbar-nav">-->
        <!--                <li class="nav-item"><a class="nav-link" href="/">新着投稿一覧</a></li>-->
                        <!--<li class="nav-item"><a class="nav-link" href="/blog/new">記事新規作成ページ</a></li>-->
        <!--                <li class="nav-item"><a class="nav-link" href="/ranking">再生数ランキング</a></li>-->
        <!--            </ul>-->
        <!--        </div>-->
        <!--    </nav>-->
        <!--</footer>-->
        
    </div>
    </body>
</html>
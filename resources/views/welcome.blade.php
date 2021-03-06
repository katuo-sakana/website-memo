<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('components.head')

<body class="toppage">
  <nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.png') }}" width="200" height="52">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @guest
            <li class="nav-item mr-2">
              <a href="{{ route('login.guest') }}" class="btn btn-success">
                ゲストログイン
              </a>
            </li>

            <li class="nav-item mr-2">
              <a class="btn btn-outline-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="btn btn-outline-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @endif
          @else
            <a class="btn btn-secondary" href="{{ url('/home') }}">一覧に戻る</a>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <div class="top-main">
    <div class="top-main__primary pt-5">
      <h1 class="text-center mt-5 font-weight-bold">Webページのちょっとしたメモに。</h1>
      <p class="text-center mt-5">気になったWebサイトのメモ帳としてお使いください。</p>
      <div class="mt-5 text-center"><a class="btn btn-outline-success"
          href="{{ route('register') }}">無料でページのメモをする</a>
      </div>
    </div>
    <div class="top-main__secondary">
      <div class="top-main__image">
        <img src="{{ asset('images/main_illustration.png') }}" width="400" height="auto">
      </div>
    </div>
  </div>

  <section class="section-base">
    <header class="section-base__header">
      <h2 class="section-base__title">ご利用方法</h2>
    </header>
    <div class="width-base">
      <div class="top-about">
        <div class="top-about__primary">
          <p class="top-about-description">
            気になったWebページのURLやコメントを入力していただいて、<br class="pc">後から振り返ったり他の人と共有するなどしてお使いください<br
              class="pc">また、気になった記事を保存するなどの用途でもお使いいただけます。</p>
        </div>
        <div class="top-about__secondary">
          <div class="top-about-image">
            <img src="{{ asset('images/about_image.png') }}" width="215" height="237">
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-base">
    <header class="section-base__header">
      <h2 class="section-base__title">画面一覧</h2>
    </header>
    <div class="width-base">
      <div class="top-list">
        <div class="autoplay mt-4">
          <div><img src="{{ asset('images/slider_register_top.png') }}"></div>
          <div><img src="{{ asset('images/slider_list_top.png') }}"></div>
          <div><img src="{{ asset('images/slider_show_top.png') }}"></div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer-area">
    <div class="copy-right"><small><a href="{{ url('/') }}">Copyright (C) 2021 websitememo</a></small></div>
  </footer>


  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js">
  </script>

  <script type="text/javascript">
    $('.autoplay').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      // 画像下のドット（ページ送り）を表示
      dots: true,
    });

  </script>
</body>

</html>

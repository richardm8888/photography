<html>
    <head>
        <title>{{ $meta_title }}</title>

        <META NAME="ROBOTS" CONTENT="{{ $robots }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Bootstrap core CSS -->
        <link href="/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/justifiedGallery.min.css">
        <link rel="stylesheet" href="/css/swipebox.min.css">

        <script
          src="https://code.jquery.com/jquery-3.2.1.min.js"
          integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
          crossorigin="anonymous"></script>

        <script type="text/javascript" src="/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/bootstrap/js/collapse.js"></script>
        <script type="text/javascript" src="/js/jquery.justifiedGallery.min.js"></script>
        <script type="text/javascript" src="/js/jquery.swipebox.min.js"></script>

        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700,100' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:300,700,900,500' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.7/typicons.min.css">

        @if ( $ga_account )
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

          ga('create', '{{ $ga_account }}', 'auto');
          ga('send', 'pageview');

        </script>
        @endif

        <script type="text/javascript">
          $(document).ready(function() {

            $('.navbar-toggle').click(function(){
              if ( $(this).hasClass('collapsed') ) {
                $('nav').css('opacity', 1);
              } else {
                if ( $(window).scrollTop() > ($('#topCarousel').height() - 50) ) {
                  $('nav').css('opacity', 1);
                } else {
                  $('nav').css('opacity', 0.8);
                }
              }
            });

            $(window).scroll(function() {
              if ( $(window).scrollTop() > ($('#topCarousel').height() - 50) || !$('.navbar-toggle').hasClass('collapsed') ) {
                $('nav').css('opacity', 1);
              } else {
                $('nav').css('opacity', 0.8);
              }
            });
          });
        </script>

        @yield('custom_js')

    </head>
    <body>

        <nav class="navbar navbar-fixed-top navbar-inverse bg-faded">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navlinks" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
              <img src="/img/moss_logo_white.png" />
            </a>
          </div>

          <div class="collapse navbar-collapse" id="navlinks">
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="/">Home</a></li>
              <li><a href="/#about">About me</a></li>
              <li><a href="/#photos">Galleries</a></li>
            </ul>
          </div>

        </nav>

        @yield('content')

        <footer>
            <div class="hidden-xs hidden-sm col-md-6">
                <p>
                    &nbsp;
                    <img class="logo" src="/img/moss_logo_white.png" />
                </p>
            </div>
            <div class="col-sm-12 col-md-6">
                <p class="text-right">
                    &copy; Moss Photography <?php echo date("Y"); ?>
                    <a class="_blank" href="https://www.facebook.com/mossphotosuk/">
                      <img class="social_icon" src="/img/icons/facebook.png" />
                    </a>
                    <a target="_blank" href="https://twitter.com/mossphotosuk">
                      <img class="social_icon" src="/img/icons/twitter.png" />
                    </a>
                    <a target="_blank" href="https://www.flickr.com/photos/150429213@N04/">
                      <img class="social_icon" src="/img/icons/flickr.png" />
                    </a>
                </p>
            </div>
        </footer>

    </body>
</html>

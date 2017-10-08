@extends('layouts.app')

@section('custom_js')
    @parent

    <script type="text/javascript">
      $(document).ready(function(){
          justifyGallery();
          var width = $(window).width();
          $(window).resize(function(){
              if ( $(window).width() !== width ) {
                justifyGallery();
                width = $(window).width();
              }
          });
      });

      function justifyGallery() {
          var rowHeight = ( ($(window).width() > 680) ? 220 : ( ($(window).width() > 400) ? 150 : 100) );

          $(".justifiedGallery").justifiedGallery({
            maxRowHeight: 250,
            rowHeight: rowHeight,
            margins: 10,
          });
      }
    </script>
@endsection

@section('content')
    @parent

    <section id="related_posts" class="wow fadeInUp" data-wow-delay="300ms">
        <div class="container">
            <h2 class="text-center" style="margin-bottom: 10px;">
              <span class="typcn typcn-image-outline"></span> Galleries
            </h2>
            <div class="row">
                <div class="justifiedGallery">
                    @foreach ($displayPosts as $p)
                        <a href='/gallery/{{ $p['slug'] }}'>
                          <img src='{{ $p['img'] }}' />
                          <div class="caption"><span>{{ $p['title'] }}</span></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <nav style="text-align: center; opacity: 1;" aria-label="Page navigation">
      {{ $posts->links() }}
    </nav>



@endsection

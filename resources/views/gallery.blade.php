@extends('layouts.app')

@section('custom_js')
    @parent

    <script type="text/javascript">
      $(document).ready(function(){

          $('body').swipebox({selector:'.galleryImage'});

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

    @include('carousel', [
      'carousel' => $carousel,
      'single' => true,
      'title' => $title,
    ])

    <section id="photos" class="wow fadeInUp" data-wow-delay="300ms">
        <div class="container">
            <div class="row">
                <div class="justifiedGallery">
                    @foreach ($displayPhotos as $p)
                      <a rel='gallery' class='galleryImage' href='{{ $p['url_l'] }}'>
                        <img src='{{ $p['url_m'] }}' />
                      </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="tags">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h3><span class="typcn typcn-tags"></span> Tags</h3>
                    <p>
                    @if ( count($tags) )
                        @foreach ($tags as $t)
                          <span class="label label-default"><a href="/tags/{{ $t['slug'] }}">{{ $t['tag'] }}</a></span>
                        @endforeach
                    @else
                        <em>No tags</em>
                    @endif
                    </p>
                </div>
                <div class="col-sm-12 col-md-6">
                    <h3><span class="typcn typcn-flow-switch"></span> Related Galleries</h3>
                    <p>
                    @if ( count($related) )
                        @foreach ( $related as $rel )
                            <span class="label label-default"><a href="/gallery/{{ $rel['slug'] }}">{{ $rel['title'] }}</a></span>
                        @endforeach
                    @else
                        <em>No related galleries</em>
                    @endif
                  </p>
                </div>
            </div>
        </div>
    </section>

@endsection

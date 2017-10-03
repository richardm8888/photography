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
                        @if ($mobile)
                        <img src='{{ $p['url_s'] }}' />
                        @else
                        <img src='{{ $p['url_m'] }}' />
                        @endif
                      </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <nav style="text-align: center;" aria-label="Page navigation">
      <ul class="pagination">
        @if ( $page > 1 )
        <li>
          <a href="?page={{ $page-1 }}" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        @endif
        @foreach ( $pages as $p )
        <li @if ($page == $p) class="active" @endif><a href="?page={{ $p }}">{{ $p }}</a></li>
        @endforeach
        @if ( $page < count($pages) )
        <li>
          <a href="?page={{ $page+1 }}" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
        @endif
      </ul>
    </nav>

    <section style="margin: 20px auto;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p>{{ $content }}</p>
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

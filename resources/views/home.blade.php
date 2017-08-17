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
          $('#topCarousel').carousel();
      });

      function justifyGallery() {
          var rowHeight = ( ($(window).width() > 680) ? 220 : ( ($(window).width() > 400) ? 150 : 100) );

          $(".justifiedGallery").justifiedGallery({
            rowHeight: rowHeight,
            margins: 10,
            lastRow: 'justify'
          });
      }
    </script>
@endsection

@section('content')
    @parent

    @include('carousel', [
      'carousel' => $carousel,
      'single' => false,
      'title' => false,
    ])

    <section id="about">
        <div class="container">
            <div class="row features">
                <div class="col-xs-12 col-sm-6 col-md-4 text-center wow fadeInUp" data-wow-delay="100ms">
                    <span class="typcn typcn-pencil x3"></span>
                    <h4>About Me</h4>
                    <p>I'm a photography enthusiast based in West Sussex, UK, with a keen interest in Landscape and Wildlife photography.</p>
                    <p>Although more comfortable with those subjects, I'm always looking for ways to improve and broaden my skillset.</p>
                </div>
                <div class="hidden-xs col-sm-6 col-md-4 text-center wow fadeInUp" data-wow-delay="500ms">
                    <span class="typcn typcn-bookmark x3"></span>
                    <h4>Latest Posts</h4>
                    <table width="100%">
                    @foreach ($blogs as $b)
                    <tr>
                      <td style="text-align: center;">{{ date('d/m/Y', strtotime($b['date'])) }}</td>
                      <td style="text-align: left;"><a href="/gallery/{{ $b['slug'] }}">{{ $b['title'] }}</a></td>
                    </tr>
                    @endforeach
                    </table>
                </div>
                <div class="hidden-xs col-sm-6 col-md-4">
                    <a class="twitter-timeline" data-lang="en" data-width="100%" data-height="300" data-theme="light" data-link-color="#2B7BB9" href="https://twitter.com/mossphotosuk">Tweets by mossphotosuk</a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>
    </section>

    <section
      class="blog sheffield-park wow fadeInUp"
      data-wow-delay="300ms"
      style="background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-image: url('{{ $cover_blogs[0]['img'] }}');"
      >
        <div class="container">
            <div class="row">
                <div class="hidden-xs hidden-sm col-md-6"></div>
                <div class="col-sm-12 col-md-6">
                    <div class="blog-overlay"></div>
                    <div class="content">
                      <h2 class="blog-header">{{ $cover_blogs[0]['title'] }}</h2>
                      <h4 class="blog-date">{{ $cover_blogs[0]['date'] }}</h4>
                      <p>{{ $cover_blogs[0]['snippet'] }}</p>
                      <a class="btn btn-danger btn-lg" href="/gallery/{{ $cover_blogs[0]['slug'] }}">View Gallery</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="photos" class="wow fadeInUp" data-wow-delay="300ms">
        <div class="container">
            <h2 class="text-center" style="margin-bottom: 10px;">
              <span class="typcn typcn-image-outline"></span> Galleries
            </h2>
            <div class="row">
                <div class="justifiedGallery">
                    @foreach ($websiteGalleries as $g)
                        <a href='/gallery/{{ $g->slug }}'>
                          <img src='{{ $g->meta->fifu_image_url }}' />
                          <div class="caption"><span>{{ $g->post_title }}</span></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section
      class="blog wow fadeInUp"
      data-wow-delay="300ms"
      style="background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-image: url('{{ $cover_blogs[1]['img'] }}');"
      >
        <div class="container">
            <div class="row">
                <div class="hidden-xs hidden-sm col-md-6"></div>
                <div class="col-sm-12 col-md-6">
                    <div class="blog-overlay"></div>
                    <div class="content">
                      <h2 class="blog-header">{{ $cover_blogs[1]['title'] }}</h2>
                      <!--<h3 class="blog-sub-header">Sheffield Park</h3>-->
                      <h4 class="blog-date">{{ $cover_blogs[1]['date'] }}</h4>
                      <p>{{ $cover_blogs[1]['snippet'] }}</p>
                      <a class="btn btn-danger btn-lg" href="/gallery/{{ $cover_blogs[1]['slug'] }}">View Gallery</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

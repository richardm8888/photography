@extends('layouts.app')

@section('custom_js')
    @parent

    <script type="text/javascript">
      $(document).ready(function(){
          $(".justifiedGallery").justifiedGallery({
            rowHeight: 250,
            margins: 10,
            lastRow: 'justify'
          });

          $('#homeCarousel').carousel();
      });
    </script>
@endsection

@section('content')
    @parent

    <section id="homeCarousel" class="carousel">

        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#homeCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#homeCarousel" data-slide-to="1"></li>
          <li data-target="#homeCarousel" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">
            <div class="item active">
                <img src="{{ $galleries[0]['primary_photo_extras']['url_l'] }}" alt="Los Angeles">
            </div>

            <div class="item">
                <img src="{{ $galleries[1]['primary_photo_extras']['url_l'] }}" alt="Chicago">
            </div>

            <div class="item">
                <img src="{{ $galleries[2]['primary_photo_extras']['url_l'] }}" alt="New York">
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#homeCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#homeCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>

    </section>


    <section id="about">
        <div class="container">
            <div class="row features">
                <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="100ms">
                    <span class="typcn typcn-pencil x3"></span>
                    <h4>Consectetur Risus</h4>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                </div>
                <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="300ms">
                    <span class="typcn typcn-camera-outline x3"></span>
                    <h4>Ultricies Aenean</h4>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
                <div class="col-md-4 text-center wow fadeInUp" data-wow-delay="500ms">
                    <span class="typcn typcn-bookmark x3"></span>
                    <h4>Cras Sollicitudin</h4>
                    <p>Etiam porta sem malesuada magna mollis euismod. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas faucibus mollis interdum.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="news3"
      class="blog sheffield-park wow fadeInUp"
      data-wow-delay="300ms"
      style="background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-image: url('{{ $galleries[2]['primary_photo_extras']['url_l'] }}');"
      >
        <div class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="blog-overlay"></div>
                    <div class="content">
                      <h2 class="blog-header">Sheffield Park Gardens</h2>
                      <h3 class="blog-sub-header">Sheffield Park</h3>
                      <h4 class="blog-date">20/04/2017</h4>
                      <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                      <p>Donec sed odio dui. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Etiam porta sem malesuada magna mollis euismod.</p>
                      <a class="btn btn-danger btn-lg" href="#">Read more<i class="fa fa-arrow-circle-o-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="news"
      class="blog amberley-cars wow fadeInUp"
      data-wow-delay="300ms"style="background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-image: url('{{ $galleries[3]['primary_photo_extras']['url_l'] }}');"
    >
        <div class="container">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="blog-overlay"></div>
                    <div class="content">
                      <h2 class="blog-header">Vintage Car Show</h2>
                      <h3 class="blog-sub-header">Amberley Museum</h3>
                      <h4 class="blog-date">02/04/2017</h4>
                      <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                      <p>Donec sed odio dui. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Etiam porta sem malesuada magna mollis euismod.</p>
                      <a class="btn btn-danger btn-lg" href="#">Read more<i class="fa fa-arrow-circle-o-right"></i> </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="photos" class="wow fadeInUp" data-wow-delay="300ms">
        <div class="container">
            <div class="row">
                <div class="justifiedGallery">

                    @foreach ($galleries as $g)
                        <a href='/gallery/{{ $g['id'] }}'>
                          <img src='{{ $g['primary_photo_extras']['url_m'] }}' />
                          <div class="caption"><span>{{ $g['title']['_content'] }}</span></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section id="news2" class="blog vintage-bikes wow fadeInUp" data-wow-delay="300ms">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="blog-overlay"></div>
                    <div class="content">
                      <h2 class="blog-header">Vintage Motorbikes</h2>
                      <h3 class="blog-sub-header">Brighton - Madeira Drive</h3>
                      <h4 class="blog-date">02/04/2017</h4>
                      <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                        Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                      <p>Donec sed odio dui. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit.
                        Etiam porta sem malesuada magna mollis euismod.</p>
                      <a class="btn btn-danger btn-lg" href="#">Take a Look <i class="fa fa-arrow-circle-o-right"></i> </a>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>

@endsection

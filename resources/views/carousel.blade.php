<script type="text/javascript">
  $(document).ready(function(){
    $('#topCarousel').carousel();

    $(window).scroll(function() {
      if ( $(window).scrollTop() > ($('#topCarousel').height() - 50) ) {
        $('.carouselTitle').css('opacity', 1);
      } else {
        $('.carouselTitle').css('opacity', 0.8);
      }
    });

    resizeCarousel();
    $(window).resize(function(){
      resizeCarousel();
    });


  });

  function resizeCarousel() {
    if ( $(window).height() > $(window).width() ) {
      $('#topCarousel').height('auto');
      $('#topCarousel').width('100%');
    } else {
      $('#topCarousel').height('100%');
      $('#topCarousel').width('auto');
    }
  }
</script>

<section id="topCarousel" class="carousel">

    @if ($title)
    <div class="carouselTitle">
      {{ $title }}
    </div>
    @endif

    <!-- Indicators -->
    <ol class="carousel-indicators">

      @if (!$single)
        <?php $i = 0; ?>
        @foreach ($carousel as $p)
          @if ($i == 0)
            <li data-target="#topCarousel" data-slide-to="{{ $i }}" class="active"></li>
          @else
            <li data-target="#topCarousel" data-slide-to="{{ $i }}"></li>
          @endif

          <?php $i++; ?>
        @endforeach
      @endif
    </ol>

    <div class="carousel-inner">
        <?php $i = 0; ?>
        @foreach ($carousel as $p)
          @if ($i == 0 || ($i > 0 && !$single))
            @if ($i == 0)
              <div class="item  active">
            @else
              <div class="item">
            @endif
                <img src="{{ $p['url_l'] }}" />
            </div>
          @endif

          <?php $i++; ?>
        @endforeach

    </div>

    @if (!$single)
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#topCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#topCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
      </a>
    @endif

</section>

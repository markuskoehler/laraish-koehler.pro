@extends('layouts.titan')

@section('content')
    <section class="home-section home-parallax home-fade home-full-height bg-dark bg-dark-30" id="home" data-background="assets/images/section-4.jpg">
        <div class="titan-caption">
            <div class="caption-content">
                <div class="font-alt mb-30 titan-title-size-4">Error 404</div>
                <div class="font-alt">The requested URL was not found on this server.<br/>That is all we know.
                </div>
                <div class="font-alt mt-30"><a class="btn btn-border-w btn-round" href="index.html">Back to home page</a></div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script>
        // cleaning up page, todo make configurable
        //$('nav').hide();
        //$('.navbar-custom + .main').css('margin-top', '0');
        $('.pre-footer').hide();
        $('footer').hide();
        $('div.main').replaceWith(function() {
            return $('section#home', this);
        });
    </script>
@endsection
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleControls" data-slide-to="1"></li>
        <li data-target="#carouselExampleControls" data-slide-to="2"></li>
        <li data-target="#carouselExampleControls" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('slider/slider-1.jpeg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('slider/slider-2.jpeg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('slider/slider-3.jpeg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('slider/slider-4.jpeg') }}" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
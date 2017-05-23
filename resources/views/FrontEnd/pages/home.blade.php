@extends('FrontEnd.layout.app')

@section('header')
	<!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('frontend/images/Cover page LHT.jpg');"> </div>
                <div class="carousel-caption">
                    <h2>Welcome LHT Capital </h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('frontend/images/Cover page LHT.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Welcome to LHT Capital</h2>
                </div>
            </div>

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
@stop

@section('content')
	<!-- Page Content -->
    <div class="container">

        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">
                    Welcome to LHT Capital
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
						<h4> LHT Capital</h4>	
                    </div>
                    <div class="panel-body">
						<div class="animated fadeInUp" style="animation-delay: 0.4s;">
	                        <p>LHT is the leading Market Expansion Services in cambodia. Our Ckients and Customers bdndfit from intergrated and tailor-made services along the entire value chain, offter any combination of sourcing,marketing,seles;distribution and after-sal support services. </p>
	                        <p>LHT is the leading Market Expansion Services in cambodia. Our Ckients and Customers bdndfit from intergrated and tailor-made services along the entire value chain, offter any combination of sourcing,marketing,seles;distribution and after-sal support services. </p>
							<p>LHT is the leading Market Expansion Services in cambodia. Our Ckients and Customers bdndfit from intergrated</p>
						</div>
                    </div>
                </div>
            </div>		
            <div class="col-md-6">
			  	<div class="grid">
					<div class="animated zoomIn" style="animation-delay: 0.6s;">
						<figure class="effect-zoe">
							<img src="frontend/beauty/ddd.jpg" alt="img14"/ style="width:100%; height:400px;">
							<figcaption>
								<h3>Lht <span>Capital</span></h3>
								<span class="icon-heart"></span>
								<span class="icon-eye"></span>
								<span class="icon-paper-clip"></span>
								<p>Welcome to lht beauty.Our Ckients and Customers bdndfit from intergrated </p>
								<a href="#">View more</a>
							</figcaption>			
						</figure>
					</div><!--close animeted zoomin-->	
               	</div>
			</div><!-- col-lg-->
        </div>
    </div>
    <!-- /.container -->
@stop
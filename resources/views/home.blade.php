@extends('includes.app')
	@section('nav')
		@extends('includes.nav')
	@endsection

@section('content')

<div class="container-fluid no-padding">
	<div class="col-md-12 no-padding">
		<div id="slider" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators" style="bottom: 20px;">
				@foreach($sliders as $slider)
    			<li data-target="#slider" data-slide-to="{{ $loop->iteration-1 }}" 
    				class="@if($loop->iteration == 1) active @endif"></li>
    			@endforeach
  			</ol>
  			<div class="carousel-inner" role="listbox">
  				@foreach($sliders as $slider)
    			<div class="carousel-item 
    			@if($loop->iteration == 1) active @endif"
    			ondblclick="slider({{ $loop->iteration }})">
      				<img class="banner-img bottom-30"
      				src="{{ asset('/images/'.$slider->img) }}" alt="banner">
    			</div>
    			@endforeach
  			</div>
  			<a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
    		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
      		</a>
  			<a class="carousel-control-next" href="#slider" role="button" data-slide="next">
    			<span class="carousel-control-next-icon" aria-hidden="true"></span>
  			</a>
		</div>
	</div>
</div>

<div class="container no-padding">
	<div class="row bottom-30">
		<div class="col-md-1 col-3">
			<div style="height: 300px;">
				<div class="offer-time-box">
					<span class="text-center offer-time">
						<span class="title offer-time-title" id="days"></span>
						<span><br>Días</span>
					</span>
				</div>
				<div class="offer-time-box">
					<span class="text-center offer-time">
						<span class="title offer-time-title" id="hours"></span>
						<span><br>Horas</span>
					</span>
				</div>
				<div class="offer-time-box">
					<span class="text-center offer-time">
						<span class="title offer-time-title" id="minutes"></span>
						<span><br>Mins</span>
					</span>
				</div>
				<div class="offer-time-box">
					<span class="text-center offer-time">
						<span class="title offer-time-title" id="seconds"></span>
						<span><br>Segs</span>
					</span>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-9">
			<div style="text-align: center; background-color: #E5E5E5; height: 300px; border: 2px solid #E5E5E5;">
				<img class="offer-img" src="https://via.placeholder.com/400x400/FFFFFF/CCCCCC" alt="producto">
			</div>
		</div>
		<div class="col-md-7 col-12 mt-4 mt-sm-0 mt-md-0 mt-lg-0">
			<div class="offer-info">
				<h3 class="title">{{ $unique->product->name }}</h3>
				<p>{{ $unique->product->description }}</p>
				<div style="display: none;" data-countdown="{{ $unique->final_date }}"></div>
				<div class="stars">
					<p>
					<span class="material-icons" style="vertical-align: middle; line-height: 24px;">star</span>
					<span class="material-icons" style="vertical-align: middle; line-height: 24px;">star</span>
					<span class="material-icons" style="vertical-align: middle; line-height: 24px;">star</span>
					<span class="material-icons" style="vertical-align: middle; line-height: 24px;">star</span>
					<span class="material-icons" style="vertical-align: middle; line-height: 24px;">star</span>
					<span class="rating-number">(1)</span>
					</p>
				</div>
				<div class="offer-price">
					<h5><s>${{ $unique->product->price }}</s> <span class="offer-discount">${{ $unique->offer }}</span></h5>
				</div>
				<div class="btn btn-success offer-btn">AGREGAR AL CARRITO</div>
			</div>
		</div>
	</div>
	<div class="row bottom-30">
		<div class="col-md-12">
			<h3 class="title">Beneficios de comprar en ecommerce.com</h3>
		</div>
	</div>
	<div class="row bottom-30">
		<div class="col-md-3">
			<img class="w-100" style="border-radius: 50%;" src="https://via.placeholder.com/200x200" alt="producto">
			<p class="text-center">Comprá desde casa, nosotros te cuidamos</p>
		</div>
		<div class="col-md-3">
			<img class="w-100" style="border-radius: 50%;" src="https://via.placeholder.com/200x200" alt="producto">
			<p class="text-center">Rastreá tu pedido cuando quieras</p>
		</div>
		<div class="col-md-3">
			<img class="w-100" style="border-radius: 50%;" src="https://via.placeholder.com/200x200" alt="producto">
			<p class="text-center">Pagá de manera segura por MercadoPago</p>
		</div>
		<div class="col-md-3">
			<img class="w-100" style="border-radius: 50%;" src="https://via.placeholder.com/200x200" alt="producto">
			<p class="text-center">Envios gratis dentro de Pergamino</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3 class="title">Los productos mas visitados</h3>
		</div>
	</div>
	<div class="row bottom-30">
		@foreach($most_visited as $product)
		<div class="col-md-3 col-6 product">
			<a href="{{ route('product.show', ['slug' => $product->slug, 'category' => $product->category->slug]) }}" class="product-link" style="color: inherit;">
			<img class="product-img" src="https://via.placeholder.com/400x400" alt="producto">
			<h6 style="margin-top: 7px;"><strong>{{ $product->name }}</strong></h6>
			<h6 class="product-description">{{ $product->description }}</h6>
			@if ($product->offer_boolean == 1)
			<h6><s>{{ $product->price }}</s> 
				<span class="principal-color">{{ isset($product->offer->price) ? $product->offer->price : 'NA'}}</span>
			</h6>
			@else
			<h6 class="principal-color">$345.67</h6>
			@endif
			</a>
		</div>
		@endforeach
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3 class="title">Tambien te podria interesar</h3>
		</div>
	</div>
	<div class="row">
		@foreach($most_visited as $product)
		<div class="col-md-3 col-6 product">
			<a href="{{ route('product.show', ['category' => $product->category->slug, 'slug' => $product->slug]) }}" class="product-link" style="color: inherit;">
			<img class="product-img" src="https://via.placeholder.com/400x400" alt="producto">
			<h6 style="margin-top: 7px;"><strong>{{ $product->name }}</strong></h6>
			<h6 class="product-description">{{ $product->description }}</h6>
			@if ($product->offer_boolean == 1)
			<h6><s>{{ $product->price }}</s> 
				<span class="principal-color">{{ isset($product->offer->price) ? $product->offer->price : 'NA'}}</span>
			</h6>
			@else
			<h6 class="principal-color">$345.67</h6>
			@endif
			</a>
		</div>
		@endforeach
	</div>
</div>

@include('includes.footer')

<script src="{{ asset('js/jquery.countdown.js') }}"></script>
<script type="text/javascript">
	$('[data-countdown]').each(function() {
      var $this = $(this);
      var finalDate = $(this).data('countdown');

      $this.countdown(finalDate, function(event) {
        console.log('strftime output:', event.strftime('%D days %H:%M:%S'));

        $("#days").html(event.strftime('%D'));
        $("#hours").html(event.strftime('%H'));
        $("#minutes").html(event.strftime('%M'));
       	$("#seconds").html(event.strftime('%S'));
        $this.html(event.strftime('%D days %H:%M:%S'));
      });
    });

</script>

<script src="https://www.mercadopago.com/v2/security.js" view="home"></script>
@endsection
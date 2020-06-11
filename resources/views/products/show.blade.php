@extends('includes.app')
	@section('nav')
		@extends('includes.nav')
	@endsection
@section('content')
<div class="container">
	<div class="row top-30 bottom-30">
		<div class="col-md-12">
			<h6 class="title">
				<a class="principal-color" href="{{ url('categorias/'.$category->slug) }}">{{ $category->name }}</a> >
				<a class="principal-color" href="{{ route('product.show', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">{{ $product->name }}</a></h6>
		</div>
	</div>
</div>
<div class="container">
	<div class="row bottom-30">
		<div class="col-md-4">
			<img class="product-img" src="https://via.placeholder.com/400x400" alt="producto">
		</div>
		<div class="col-md-6">
			<h6 style="color: #9C9C9C;">123 vendidos</h6>
			<h3>{{ $product->name }}</h3>
			<div class="stars">
					<span class="material-icons">grade</span>
					<span class="material-icons">grade</span>
					<span class="material-icons">grade</span>
					<span class="material-icons">grade</span>
					<span class="material-icons">grade</span>
				</div>
			<h6>{{ $product->description }}</h6>
			@if ($product->offer_boolean == 1)
			<h4><s>{{ $product->price }}</s> 
				<span style="color: #2297AB; font-size: 30px;">{{ isset($product->offer->price) ? $product->offer->price : 'NA'}}</span>
			</h4>
			@else
			<h3 style="color: #2297AB;">${{ $product->price }}</h3>
			@endif
			<form action="{{ url('/agregar/'.$product->id) }}"
				method="GET">
			<p class="product-quantity">Cantidad:</p>
			<select name="quantity" class="form-control scrollable-menu" style="width: 110px; padding: 5px; margin-bottom: 15px">
      			<option value="1" selected="">1 unidad</option>
      			<option value="2">2 unidades</option>
      			<option value="3">3 unidades</option>
      			<option value="4">4 unidades</option>
      			<option value="5">5 unidades</option>
      			<option value="6">6 unidades</option>
      			<option value="7">7 unidades</option>
      			<option value="8">8 unidades</option>
      			<option value="9">9 unidades</option>
      			<option value="10">10 unidades</option>
      			<option value="11">11 unidades</option>
      			<option value="12">12 unidades</option>
      			<option value="13">13 unidades</option>
      			<option value="14">14 unidades</option>
      			<option value="15">15 unidades</option>
      			<option value="16">16 unidades</option>
      			<option value="17">17 unidades</option>
      			<option value="18">18 unidades</option>
      			<option value="19">19 unidades</option>
      			<option value="20">20 unidades</option>
    		</select>
			<button type="submit" class="btn principal-btn offer-btn">AGREGAR AL CARRITO</button>
			</form>
		</div>
	</div>
	<div class="row bottom-30">
		<div class="col-md-12">
			<h3 class="title">Otros productos que podrian interesarte</h3>
		</div>
	</div>
	<div class="row">
		@foreach($interests as $product)
		<div class="col-md-3 col-6 product">
			<a href="{{ route('product.show', ['category' => $product->category->slug, 'slug' => $product->slug]) }}" class="product-link" style="color: inherit;">
			<img class="product-img" src="https://via.placeholder.com/400x400" alt="producto">
			<h6 style="margin-top: 7px;"><strong>{{ $product->name }}</strong></h6>
			<h6 class="product-description">{{ $product->description }}</h6>
			@if ($product->offer_boolean == 1)
			<h6><s>{{ $product->price }}</s> 
				<span style="color: #7494E8;">{{ isset($product->offer->price) ? $product->offer->price : 'NA'}}</span>
			</h6>
			@else
			<h6 style="color: #7494E8;">$345.67</h6>
			@endif
			</a>
		</div>
		@endforeach
	</div>
</div>
@include('includes.footer')

<script src="https://www.mercadopago.com/v2/security.js" view="item"></script>
@endsection
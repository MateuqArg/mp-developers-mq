@extends('includes.app')
	@section('nav')
		@extends('includes.nav')
	@endsection

@section('content')
<div class="container">
	<div class="row top-30 bottom-30">
		<div class="col-md-12">
			<h3 class="title">{{ $category->name }}</h3>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		@foreach($products as $product)
		<div class="col-md-3 col-6 product">
			<a href="{{ route('product.show', [$product->category->slug, $product->slug]) }}" class="product-link" style="color: inherit;">
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

<script src="https://www.mercadopago.com/v2/security.js" view="search"></script>
@endsection
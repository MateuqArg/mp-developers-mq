@extends('includes.app')
	@section('nav')
		@extends('includes.nav')
	@endsection

@section('content')

<div class="container" style="min-height: 100%;">
  <div style="padding-top: 80px;"></div>
	<div class="row">
    <div class="col-md-7">
    	<p>payment_method_id: {{ $request->payment_type }}</p>
      <p>external_reference: {{ $request->external_reference }}</p>
      <p>collection_id: {{ $request->collection_id }}</p>
    </div>
	</div>
</div>
@include('includes.footer')

<script src="https://www.mercadopago.com/v2/security.js" view=""></script>
@endsection
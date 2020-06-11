@extends('includes.app')
	@section('nav')
		@extends('includes.nav')
	@endsection

@section('content')
<style>	
.form-control::-webkit-input-placeholder { color: white; }  /* WebKit, Blink, Edge */
.form-control:-moz-placeholder { color: white; }  /* Mozilla Firefox 4 to 18 */
.form-control::-moz-placeholder { color: white; }  /* Mozilla Firefox 19+ */
.form-control:-ms-input-placeholder { color: white; }  /* Internet Explorer 10-11 */
.form-control::-ms-input-placeholder { color: white; }  /* Microsoft Edge */
body {
  background-color: #fff;
}
</style>

<?php $total = 0 ?>

<div class="container" style="min-height: 100%;">
  <div style="padding-top: 80px;"></div>
	<div class="row">
    <div class="col-md-7">
    	@if ($count_cart == 1)
      <h6 style="background-color: #EBEBEB; padding: 10px; margin-bottom: 0px;">TU CARRITO <small>Tienes {{ $count_cart }} producto</small></h6>
      	@else
      <h6 style="background-color: #EBEBEB; padding: 10px; margin-bottom: 0px;">TU CARRITO <small>Tienes {{ $count_cart }} productos</small></h6>
      	@endif
      <table class="table table-bordered">
        <tbody>
          @if ($cart)
          @foreach ($cart->products as $product)
          @if($product->offer_boolean == 0)
              <?php $total += $product->price * $product->pivot->quantity ?>
          @else
              <?php $total += $product->offer->price * $product->pivot->quantity ?>
          @endif
          <tr>
            <td style="border-right: none;">
                <img style="height: 120px; width: 120px;" src="{{ asset('/images/'.$product->image) }}">
            </td>
            <td style="border-left: none; vertical-align: middle;">
                <h6><strong>{{ $product->name }}</strong></h6>
               <p>Cantidad: {{ $product->pivot->quantity }}<br>
            </td>
            <td style="vertical-align: middle; text-align: center;">
              @if($product->offer_boolean == 0)
              ${{ $product->price }} AR$
              @else
              ${{ $product->offer->price }} AR$
              @endif
            </td>
          </tr>
          @endforeach
        @else
        <h5 style="text-align: center;">Su carrito esta vacio, ¡Animate a comprar!</h5>
        @endif
        </tbody>
      </table>
    </div>
    <div class="col-md-5">
      <div class="order-pay">
          <h6>RESUMEN DEL PEDIDO</h6>
          <div style="background-color: #fff; padding: 10px;">
        @if ($count_cart == 1)
          <p style="font-size: 14px;">
          {{ $count_cart }} PRODUCTO <br>
          </p>
      	@else
          <p style="font-size: 14px;">
          {{ $count_cart }} PRODUCTOS <br>
          </p>
      	@endif
      <hr>
      {{-- <p style="font-size: 14px;">
      ENVIO: <small style="color: #606060;">Se calculará en el siguiente paso</small>
      </p> --}}
        {{-- <form action="{{ url('/pay') }}" method="GET">
        <label for="shipping" style="font-size: 14px;">Pon tu codigo postal para calcular el envio</label>
        <input type="text" name="shipping" class="form-control" required="" style="text-align: center;">
      <hr>
        <input class="form-check-input" type="radio" name="shipping">
        <label class="form-check-label" for="exampleRadios1">
          Envio a sucursal: <span>$250</span>
        </label>
          <br>
        <input class="form-check-input" type="radio" name="shipping">
        <label class="form-check-label" for="exampleRadios1">
          Envio a domicilio: <span>$300</span>
        </label>
      <hr> --}}
        <h6>SUBTOTAL: <span style="color: #B12704;">${{ $total }} AR$</span></h6>
        {{-- <button type="submit" class="btn order-pay-btn">CONTINUAR</button> --}}
        <a href="{{ url('/pay') }}" class="btn order-pay-btn">Pagar la compra</a>
        </form>
      </div>
    </div>
	</div>
</div>
</div>
@include('includes.footer')

<script src="https://www.mercadopago.com/v2/security.js" view=""></script>
@endsection
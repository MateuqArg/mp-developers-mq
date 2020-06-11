<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Cart;
use App\User;
use GuzzleHttp\Client;

class CartController extends Controller
{
   	public function index()
    {
    	if (session('cart')) {
			$cart = session('cart')->fresh();
    	} else {
    		$cart = null;
    	}

    	$total = 0;

      if (session('cart')) {
    	 foreach ($cart->products as $product) {
    		  $total = $total + $product->price * $product->pivot->quantity; 
    	 }
      }

//       if (auth()->user()) {

//       $user = User::find(auth()->user()->id);

//       $client = new Client();

// //       $credentials = base64_encode('Prueba:Matute8Arg');
// // dd($credentials);
// //       $url = "https://api.qa.andreani.com/login";

// //       $response = $client->request('GET', $url, [
// //         'headers' => ['Authorization' => 'Basic '.$credentials
// //         ]
// //       ]);

// //       $x-auth = json_decode($response->getBody()->getContents());

//       $url = "https://api.qa.andreani.com/v1/tarifas";

//       $data = [
//         "pais" => "Argentina",
//         "cpDestino" => $user->address,
//         "contrato" => "400006711",
//         "cliente" => "CL0003750",
//         "sucursalOrigen" => "PER",
//         "bultos" => array(array('valorDeclarado' => "2000",
//                 "volumen" => "125000",
//                 "kilos" => "2"
//       ))
//       ];

//       $response = $client->request('GET', $url.'?'.http_build_query($data));

//       $body = $response->getBody();
      // dd(json_decode($response->getBody(), true));
      // }

        return view('cart.index')->with('cart', $cart);
    }

    public function addProduct(Request $request, $id)
    {
    	$product = Product::findOrFail($id);

    	if (!$product)
    	{
            abort(404);
        }

        $cart = session('cart') ?? Cart::create();

        // Si el carrito existe checkea si el producto esta agregado, si lo está se incrementa la cantidad

        if (!empty($cart->products[0]->id))
        {
        	// dd($cart->products);
        	if(end($cart->products)[0]->id == $id)
        	{
        		end($cart->products)[0]->pivot->update([
            	'quantity' => $cart->products[0]->pivot->quantity + $request->quantity
        		]);

        		session()->put('cart', $cart);

        		return redirect()->route('cart')->with('success', '¡Producto agregado al carrito correctamente!');
    		}
    	}


       	// Si el producto no está en el carrito se agrega
       	$cart = session('cart') ?? Cart::create();

      	$cart->products()->attach($id, ['quantity' => $request->quantity]);

      	session()->push('cart.products', $product);
// dd($cart->products);

		session()->put('cart', $cart);
 
       	return redirect()->route('cart')->with('success', '¡Producto agregado al carrito correctamente!');
	}

	public function pay(Request $request) 
    {
        // $cart = session('cart')->fresh();

        \MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

        \MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

        $preference = new \MercadoPago\Preference();

        $productos = [];
        $payer = [];

        // foreach ($cart as $product) {
        //     $item = new \MercadoPago\Item();
        //     $item->id = $product->id;
        //     $item->title = $product->name;
        //     $item->quantity = $product->pivot->quantity;
        //     $item->currency_id = 'ARS';
        //     $item->unit_price = $product->price;
        //     $item->picture_url = 'https://via.placeholder.com/200x200';
        //     $item->category_id = $product->category_id;
        //     $item->description = $product->description;
        //     $item->picture_url = $product->picture_url;
        //     $productos[] = $item;
        // }

        $item = new \MercadoPago\Item();
        $item->id = '1234';
        $item->title = "Nombre del producto seleccionado del carrito del ejercicio.";
        $item->quantity = 1;
        $item->currency_id = 'ARS';
        $item->unit_price = 123;
        $item->picture_url = 'Foto del producto seleccionado.';
        $item->description = '“Dispositivo móvil de Tienda e-commerce”';
        $productos[] = $item;

        $preference->items = $productos;

        $payer = new \MercadoPago\Payer();
  		$payer->email = "test_user_63274575@testuser.com";
        $payer->name = "Lalo";
        $payer->surname = "Landa";
        $payer->phone = array('area_code' => '11', 
          'number' => '22223333' );
        $payer->address = array('street_name' => 'False', 'street_number' => 123, 'zip_code' => "1111");


  		  $preference->payer = $payer;

        $preference->back_urls = [
            'success' => url('/success'),
            'failure' => url('/failure'),
            'pending' => url('/pending'),
        ];

        $preference->installments = 1;

        $preference->external_reference = "mateuqarg@gmail.com";

        $preference->auto_return = "approved";

        $preference->notification_url = url('/notifications');
        
        $preference->save();


        return redirect($preference->init_point);
    }

    public function notifications(Request $request) 
    {
      return header("HTTP/1.1 200 OK");
      return \Response::json(['HTTP/1.1 200 OK'], 200);
    }

   	public function createOrder(Request $request, $customid)
   	{
        $email = session()->get('email');
        $cart = session()->get('cart');

   		$order = Order::create([
   			// 'orderimgs' => implode('*', $customids),
      //       'customid' => $customid,
   			// 'email' => $email,
      //       'status' => 'Pagado'
   		]);

        $data = array('email' => $email,'customid' => $customid);

    	Mail::send('emails.order', $data, function ($message) use ($data){

        	$message->subject('Tu pedido en ecommerce');

        	$message->to($data['email']);

    	});


        return redirect()->route('thanks', $customid)->with('customid', $customid);
   	}

    public function success(Request $request)
    {
        dd($request);

        return view('success');
    }

    public function thanks(Request $request, $customid)
    {
        return view('thanks', compact('customid'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\Carrito;
use App\Models\Producto;
use Carbon\Carbon;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Config\Configuration;
use Illuminate\Support\Facades\Auth;
 use MercadoPago\Exceptions\MPApiException;
    use MercadoPago\Resources\Preference;
    use MercadoPago\MercadoPagoConfig;



class PagoController extends Controller
{
  


   
    public function crearPreferencia(Request $request)
{
    try {
       
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.secret_key'));

       
        $direccion = $request->input('direccion');
$request->session()->put('direccion_envio', $direccion);

        $user = Auth::user();

        $client = new PreferenceClient();
        $preference = $client->create([
            'items' => [
                [
                    'id' => '1234',
                    'title' => 'Mi producto',
                    'quantity' => 1,
                    'unit_price' => (float) $request->input('total'),
                ],
            ],
            'back_urls' => [
                'success' => env('MP_SUCCESS_URL'),
    'failure' => env('MP_FAILURE_URL'),
    'pending' => env('MP_PENDING_URL'),
        
    ],
    'auto_return' => 'approved',
            'statement_descriptor' => 'Mi tienda',
            'external_reference' => 'orden_1234',
        ]);

        return redirect()->away($preference->init_point);

    } catch (MPApiException $e) {
        return response()->json([
            'error' => 'API Error',
            'message' => $e->getApiResponse()->getContent(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'General Error',
            'message' => $e->getMessage(),
        ]);
    }
}



public function pagoExitoso()
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    $userId = Auth::user()->id;
    $allCarrito = Carrito::where('user_id', $userId)->get();
    $fechaOrden = now();

    foreach ($allCarrito as $carrito) {
        $producto = Producto::find($carrito->producto_id);
        if (!$producto) continue;

        $order = new Orden;
        $order->producto_id = $producto->id;
        $order->user_id = $userId;
        $order->metodo_pago = 'Mercado Pago'; // o el valor que prefieras
        $order->estado_pago = 'Aprobado';
        $order->estado = 'En proceso'; // o como desees iniciar
        $direccion = session('direccion_envio', 'No especificada');
$order->direccion = $direccion;

        
        $order->precio = $producto->precio * $carrito->cantidad;
        $order->cantidad = $carrito->cantidad;
        $order->created_at = $fechaOrden;
        $order->updated_at = $fechaOrden;
        $order->save();

    }

    // Limpia el carrito
    

    Carrito::where('user_id', $userId)->delete();
    return redirect('/mis_ordenes')->with('success', '¡Compra realizada con éxito!');

    #return redirect('/mis_ordenes'); // Ya funciona esta vista según dijiste
}

public function pagoRechazado(Request $request)
{
    return view('pago.fallo');
}

public function pagoPendiente(Request $request)
{
    return view('pago.pendiente');
}



    public function procesarPago(Request $request)
    {
        $paymentClient = new PaymentClient();
        try {
            $payment = $paymentClient->create([
                "transaction_amount" => (float) $request->input('amount'),
                "token" => $request->input('token'),
                "description" => "Pago de la compra",
                "installments" => (int) $request->input('installments'),
                "payment_method_id" => $request->input('payment_method_id'),
                "payer" => [
                    "email" => Auth::user()->email ?? 'guest@example.com',
                    "identification" => [
                        "type" => $request->input('docType'),
                        "number" => $request->input('docNumber'),
                    ],
                ],
            ]);

            return response()->json(['status' => $payment->status, 'id' => $payment->id, 'error' => $payment->error ?? null]);

        } catch (\MercadoPago\Exceptions\MPApiException $e) {
            return response()->json(['status' => 'error', 'error' => $e->getApiResponse()->getContent()]);
        }
    }

  

    
    public function mostrarInstruccionesTransferencia(Request $request)
{
    $total = $request->query('total');
    return view('pago.transferencia', ['total' => $total]);
}


}
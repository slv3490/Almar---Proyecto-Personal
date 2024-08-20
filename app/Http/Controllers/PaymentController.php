<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        if(Auth::user()->purchasedCourses->contains($request->course_id)) {
            return redirect()->route('cursos')->with('warning', 'El usuario ya posee este curso');
        }
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->course_price
                    ],
                    "description" => "Curso de CurOl",
                ]
            ],
            "application_context" => [
                "cancel_url" => route('payment.cancel'),
                "return_url" => route('payment.success'),
            ]
        ]);

        if (isset($order['id'])) {
            foreach ($order['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    session(["course_id" => $request->course_id]);
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->route('payment.cancel');
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);

        $response = $provider->capturePaymentOrder($request->query('token'));

        // Manejar la respuesta y actualizar el estado del curso
        if ($response['status'] === 'COMPLETED') {
            $courseId = Course::find(session("course_id"));
            // Procesa la venta y guarda la transacción
            Auth::user()->purchasedCourses()->attach($courseId);

            session()->forget("course_id");

            return redirect()->route('cursos')->with('success', 'Pago realizado correctamente');
        }

        return redirect()->route('cursos')->with('error', 'Error en el pago');
    }

    public function paymentCancel()
    {
        return redirect()->route('cursos')->with('error', 'El pago fue cancelado');
    }
}

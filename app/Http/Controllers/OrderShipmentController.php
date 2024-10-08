<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use App\Mail\OrderShipped;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\Log;

class OrderShipmentController extends Controller
{
    /**
     * Enviar el pedido dado.
     */
    public function store(Request $request, MyController $myController): RedirectResponse
    {
        #$user = User::findOrFail($request->user_id);
        $user = User::all();
        // Enviar el pedido...

        $subject = "Prueba de envío de correo desde Laravel";
        $body = "Prueba de envío de correo desde Laravel. Esto es el body del correo.";
        $to = "omarliberatto@yafoconsultora.com";

        try {
            // Llamar a enviar_email de MyController
            $myController->enviar_email($to, $body, $subject);
            Log::info('Correo enviado exitosamente a ' . $to);
        } catch (Exception $e) {
            // Manejo de la excepción
            Log::error('Error al enviar el correo: ' . $e->getMessage());

            // Puedes redirigir al usuario con un mensaje de error
            return redirect('/users')->with('error', 'Hubo un problema al enviar el correo. Por favor, intenta nuevamente.');
        }

/*         // Envío del correo utilizando Mailable
        try {
            Mail::to("omarliberatto@yafoconsultora.com")->send(new OrderShipped($user));
            Log::info('Correo Mailable enviado exitosamente a omarliberatto@yafoconsultora.com');
        } catch (Exception $e) {
            // Manejo de la excepción al enviar con Mailable
            Log::error('Error al enviar el correo con Mailable: ' . $e->getMessage());

            // Redirigir con mensaje de error
            return redirect('/users')->with('error', 'No se pudo enviar el correo Mailable. Inténtalo de nuevo.');
        }
 */
        return redirect('/users')->with('success', 'Correo enviado correctamente.');
    }
}

/* 
use Illuminate\Support\Facades\Mail;

Mail::raw('Prueba de envío de correo desde Laravel', function ($message) {
    $message->to('destinatario@ejemplo.com')
            ->subject('Correo de Prueba');
});
*/
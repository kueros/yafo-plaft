<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\LogAcceso;
use App\Http\Requests\LogAccesoRequest;
use App\Models\LogAdministracion;


class MonitoreoController extends Controller
{
	/**
	 * Muestro la vista de monitoreo.
	 */
    public function index()
    {
        return view('monitoreo.index');
    }

	/**
	 * Muestro la vista de logs de accesos.
	 */
	public function log_accesos(Request $request): View
	{
		$logs_accesos = LogAcceso::paginate();
		#dd($logs_accesos);
		return view('monitoreo.logs_accesos', compact('logs_accesos'))
			->with('i', ($request->input('page', 1) - 1) * $logs_accesos->perPage());
	}


	/**
	 * Muestro la vista de logs de accesos.
	 */
	public function log_administracion(Request $request): View
	{
		$logs_administracion = LogAdministracion::paginate();
		#dd($logs_administracion);
		return view('monitoreo.logs_administracion', compact('logs_administracion'))
			->with('i', ($request->input('page', 1) - 1) * $logs_administracion->perPage());
	}
}

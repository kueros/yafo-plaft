<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RolController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request): View
	{
		$roles = Rol::paginate();
		#dd($roles);
		return view('rol.index', compact('roles'))
			->with('i', ($request->input('page', 1) - 1) * $roles->perPage());
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(): View
	{
		$roles = new Rol();

		return view('rol.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store()
	{
		#dd($_POST);

		Rol::create($_POST);

		return Redirect::route('roles.index')
			->with('success', 'Rol created successfully.');
	}

	/**
	 * Display the specified resource.
	 */
	public function show($id): View
	{
		$role = Rol::find($id);

		return view('rol.show', compact('role'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit($id): View
	{
		$roles = Rol::find($id);

		return view('rol.edit', compact('roles'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	#	public function update($request) //UserRequest $request, User $user): RedirectResponse
	public function update(Request $request, Rol $rol): RedirectResponse
	{
		#dd($request->all());
		$rol->update($request->all());

		return Redirect::route('roles.index')
			->with('success', 'Rol updated successfully');
	}

	public function destroy($id): RedirectResponse
	{
		Rol::find($id)->delete();

		return Redirect::route('roles.index')
			->with('success', 'Rol deleted successfully');
	}
}

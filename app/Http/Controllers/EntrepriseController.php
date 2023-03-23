<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntrepriseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Entreprise $entreprise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntrepriseRequest $request, Entreprise $entreprise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entreprise $entreprise)
    {
        //
    }
}

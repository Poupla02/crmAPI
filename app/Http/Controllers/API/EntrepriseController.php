<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use App\Models\Entreprise;
use Illuminate\Http\JsonResponse;

class EntrepriseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entreprises = Entreprise::all();
        return response()->json([
            'message' => 'Entreprise créée avec succès.',
            'entreprise' => $entreprises
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntrepriseRequest $request): JsonResponse
    {
        $entreprise = Entreprise::create($request->validated());
        return response()->json([
            'message' => 'entreprise créée avec succès.',
            'entreprise' => $entreprise
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Entreprise $entreprise): JsonResponse
    {
        return response()->json([
            'message' => 'Succès.',
            'entreprise' => $entreprise
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntrepriseRequest $request, Entreprise $entreprise): JsonResponse
    {
        $entreprise = $entreprise->update($request->validated());
        return response()->json([
            'message' => 'Entreprise modifier avec succès.',
            'entreprise' => $entreprise
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entreprise $entreprise): JsonResponse
    {
        $entreprise = $entreprise->delete();
        return response()->json([
            'message' => 'Succès.',
            'entreprise' => $entreprise
        ], 200);
    }
}

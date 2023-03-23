<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use App\Http\Resources\API\ApiResource;
use App\Models\Entreprise;
use Illuminate\Http\JsonResponse;
use PHPUnit\Exception;

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
        try {
            $entreprise = Entreprise::create($request->validated());
            return response()->json([
                'message' => 'entreprise créée avec succès.',
                'entreprise' => $entreprise
            ], 201);
        }catch (Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Entreprise $entreprise): JsonResponse
    {
        try{
            return response()->json([
                'message' => 'Succès.',
                'entreprise' => new ApiResource($entreprise)
            ], 200);

        }catch (Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntrepriseRequest $request, Entreprise $entreprise): JsonResponse
    {
        try {
            $entreprise->update($request->validated());
            return response()->json([
                'message' => 'Entreprise modifier avec succès.',
                'entreprise' => new ApiResource($entreprise)
            ], 200);
        }catch (Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entreprise $entreprise): JsonResponse
    {
        $entreprise->delete();
        return response()->json([
            'message' => 'Succès.',
            'entreprise' => new ApiResource($entreprise)
        ], 200);
    }
}

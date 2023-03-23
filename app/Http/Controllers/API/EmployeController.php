<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use App\Models\Employe;
use Illuminate\Http\JsonResponse;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employes = Employe::all();
        return response()->json([
            'message' => 'Entreprise créée avec succès.',
            'employes' => $employes
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeRequest $request): JsonResponse
    {
        $telephone = $request->input('telephone');
        if ($telephone == null){
            $employe = Employe::create($request->validated());
            return response()->json([
                'message' => 'Employe créée avec succès.',
                'employe' => $employe
            ], 201);
        }
        if (!$this->validatePhoneNumber($telephone))
        {
            return response()->json([
                'status' => 'error',
                'message' => "le numero de téléphone est incorrect",
            ]);
        }
        $employe = Employe::create($request->validated());
        return response()->json([
            'message' => 'Employe créée avec succès.',
            'employe' => $employe
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employe $employe)
    {
        return response()->json([
            'message' => 'Succès.',
            'employe' => $employe
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeRequest $request, Employe $employe)
    {
        $employe = $employe->update($request->validated());
        return response()->json([
            'message' => 'Entreprise modifier avec succès.',
            'entreprise' => $employe
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employe $employe)
    {
        $employe = $employe->delete();
        return response()->json([
            'message' => 'Succès.',
            'entreprise' => $employe
        ], 200);
    }

    /**
     * @param $telephone
     * @return bool
     */
    public function validatePhoneNumber($telephone): bool
    {
        // format regex
        $regrexFormat = [
            '/^([+][2][2][6]) [0|5-7][4-7][0-9]{6}$/', //orange
            '/^([+][2][2][6]) [0|5-7][0-3][0-9]{6}$/', //moov
            '/^([+][2][2][6]) (58|68|69|78|79)[0-9]{6}$/' //telecel
        ];
        // On parcour le tableau pour verifier si le numéro avec le format du regex
        foreach ($regrexFormat as $format)
        {
            if (preg_match($format, $telephone))
            {
                return true;
            }
        }
        return false;
    }
}

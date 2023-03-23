<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use App\Http\Resources\API\ApiResource;
use App\Models\Employe;
use Illuminate\Http\JsonResponse;
use PHPUnit\Exception;

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
        try {

            $telephone = $request->input('telephone');
            if ($telephone == null) {
                $employe = Employe::create($request->validated());
                return response()->json([
                    'message' => 'Employe créée avec succès.',
                    'employe' => $employe
                ], 201);
            }
            if (!$this->validatePhoneNumber($telephone)) {
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
        }catch (Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employe $employe)
    {
        try {
            return response()->json([
                'message' => 'Succès.',
                'employe' => new ApiResource($employe)
            ], 200);
        }catch (Exception $exception)
        {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeRequest $request, Employe $employe)
    {
        try {
            //on recupère la valeur telephone dans le input
            $telephone = $request->input('telephone');
            // s'il n'y a pas de téléphone on enregistre
            if ($telephone == null) {
                $employe->update($request->validated());
                return response()->json([
                    'message' => 'Employe créée avec succès.',
                    'employe' => new ApiResource($employe)
                ], 201);
            }
            // dans le cas contraire on vérifie le format du numéro de téléphone si ok on enregistre.
            if (!$this->validatePhoneNumber($telephone)) {
                return response()->json([
                    'status' => 'error',
                    'message' => "le numero de téléphone est incorrect",
                ]);
            }
            $employe->update($request->validated());
            //on retourne le message et l'objet modifier
            return response()->json([
                'message' => 'Entreprise modifier avec succès.',
                'entreprise' => new ApiResource($employe)
            ], 200);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employe $employe): JsonResponse
    {
        $employe->delete();
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
        // On parcours le tableau pour verifier si le numéro avec le format du regex
        foreach ($regrexFormat as $format)
        {
            if (preg_match($format, $telephone))
            {
                return true; // retourne vrai s'il trouve une correspondance.
            }
        }
        return false; //retourne false s'il ne trouve pas.
    }
}

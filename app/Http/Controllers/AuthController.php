<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;
use Validator;

class AuthController extends Controller
{
    /**
     * Authentification nécessaire pour accéder à cette route sauf pour la route login et register
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // En cas d'échec retourné erreur en json et son code d'erreur
        if ($validator->fails())
        {
            return response()->json($validator->errors()->toJson(), 400);
        }
        // si la validation est ok on crée la user
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        // retourne le message de succès avec le user qui a été créé
        return response()->json([
            'message' => 'Utilisateur enregistrer avec succès.',
            'user' => $user
        ], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // En cas d'échec retourné erreur en json et son code d'erreur
        if ($validator->fails())
        {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated()) )
        {
            return response()->json(['error' => 'Inautorisé'], 401);
        }
        return $this->createNewToken($token);
    }

    /**
     * @param $token
     * @return JsonResponse
     */
    public function createNewToken($token): JsonResponse
    {
        return response()->json([
            'user' => auth()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() *60,
            'access_token' => $token
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function profile(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json([
            'message' => 'Utilisateur déconnecté.',
        ]);
    }
}

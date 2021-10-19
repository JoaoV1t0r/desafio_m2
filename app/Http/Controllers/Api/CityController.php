<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => 'Busca realizada com sucesso.',
            'data' => City::all()
        ];

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //VALIDATING OF PARAMETERS
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', Rule::unique('cities', 'name')],
        ]);

        if ($validated->fails()) :
            $content = array(
                'success' => false,
                'message' => "Erro no nome da cidade",
                'errors' => $validated->errors()
            );
            return response($content)->setStatusCode(400);
        endif;

        City::create(['name' => $request->get('name')]);

        //RETURN SUCCESS
        $content = array(
            'success' => true,
            'message' => "Cidade adicionada com sucesso."
        );

        return response($content)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param City $city
     * @return JsonResponse
     */
    public function show(City $city): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => 'Busca realizada com sucesso.',
            'data' => $city
        ];
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param City $city
     * @return Response
     */
    public function update(Request $request, City $city): Response
    {
        //VALIDATING OF PARAMETERS
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', "unique:cities,name,{$city->name}"],
        ]);

        if ($validated->fails()) :
            $content = array(
                'success' => false,
                'message' => "Erro no nome da cidade",
                'errors' => $validated->errors()
            );
            return response($content)->setStatusCode(400);
        endif;

        $city->name = $request->get("name");
        $city->update();

        //RETURN SUCCESS
        $content = array(
            'success' => true,
            'message' => "Cidade Atualizada com sucesso."
        );

        return response($content)->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return JsonResponse
     */
    public function destroy(City $city): JsonResponse
    {
        $city->delete();
        return response()->json([], 204);
    }
}

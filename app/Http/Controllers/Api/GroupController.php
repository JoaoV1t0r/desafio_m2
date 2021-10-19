<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GroupController extends Controller
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
            'data' => Group::all()
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
            'name' => ['required', 'string', 'max:255', Rule::unique('groups', 'name')],
        ]);

        if ($validated->fails()) :
            $content = array(
                'success' => false,
                'message' => "Erro no nome do grupo",
                'errors' => $validated->errors()
            );
            return response($content)->setStatusCode(400);
        endif;

        Group::create(['name' => $request->get('name')]);

        //RETURN SUCCESS
        $content = array(
            'success' => true,
            'message' => "Grupo adicionada com sucesso."
        );

        return response($content)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Group $group
     * @return JsonResponse
     */
    public function show(Group $group): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => 'Busca realizada com sucesso.',
            'data' => $group
        ];
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Group $group
     * @return Response
     */
    public function update(Request $request, Group $group): Response
    {
        //VALIDATING OF PARAMETERS
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', "unique:groups,name,{$group->name}"],
        ]);

        if ($validated->fails()) :
            $content = array(
                'success' => false,
                'message' => "Erro no nome do grupo",
                'errors' => $validated->errors()
            );
            return response($content)->setStatusCode(400);
        endif;

        $group->name = $request->get("name");
        $group->update();

        //RETURN SUCCESS
        $content = array(
            'success' => true,
            'message' => "Grupo Atualizada com sucesso."
        );

        return response($content)->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Group $group
     * @return JsonResponse
     */
    public function destroy(Group $group): JsonResponse
    {
        $group->delete();
        return response()->json([], 204);
    }
}

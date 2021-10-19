<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
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
            'data' => Campaign::all()
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
            'name' => ['required', 'string', 'max:255', "unique:products,name"],
            'discount' => ['required', 'numeric'],
        ]);

        if ($validated->fails()) :
            $content = array(
                'success' => false,
                'message' => "Erro nos dados da campanha",
                'errors' => $validated->errors()
            );
            return response($content)->setStatusCode(400);
        endif;

        Campaign::create([
            'name' => $request->get('name'),
            'discount' => $request->get('discount')
        ]);

        //RETURN SUCCESS
        $content = array(
            'success' => true,
            'message' => "Campanha criado com sucesso."
        );

        return response($content)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function show(Campaign $campaign): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => 'Busca realizada com sucesso.',
            'data' => $campaign
        ];
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return Response
     */
    public function update(Request $request, Campaign $campaign): Response
    {
        //VALIDATING OF PARAMETERS
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', "unique:products,name,{$campaign->name}"],
            'discount' => ['required', 'numeric'],
        ]);

        if ($validated->fails()) :
            $content = array(
                'success' => false,
                'message' => "Erro nos dados da campanha",
                'errors' => $validated->errors()
            );
            return response($content)->setStatusCode(400);
        endif;

        $campaign->name = $request->get('name') ?? $campaign->name;
        $campaign->discount = $request->get('discount') ?? $campaign->discount;
        $campaign->update();

        //RETURN SUCCESS
        $content = array(
            'success' => true,
            'message' => "Campanha atualizada com sucesso."
        );

        return response($content)->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return response()->json([], 204);
    }
}

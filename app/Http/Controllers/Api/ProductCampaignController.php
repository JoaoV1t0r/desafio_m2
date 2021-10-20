<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCampaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductCampaignController extends Controller
{
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
            'product_id' => ['required', 'numeric', Rule::unique('products', 'name')],
            'campaign_id' => ['required', 'numeric', Rule::exists('campaigns', 'id')]
        ]);

        if ($validated->fails()) :
            $content = array(
                'success' => false,
                'message' => "Erro ao adicionar o produto á campanha.",
                'errors' => $validated->errors()
            );
            return response($content)->setStatusCode(400);
        endif;

        ProductCampaign::create(['product_id' => $request->get('product_id'), 'campaign_id' => $request->get('campaign_id')]);

        //RETURN SUCCESS
        $content = array(
            'success' => true,
            'message' => "Produto adicionado á campanha."
        );

        return response($content)->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProductCampaign $productCampaign
     * @return JsonResponse
     */
    public function destroy(ProductCampaign $productCampaign): JsonResponse
    {
        $productCampaign->delete();
        return response()->json([], 204);
    }
}

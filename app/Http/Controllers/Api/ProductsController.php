<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
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
            'data' => Product::with('campaigns')->get()
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
            'value' => ['required', 'numeric'],
        ]);

        if ($validated->fails()) :
            $content = array(
                'success' => false,
                'message' => "Erro nos dados do produto",
                'errors' => $validated->errors()
            );
            return response($content)->setStatusCode(400);
        endif;

        Product::create([
            'name' => $request->get('name'),
            'value' => $request->get('value')
        ]);

        //RETURN SUCCESS
        $content = array(
            'success' => true,
            'message' => "Produto criado com sucesso."
        );

        return response($content)->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $products
     * @return JsonResponse
     */
    public function show(Product $products): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => 'Busca realizada com sucesso.',
            'data' => $products
        ];
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $products
     * @return Response
     */
    public function update(Request $request, Product $products): Response
    {
        //VALIDATING OF PARAMETERS
        $validated = Validator::make($request->all(), [
            'name' => [ 'string', 'max:255', "unique:products,name,{$products->name}"],
            'value' => [ 'numeric'],
        ]);

        if ($validated->fails()) :
            $content = array(
                'success' => false,
                'message' => "Erro nos dados do produto",
                'errors' => $validated->errors()
            );
            return response($content)->setStatusCode(400);
        endif;

        $products->name = $request->get('name') ?? $products->name;
        $products->value = $request->get('value') ?? $products->value;
        $products->update();

        //RETURN SUCCESS
        $content = array(
            'success' => true,
            'message' => "Produto atualizado com sucesso."
        );

        return response($content)->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $products
     * @return JsonResponse
     */
    public function destroy(Product $products): JsonResponse
    {
        $products->delete();
        return response()->json([], 204);
    }
}

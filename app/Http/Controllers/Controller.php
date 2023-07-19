<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{

    public function index(): JsonResponse
    {
        $products = Product::get();
        if ($products->isEmpty()) {
            return response()->json([], 204);
        }

        return response()->json($products, 200);
    }

    public function store(Request $request): JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return response()->json(['message' => 'Registrado com sucesso!'], 200);
    }


    public function show(int $id): JsonResponse
    {
        return response()->json(Product::findOrFail($id), 200);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return response()->json(['message' => 'Registro atualizado com sucesso'], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message' => 'Registro excluído com sucesso'], 200);
    }
}

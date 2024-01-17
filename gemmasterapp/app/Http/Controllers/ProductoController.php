<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    public function index(): JsonResponse
    {
        $productos = Producto::all();
        return response()->json($productos, 200);
    }

    public function show($id): JsonResponse
    {
        $producto = Producto::find($id);
        return response()->json($producto, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $response = ['status' => 'ok', 'data' => []];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'stock' => 'required|int',
            'id_categoria' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->errors()->first()], 400);
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'id_categoria' => $request->id_categoria,
        ]);

        $response['data'] = $producto;

        return response()->json($response, 200);
    }

    public function update($id, Request $request): JsonResponse
    {
        $response = ['status' => 'ok', 'data' => []];

        $validator = Validator::make($request->all(), [
            'id' => 'sometimes|int|exists:productos,id',
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'stock' => 'required|int',
            'id_categoria' => 'required|int',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->errors()->first()], 400);
        }

        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['status' => 'error', 'msg' => 'The product does not exist'], 400);
        }

        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->id_categoria = $request->id_categoria;
        $producto->save();

        $response['data'] = $producto;

        return response()->json($response, 200);
    }

    public function destroy($id): JsonResponse
    {
        $response = ['status' => 'ok'];

        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['status' => 'error', 'msg' => 'The product does not exist'], 400);
        }

        $producto->delete();

        return response()->json($response, 200);
    }
}

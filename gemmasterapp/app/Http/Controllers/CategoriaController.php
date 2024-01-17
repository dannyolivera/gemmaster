<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    public function index(): JsonResponse
    {
        $categorias = Categoria::all();
        return response()->json($categorias, 200);
    }

    public function show($id): JsonResponse
    {
        $categoria = Categoria::find($id);
        return response()->json($categoria, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $response = ['status' => 'ok', 'data' => []];

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->errors()->first()], 400);
        }

        $categoria = Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        $response['data'] = $categoria;

        return response()->json($response, 200);
    }

    public function update($id, Request $request): JsonResponse
    {
        $response = ['status' => 'ok', 'data' => []];

        $validator = Validator::make($request->all(), [
            'id' => 'sometimes|int|exists:categorias,id',
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'msg' => $validator->errors()->first()], 400);
        }

        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['status' => 'error', 'msg' => 'The category does not exist'], 400);
        }

        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->save();

        $response['data'] = $categoria;

        return response()->json($response, 200);
    }

    public function destroy($id): JsonResponse
    {
        $response = ['status' => 'ok'];

        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['status' => 'error', 'msg' => 'The category does not exist'], 400);
        }

        $categoria->delete();

        return response()->json($response, 200);
    }
}

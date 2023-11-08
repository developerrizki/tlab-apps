<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientsEditRequest;
use App\Http\Requests\IngredientsRequest;
use App\Models\Ingredients;
use Exception;
use Illuminate\Http\JsonResponse;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $ingredients = Ingredients::all();

            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $ingredients
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => config('app.env') === 'production'
                    ? 'Server Error'
                    : $e->getMessage()
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param IngredientsRequest $request
     * @return JsonResponse
     */
    public function store(IngredientsRequest $request): JsonResponse
    {
        try {
            $ingredients = $request->input('name');

            foreach ($ingredients as $item) {
                Ingredients::query()->create([
                    'recipe_id' => $request->input('recipe_id'),
                    'name' => $item
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Recipe has been created.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => config('app.env') === 'production'
                    ? 'Server Error'
                    : $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Ingredients $ingredients
     * @return JsonResponse
     */
    public function show(Ingredients $ingredients): JsonResponse
    {
        try {
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $ingredients
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => config('app.env') === 'production'
                    ? 'Server Error'
                    : $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     * @param IngredientsEditRequest $request
     * @param Ingredients $ingredients
     * @return JsonResponse
     */
    public function update(IngredientsEditRequest $request, Ingredients $ingredients): JsonResponse
    {
        try {
            $ingredients->update($request->validated());

            return response()->json([
                'status' => 200,
                'message' => 'Recipe has been edited.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => config('app.env') === 'production'
                    ? 'Server Error'
                    : $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ingredients $ingredients
     * @return JsonResponse
     */
    public function destroy(Ingredients $ingredients): JsonResponse
    {
        try {
            $ingredients->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Recipe has been edited.'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => config('app.env') === 'production'
                    ? 'Server Error'
                    : $e->getMessage()
            ]);
        }
    }
}

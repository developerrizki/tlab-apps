<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use Exception;
use Illuminate\Http\JsonResponse;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $receipts = Recipe::all();

            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $receipts
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
     * @param RecipeRequest $request
     * @return JsonResponse
     */
    public function store(RecipeRequest $request): JsonResponse
    {
        try {
            Recipe::query()->create($request->validated());

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
     * @param Recipe $recipe
     * @return JsonResponse
     */
    public function show(Recipe $recipe): JsonResponse
    {
        try {
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $recipe->load(['ingredients', 'stepToCooks'])
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
     * @param RecipeRequest $request
     * @param Recipe $recipe
     * @return JsonResponse
     */
    public function update(RecipeRequest $request, Recipe $recipe): JsonResponse
    {
        try {
            $recipe->update($request->validated());

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
     * @param Recipe $recipe
     * @return JsonResponse
     */
    public function destroy(Recipe $recipe): JsonResponse
    {
        try {
            $recipe->delete();

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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StepToCookEditRequest;
use App\Http\Requests\StepToCookRequest;
use App\Models\StepToCook;
use Exception;
use Illuminate\Http\JsonResponse;

class StepToCookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $steps = StepToCook::all();

            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $steps
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
     * @param StepToCookRequest $request
     * @return JsonResponse
     */
    public function store(StepToCookRequest $request): JsonResponse
    {
        try {
            $steps = $request->input('step');

            foreach ($steps as $item) {
                StepToCook::query()->create([
                    'recipe_id' => $request->input('recipe_id'),
                    'step' => $item
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
     * @param StepToCook $stepToCook
     * @return JsonResponse
     */
    public function show(StepToCook $stepToCook): JsonResponse
    {
        try {
            return response()->json([
                'status' => 200,
                'message' => 'Success',
                'data' => $stepToCook
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
     * @param StepToCookEditRequest $request
     * @param StepToCook $stepToCook
     * @return JsonResponse
     */
    public function update(StepToCookEditRequest $request, StepToCook $stepToCook): JsonResponse
    {
        try {
            $stepToCook->update($request->validated());

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
     * @param StepToCook $stepToCook
     * @return JsonResponse
     */
    public function destroy(StepToCook $stepToCook): JsonResponse
    {
        try {
            $stepToCook->delete();

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

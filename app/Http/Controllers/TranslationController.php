<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTranslationRequest;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Translation::query();

            // Optional filters
            if ($request->has('key')) {
                $query->where('key', 'like', '%' . $request->key . '%');
            }

            if ($request->has('locale')) {
                $query->where('locale', $request->locale);
            }

            if ($request->has('value')) {
                $query->where('value', 'like', '%' . $request->value . '%');
            }

            if ($request->has('tags')) {
                $query->where('tags', $request->tag);
            }

            $translations = $query->orderBy('id', 'desc')->limit(100)->get();

            return response()->json([
                'data' => $translations,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch translations.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function store(StoreTranslationRequest $request)
    {
        try {
            $translation = Translation::create($request->validated());

            return response()->json([
                'message' => 'Translation saved successfully.',
                'data' => $translation
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(UpdateTranslationRequest $request, $id)
    {
        try {
            $translation = Translation::findOrFail($id);

            $translation->update($request->validated());

            return response()->json([
                'message' => 'Translation updated successfully.',
                'data' => $translation
            ], 200);

        }catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        $translation = Translation::find($id);

        if (!$translation) {
            return response()->json(['error' => 'Translation not found.'], 404);
        }

        return response()->json($translation);
    }


    public function export(Request $request)
    {
        try {
            $translations = Translation::query()
                ->select('key', 'value', 'locale')
                ->orderBy('updated_at', 'desc')
                ->limit(20000)
                ->get()
                ->groupBy('locale')
                ->map(function ($items) {
                    return $items->pluck('value', 'key');
                });

            return response()->json([
                'success' => true,
                'data' => $translations
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong while exporting translations.',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}

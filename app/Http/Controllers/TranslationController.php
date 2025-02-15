<?php

namespace App\Http\Controllers;

use App\Services\TranslationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Translation Management API",
 *      description="API documentation for the translation management system"
 * ),
 * @OA\PathItem(path="/api")
 */
class TranslationController extends Controller
{
    protected $translationService;

    public function __construct(TranslationServiceInterface $translationService)
    {
        $this->translationService = $translationService;
    }

    /**
     * @OA\Get(
     *     path="/api/translations",
     *     summary="Get all translations",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="locale", in="query", required=false, @OA\Schema(type="string")),
     *     @OA\Parameter(name="key", in="query", required=false, @OA\Schema(type="string")),
     *     @OA\Parameter(name="tag", in="query", required=false, @OA\Schema(type="string")),
     *     @OA\Response(response=200, description="List of translations")
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['locale', 'key', 'tag']);
        $translations = $this->translationService->getTranslations($filters);
        return response()->json($translations);
    }

    /**
     * @OA\Post(
     *     path="/api/translations",
     *     summary="Create a new translation",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="locale", type="string", example="en"),
     *             @OA\Property(property="key", type="string", example="welcome_message"),
     *             @OA\Property(property="content", type="string", example="Welcome to our site"),
     *             @OA\Property(property="tags", type="array", @OA\Items(type="string"), example={"web", "mobile"})
     *         )
     *     ),
     *     @OA\Response(response=201, description="Translation created")
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'locale' => 'required|string|max:5',
            'key' => 'required|string|unique:translations,key',
            'content' => 'required|string',
            'tags' => 'array',
        ]);

        $translation = $this->translationService->createTranslation($validatedData);
        return response()->json(['message' => 'Translation added', 'data' => $translation], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/translations/{id}",
     *     summary="Update an existing translation",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="locale", type="string", example="fr"),
     *             @OA\Property(property="key", type="string", example="greeting_message"),
     *             @OA\Property(property="content", type="string", example="Bonjour"),
     *             @OA\Property(property="tags", type="array", @OA\Items(type="string"), example={"web", "mobile"})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Translation updated")
     * )
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validatedData = $request->validate([
            'locale' => 'sometimes|string|max:5',
            'key' => 'sometimes|string|unique:translations,key,' . $id,
            'content' => 'sometimes|string',
            'tags' => 'sometimes|array',
        ]);

        $updated = $this->translationService->updateTranslation($id, $validatedData);
        return response()->json(['message' => $updated ? 'Translation updated' : 'Update failed']);
    }

    /**
     * @OA\Get(
     *     path="/api/translations/export",
     *     summary="Export all translations as JSON",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Exported translations JSON")
     * )
     */
    public function export(): JsonResponse
    {
        $translations = $this->translationService->exportTranslations();
        return response()->json($translations, 200, ['Content-Type' => 'application/json']);
    }
}

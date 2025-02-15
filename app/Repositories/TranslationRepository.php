<?php

namespace App\Repositories;

use App\Models\Translation;

class TranslationRepository implements TranslationRepositoryInterface
{
    public function getAllTranslations(array $filters)
    {
        $query = Translation::query();

        if (!empty($filters['locale'])) {
            $query->where('locale', $filters['locale']);
        }

        if (!empty($filters['key'])) {
            $query->where('key', 'like', '%' . $filters['key'] . '%');
        }

        if (!empty($filters['tag'])) {
            $query->whereJsonContains('tags', $filters['tag']);
        }

        return $query->paginate(50);
    }

    public function createTranslation(array $data): Translation
    {
        return Translation::create($data);
    }

    public function updateTranslation(int $id, array $data): bool
    {
        $translation = Translation::findOrFail($id);
        return $translation->update($data);
    }
}

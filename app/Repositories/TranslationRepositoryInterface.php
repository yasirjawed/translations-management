<?php

namespace App\Repositories;

use App\Models\Translation;

interface TranslationRepositoryInterface
{
    public function getAllTranslations(array $filters);
    public function createTranslation(array $data): Translation;
    public function updateTranslation(int $id, array $data): bool;
}

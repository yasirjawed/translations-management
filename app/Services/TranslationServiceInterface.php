<?php

namespace App\Services;

use App\Models\Translation;

interface TranslationServiceInterface
{
    public function getTranslations(array $filters);
    public function createTranslation(array $data): Translation;
    public function updateTranslation(int $id, array $data): bool;
    public function exportTranslations();
}

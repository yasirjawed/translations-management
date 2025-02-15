<?php

namespace App\Services;

use App\Repositories\TranslationRepositoryInterface;
use App\Models\Translation;

class TranslationService implements TranslationServiceInterface
{
    protected $translationRepository;

    public function __construct(TranslationRepositoryInterface $translationRepository)
    {
        $this->translationRepository = $translationRepository;
    }

    public function getTranslations(array $filters)
    {
        return $this->translationRepository->getAllTranslations($filters);
    }

    public function createTranslation(array $data): Translation
    {
        return $this->translationRepository->createTranslation($data);
    }

    public function updateTranslation(int $id, array $data): bool
    {
        return $this->translationRepository->updateTranslation($id, $data);
    }

    public function exportTranslations()
    {
        return Translation::select(['locale', 'key', 'content', 'tags'])
            ->orderBy('locale')
            ->cursor()
            ->toArray();
    }
}

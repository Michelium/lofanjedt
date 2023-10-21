<?php

namespace App\Generator;

use App\Repository\LanguageRepository;

class LanguageGenerator {

    public function __construct(
        private LanguageRepository $languageRepository,
    ) {
    }

    public function languages(): array {
        return $this->languageRepository
            ->createQueryBuilder('language')
            ->select('language.id, language.name')
            ->getQuery()
            ->getArrayResult();
    }
    
}
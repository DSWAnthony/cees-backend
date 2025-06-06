<?php
namespace App\Services;

use App\Models\Option;
use App\Repositories\Interfaces\OptionRepository;


class OptionService
{
    public function __construct(
        private OptionRepository $optionRepository
    ) {}

    public function createOption(array $data) : Option {
        
        return $this->optionRepository->create($data);

    }
}
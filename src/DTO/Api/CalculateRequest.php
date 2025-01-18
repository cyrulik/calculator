<?php

namespace App\DTO\Api;

use Symfony\Component\Validator\Constraints as Assert;

class CalculateRequest
{
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['addition', 'subtraction', 'multiplication', 'division'], message: 'Invalid operation')]
    public string $operation;

    #[Assert\NotNull]
    public float $a;

    #[Assert\NotNull]
    public float $b;
}

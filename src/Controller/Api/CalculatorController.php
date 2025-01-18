<?php

namespace App\Controller\Api;

use App\DTO\Api\CalculateRequest;
use Cyrulik\SimpleCalculator\Calculator;
use Cyrulik\SimpleCalculator\OperationFactory;
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class CalculatorController
{
    #[Route('/api/calculate', methods: ['POST'])]
    public function calculate(#[MapRequestPayload] CalculateRequest $request): JsonResponse
    {
        try {
            $calculator = new Calculator(new OperationFactory());
            $result = $calculator->calculate($request->operation, $request->a, $request->b);

            return new JsonResponse(compact('result'));
        } catch (ValidationFailedException|InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        } catch (Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}

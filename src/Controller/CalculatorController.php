<?php

namespace App\Controller;

use App\Form\CalculateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalculatorController extends AbstractController
{
    #[Route('/', name: 'calculate')]
    public function calculate(): Response
    {
        $form = $this->createForm(CalculateType::class);

        return $this->render('calculator/index.html.twig', [
            'form' => $form,
        ]);
    }
}

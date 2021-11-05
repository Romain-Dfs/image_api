<?php

namespace Symfony5\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test", name="test_controller")
 */
class TestController extends AbstractController
{
    public function __invoke()
    {
        $data = ['message' => 'You are login'];
        return $this->json($data, 200);
    }
}
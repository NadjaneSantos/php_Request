<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContadorController extends AbstractController
{
    /**
     * @Route("/contador", name="index")
     */
    public function index(Request $request): Response
    {

        $dataAtual = $request->query->get('dataAtual');
        $dataDestino = $request->query->get('data');
        $dataDif = $request->query->get('dataDif');
        $dataDestino = strtotime($dataDestino);
        $dataAtual = mktime();

        $dataDif = (((int)($dataDestino - $dataAtual))/86400);

        $dataAtual = date('Y-m-d', $dataAtual);
        $dataDestino = date('Y-m-d', $dataDestino);
        $dataDif = number_format($dataDif, 0);

        return $this->render('contador/index.html.twig', [
            "data" => $dataDestino,
            "dataAtual" => $dataAtual,
            "dataDif" => $dataDif
            ]);
    }
}

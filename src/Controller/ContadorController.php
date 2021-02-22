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

        $dataDestino = strtotime($dataDestino);
        $dataAtual = mktime();

        $dataDifDia = (((int)($dataDestino - $dataAtual))/86400);
        $numSemana = (int)( date('z', $dataDestino ) / 7 ) + 1;

        $dataAtual = date('d-m-Y', $dataAtual);
        $dataDestino= date('d-m-Y', $dataDestino);
        $dataDifDia = number_format($dataDifDia, 0);

        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        $dataExtenso = strftime("%d de %B de %Y", strtotime($dataDestino));
        $dia = ucfirst(strftime("%d", strtotime($dataDestino)));
        $mes = ucfirst(strftime("%B", strtotime($dataDestino)));
        $ano = strftime("%Y", strtotime($dataDestino));
        $semana = ucfirst(strftime("%A", strtotime($dataDestino)));

        return $this->render('contador/index.html.twig', [
            "data" => $dataDestino,
            "dataAtual" => $dataAtual,
            "dataDifDia" => $dataDifDia,
            "dia" => $dia,
            "mes" => $mes,
            "ano" => $ano,
            "semana" => $semana,
            "numSemana" => $numSemana,
            "dataExtenso" => $dataExtenso,
            ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\ContratRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(ContratRepository $contratRepository,ChartBuilderInterface $chartBuilder): Response
    {

        $contratsResults = $contratRepository->findAll();
        //dd($contratsResults);

        $labels = [];
        $data = [];

        foreach ($contratsResults as $contratsResult) {

            $labels[] = $contratsResult->getDateContrat()->format('d/m/Y');
            $datas[] = $contratsResult->getMontantDuMensualite();
        }

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data,
                ],
            ],
        ]);

        //dd($chart);

        return $this->render('home/index.html.twig',[
            'chart' => $chart,
        ]);
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->redirectToRoute('app_login');
    }

    // /**
    //  * @Route("/stats", name="stats")
    //  */
    // public function statistique(ContratRepository $contratRepository,ChartBuilderInterface $chartBuilder): Response
    // {
        

    // //$chart->setOptions([/* ... */]);

    //     //dd(chart);

    //     return $this->render('home/index.html.twig', [
            
    //     ]);
    // }
}

<?php

namespace AppBundle\Controller;

use AppBundle\Service\Kvg;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// TODO get arrvials
class StopController extends Controller
{

    /**
     * @param int $stop
     * @param Kvg $kvg
     * @param Request $request
     * @return JsonResponse
     * @Route("/stop/{stop}/json", name="jsonStop")
     */
    public function jsonAction($stop, Kvg $kvg, Request $request)
    {
        return new JsonResponse(json_decode($kvg->getDepartures($stop), true), 200);
    }

    /**
     * @param int $stop
     * @param Kvg $kvg
     * @param Request $request
     * @return Response
     * @Route("/stop/{stop}/natural", name="naturalStop")
     */
    public function naturalAction($stop, Kvg $kvg, Request $request)
    {
        $departures = json_decode($kvg->getDepartures($stop), true);
        $naturalResponse = "Abfahrten an der Haltestelle " . $departures['stopName'] . "<br>";
        foreach ($departures['actual'] as $departure) {
            $departure = str_replace("%UNIT_MIN%", "Minuten", $departure);
            $naturalResponse .= "Linie " . $departure['patternText'] . " Richtung " . $departure['direction'] . " in " . $departure['mixedTime'] . "<br>";
        }
        return new Response($naturalResponse);
    }

    /**
     * @param Request $request
     * @Route("/stop/alexa", name="alexaStop")
     */
    public function alexaAction(Request $request)
    {
        // stub
    }
}

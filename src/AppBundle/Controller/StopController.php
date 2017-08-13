<?php

namespace AppBundle\Controller;

use AppBundle\Service\Kvg;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Alexa\Request\IntentRequest;
use Alexa\Response\Response as AlexaResponse;


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
        return new Response($kvg->getDeparturesNatural($stop));
    }

    /**
     * @param Kvg $kvg
     * @param Request $request
     * @return JsonResponse|Response
     * @Route("/stop/alexa", name="alexaStop")
     */
    public function alexaAction(Kvg $kvg, Request $request)
    {
        // TODO put this somewhere sensible
        $applicationId = "amzn1.ask.skill.b1a7d4cc-4ee2-4979-aca7-6de54e753231";
        $rawRequest = $request->getContent();
        $alexaRequestFactory = new \Alexa\Request\RequestFactory();
        $alexaRequest = $alexaRequestFactory->fromRawData($rawRequest, [$applicationId]);
        if ($alexaRequest instanceof IntentRequest) {
            $response = new AlexaResponse();
            $response->endSession(true);
            $response->respond($kvg->getDeparturesNatural(363)); // todo get stop id from alexa
            return new JsonResponse($response->render());
        }
        return new Response("Nee", 500);
    }
}

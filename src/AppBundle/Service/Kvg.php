<?php

namespace AppBundle\Service;

use GuzzleHttp\Client;

class Kvg
{
    const KVG_URL = "http://www.kvg-kiel.de/internetservice/services/passageInfo/stopPassages/stop";
    const KVG_STOP_PARAM = "stop";
    const KVG_MODE_PARAM = "mode";
    const KVG_MODE_DEPARTURE = "departure";
    const KVG_MODE_ARRIVAL = "arrival";

    public function __construct()
    {
        // stub
    }

    /**
     * @param int $stop
     * @return string
     * TODO set stop dynamically
     * TODO allow for arrivals, build generic requester
     */
    public function getDepartures($stop = 250)
    {
        $client = new Client();
        $response = $client->request("GET",
            self::KVG_URL . "?" . self::KVG_STOP_PARAM . "=" . $stop .
            "&" . self::KVG_MODE_PARAM . "=" . self::KVG_MODE_DEPARTURE);
        return $response->getBody();
    }
}
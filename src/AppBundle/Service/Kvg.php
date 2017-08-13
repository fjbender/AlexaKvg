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
    const KVG_STATUS_PREDICTED = "PREDICTED";
    const KVG_STATUS_PLANNED = "PLANNED";

    public function __construct()
    {
        // stub
    }

    /**
     * @param int $stop
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getDepartures($stop)
    {
        return $this->getInfo($stop, self::KVG_MODE_DEPARTURE);
    }

    /**
     * @param int $stop
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getArrivals($stop)
    {
        return $this->getInfo($stop, self::KVG_MODE_ARRIVAL);
    }

    /**
     * @param int $stop
     * @param string $mode
     * @return \Psr\Http\Message\StreamInterface
     */
    private function getInfo($stop, $mode) {
        $client = new Client();
        $response = $client->request("GET",
            self::KVG_URL . "?" . self::KVG_STOP_PARAM . "=" . $stop .
            "&" . self::KVG_MODE_PARAM . "=" . $mode);
        return $response->getBody();
    }

    /**
     * @param int $stop
     * @return string
     */
    public function getDeparturesNatural($stop) {
        $departures = json_decode($this->getDepartures($stop), true);
        $naturalResponse = "Abfahrten an der Haltestelle " . $departures['stopName'] . "\n";
        foreach ($departures['actual'] as $departure) {
            $departure = str_replace("%UNIT_MIN%", "Minuten", $departure);
            if ($departure['status'] == self::KVG_STATUS_PREDICTED) {
                $naturalResponse .= "Linie " . $departure['patternText'] . " Richtung " . $departure['direction'] .
                    " in " . $departure['mixedTime'] . "\n";
            } else {
                $naturalResponse .= "Linie " . $departure['patternText'] . " Richtung " . $departure['direction'] .
                    " um " . $departure['mixedTime'] . "\n";
            }
        }
        return $naturalResponse;
    }
}
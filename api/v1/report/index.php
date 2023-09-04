<?php

class NikeSignatureVerifier
{

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
    }

    public function process()
    {
        $json = '{
    "absoluteCount": {
        "votes": 2841,
        "nativeUsers": 172,
        "bridgeUsers": 2669
    },
    "validCount": {
        "votes": 2799,
        "nativeUsers": 130,
        "bridgeUsers": 2669
    },
    "randomUser": {
        "native": {
            "id": 283553,
            "roundId": "855435855440855447855448855449",
            "userId": "94164492611671474a646aefce74c80c-e863880422aa38f27198cc459700eae1",
            "answer": "855449",
            "isActive": 1,
            "source": "native",
            "bridgeId": ""
        },
        "bridge": {
            "id": 284465,
            "roundId": "855435855440855447855448855449",
            "userId": "1f53c5128d894732c6df4567a9f93d93-1e30e16616854f457b49e6531650282f",
            "answer": "855448",
            "isActive": 1,
            "source": "bridge",
            "bridgeId": "88fe72e5e3b376ad6b35e023ff2a0c0b9b2a1819d3a62a0446305d2219b3eab8"
        }
    },
    "pollData": [
        {
            "id": "855448",
            "title": "Filip BAINOVIČ",
            "votes": 1213,
            "subtitle": "FC Spartak Trnava",
            "description": "4. kolo: FC SPARTAK TRNAVA - FK Železiarne Podbrezová 2:0"
        },
        {
            "id": "855447",
            "title": "Marek BARTOŠ",
            "votes": 689,
            "subtitle": "FK Železiarne Podbrezová",
            "description": "3. kolo: FK ŽELEZIARNE PODBREZOVÁ – Zlaté Moravce 1:0"
        },
        {
            "id": "855440",
            "title": "Henry ADDO",
            "votes": 433,
            "subtitle": "MŠK Žilina",
            "description": "1. kolo: MŠK ŽILINA - MFK Ružomberok 3:1"
        },
        {
            "id": "855449",
            "title": "Karol MONDEK",
            "votes": 343,
            "subtitle": "FC ViOn Zlaté Moravce",
            "description": "5. kolo: MŠK Žilina - FC VION ZLATÉ MORAVCE 3:2"
        },
        {
            "id": "855435",
            "title": "Roman HAŠA",
            "votes": 127,
            "subtitle": "MFK Skalica",
            "description": "1. kolo: MFK Ružomberok – MFK SKALICA 1:2"
        }
    ]
}';
	print($json);
    }
}
(new NikeSignatureVerifier())->process();

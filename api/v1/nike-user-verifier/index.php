<?php

class NikeSignatureVerifier
{

    private const SECRET_SIGN = 'b4c3ea41-f9bd-4ebe-af9f-1dd6d9c9a534';

    public function __construct()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");
    }

    private function hexToStr(string $hex): string
    {
        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr((int) hexdec($hex[$i] . $hex[$i + 1]));
        }
        return $string;
    }

    private function calculateSign(string $userId, string $competitionId, int $itemId): string
    {
        $dataToHash = $userId . $competitionId . $itemId . self::SECRET_SIGN;
        return hash('sha256', $dataToHash);
    }

    public function verifySignature(string $userId, string $competitionId, int $itemId, string $givenSign): bool
    {
        $computedSign = $this->calculateSign($userId, $competitionId, $itemId);

        return hash_equals($computedSign, $givenSign);
    }

    public function process()
    {
        $bridge = $_GET['bridge'] ?? '';
        $userId = $competitionId = $itemId = $givenSign = null;
        $params = explode('::', $this->hexToStr($bridge));

        if (count($params) === 4) {
            [$userId, $competitionId, $itemId, $givenSign] = $params;
            $response = $this->verifySignature($userId, $competitionId, $itemId, $givenSign);
        } else {
            $response = false;
        }

        print(json_encode([
            'success' => $response,
            'userId' => $userId,
            'competitionId' => $competitionId,
            'itemId' => $itemId
        ]));
    }

}

(new NikeSignatureVerifier())->process();

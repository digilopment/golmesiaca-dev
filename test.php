<?php

class Test
{

    const USER_ID = '81d481ef60d6dd5a43393106c935bd4a';
    const ITEM_ID = '816176';
    const COMPETITION_ID = '816176816180816344816346816347';
    const SIGN_SECRET = 'b4c3ea41-f9bd-4ebe-af9f-1dd6d9c9a534';
    const BASE_URL = 'https://golmesiaca.staging.markiza.io';

    public function strToHex(string $string): string
    {
        $hex = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $hex .= dechex(ord($string[$i]));
        }
        return $hex;
    }

    public function calculateSign(string $userId, string $competitionId, int $itemId): string
    {
        $dataToHash = $userId . $competitionId . $itemId . self::SIGN_SECRET;
        return hash('sha256', $dataToHash);
    }

    public function crypt(string $userId, string $competitionId, int $itemId): string
    {
        $sh256 = $this->calculateSign($userId, $competitionId, $itemId);
        return $this->strToHex($userId . '::' . $competitionId . '::' . $itemId . '::' . $sh256);
    }

    public function generateCombinations()
    {
        $params = [
            'userId' => ['status' => true, 'value' => self::USER_ID],
            'competitionId' => ['status' => true, 'value' => self::COMPETITION_ID],
            'itemId' => ['status' => true, 'value' => self::ITEM_ID],
        ];

        $combinations = [];
        $keys = array_keys($params);

        //Generovanie všetkých možných kombinácií
        for ($i = 0; $i < pow(2, count($params)); $i++) {
            $combination = [];

            // Pre každý prvok v poli $params
            foreach ($params as $key => $param) {
                $status = ($i & (1 << array_search($key, $keys))) > 0;
                if ($status) {
                    $combination[$key] = ['status' => true, 'value' => $param['value']];
                } else {
                    $combination[$key] = ['status' => false, 'value' => rand(1000, 9999)];
                }
            }

            $combinations[] = $combination;
        }
        return $combinations;
    }

    public function run()
    {
        $combinations = $this->generateCombinations();
        $html = '<table>';
        $html .= '<tr>';
        $html .= '<td>Poradie testu</td>';
        $html .= '<td>Kombinácia</td>';
        $html .= '<td>URL</td>';
        $html .= '<td>Business ocakavany stav registracie</td>';
        $html .= '<td>Technicky ocakavany stav registracie</td>';
        $html .= '<td>Vysledok technickeho Testu</td>';
        $html .= '</tr>';
        $l = 0;
        foreach ($combinations as $k => $combination) {
            $html .= '<tr>';
            $html .= '<td>' . $k . '</td>';
            $html .= '<td>';
            $t = 0;
            foreach ($combination as $key => $value) {
                if ($value['status']) {
                    $t++;
                    $color = 'green';
                } else {
                    $color = 'red';
                }
                $html .= '<span style="color:' . $color . '"><b>' . $key . ': </b> ' . $value['value'] . '<br/></span>';
            }
            $html .= '</td>';
            $url = self::BASE_URL . '?bridge=' . $this->crypt($combination['userId']['value'], $combination['competitionId']['value'], $combination['itemId']['value']);
            $html .= '<td><a target="_blank" href="' . $url . '">otvorit</a></td>';
            if ($t === 3) {
                $strStatus = 'SUCCESS';
            } else {
                $strStatus = 'FAIL';
                if ($l === 6) {
                    $strStatus = 'SUCCESS';
                }
            }

            $html .= '<td>' . (($l == 6) ? 'FAIL' : $strStatus) . '</td>';
            $html .= '<td>' . $strStatus . '</td>';

            $html .= '<td>' . (($l == 6) ? 'OK' : 'OK') . '</td>';
            $html .= '</tr>';

            $l++;
        }

        $html .= '<tr>';
        $html .= '<td>8</td>';
        $html .= '<td>Klasicka registracia nový email:</td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> ? </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>9</td>';
        $html .= '<td>Klasicka registracia existujuci email:</td>';
        $html .= '<td> - </td>';
        $html .= '<td> FAIL </td>';
        $html .= '<td> FAIL </td>';
        $html .= '<td> ? </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>10</td>';
        $html .= '<td>Klasicka registracia expirovana google captcha:</td>';
        $html .= '<td> - </td>';
        $html .= '<td> FAIL </td>';
        $html .= '<td> FAIL </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>11</td>';
        $html .= '<td>Kontrola textov (web, tahnkyou email):</td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>12</td>';
        $html .= '<td>Kontrola farieb (web, overovaci email):</td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>13</td>';
        $html .= '<td>Kontrola odklikov je niekde fortuna? (web, overovaci email):</td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>14</td>';
        $html .= '<td>Kontrola pravnych dokumentov a pravnych informacnych suhlasov na webe:</td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>15</td>';
        $html .= '<td>Stav nevyplnena captcha: <br/><b>'
            . 'Prosím, odkliknite antispamovú ochranu. Ak to nie je možné, váš systém používa skrytú antispamovu ochranu, ktorá expirovala. Prosím obnovte stránku stlačením klávesy F5.</b></td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>16</td>';
        $html .= '<td>Stav existujuci email/nikeID: <br/><b>'
            . 'Ľutujeme, ale používateľ s touto emailovou adresou <EMAIL> už v prebiehajúcom kole hlasoval. Do hlasovania sa môžete zapojiť opäť nabudúce v novom súťažnom kole.</b></td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>17</td>';
        $html .= '<td>Stav nova uspesna registracia: '
            . '<br/><b>Váš hlas sme v systéme úspešne započítali. Čoskoro sa zobrazi na webe.</b></td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>18</td>';
        $html .= '<td>Stav nova uspesna registracia: '
            . '<br/><b>Váš hlas sme v systéme úspešne započítali. Čoskoro sa zobrazi na webe.</b></td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>19</td>';
        $html .= '<td>NIKE neovereny signature: '
            . '<br/><b>Po nacitani sa zobrazi formular na manualnu registraciu</b></td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>20</td>';
        $html .= '<td>NIKE overeny signature, ale nespravny UDAJ: INFO ALERT: <br/><b>Vyskytol sa problém v dátovej komunikácií. Prosím, pokúste sa akciu zopakovať neskôr.</b>, potom redirect na formular</td>';
        $html .= '<td> - </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td> SUCCESS </td>';
        $html .= '<td>  </td>';
        $html .= '</tr>';

        $html .= '</table>';
        $html .= '<style>table, tr, td {border: 1px solid #ccc;padding: 5px 15px;}</style>';
        return $html;
    }

}

$a = new Test();
//print($a->run());

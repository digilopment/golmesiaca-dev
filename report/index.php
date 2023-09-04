<?php

class Report
{

    const SERVICE = 'https://livedata.cms.markiza.sk/api/v1/gol-mesiaca/report';

    public function request()
    {
        
        $roundId = $_GET['roundId'] ?? false;
        if ($roundId) {
            $service = self::SERVICE . '?roundId=' . $roundId;
        } else {
            $service = self::SERVICE;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => self::SERVICE,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic MDpuVVdNVnBORlNreUJCcD85ZFF5dTFhME1Va2IvRloyWDBNa0tVMktqaGJLV3FrSTl1alc1SE9TL3M0ZHl5NkJzdkcwPUF4TjdJdU9rL0Q3Y1ZDPWpzZ0hUbkpJY0UvdzNlUFNhSFV6bWEtaXd6WDdrNTVTc1AvPXgwajI5LWN2d1ZiSW9ObVU9MmJNL3hRelRENzFudVI/WC1WTzdpRVRGMG9YQ0c3eXRBSjlTWUUheGRBZy9Keno2VGxzTnNzUS1WWTBnNlY0S3V1ZUE9TTdJVlVsZlZNZVNYZlpsPXhrIU9EM1RBODYyZktlRklRS2JFSFItcWgtbkFkcDhMIW1H'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function showData()
    {
        $response = $this->request();
        $data = json_decode($response, true);
        (bool) $enableRandomUser = $_GET['enableRandomUser'] ?? false;

        if ($data) {

            $html = '';
            $html .= '<table>';
            $html .= '<thead>';
            $html .= '<tr><th colspan="3" class="line"><h2>Poradie v ankete</h2></th></tr>';
            if($data['controll']['isReportReady'] === false){
                $html .= '<tr><th colspan="3" class="line"><h3>Priebežný report</h3><h4>Report sa momentálne aktualizuje. <br/>Počet hlasov v ankete nesúhlasí s celkovým počtom hlasov v databaze. <br/>Dáta sa zjednotia až po dokončení súťažného kola.<br/> Aktualny rozdiel v počte hlasov je: '. ($data['controll']['sumPollData'] - $data['controll']['sumFromService']).'</h4></th></tr>';
            }
            $html .= '<tr><th>#</th><th>Meno</th><th>Počet hlasov</th></tr>';
            $html .= '</thead>';
            $html .= '<tbody>';

            $i = 1;
            foreach ($data['pollData'] as $item) {
                $html .= '<tr>';
                $html .= '<td>' . $i++ . '</td>';
                $html .= '<td>' . $item['title'] . '</td>';
                $html .= '<td><b>' . $item['votes'] . '</b></td>';
                $html .= '</tr>';
            }

            //informácie o absoluteCount
            $html .= '<tr><th colspan="3" class="line"><h2>Počet všetkých hlasov</h2></th></tr>';
            $html .= '<tr><th>POČET HLASOV</th><th>z toho MARKIZA</th><th>z toho NIKE</th></tr>';
            $html .= '<td>' . $data['absoluteCount']['votes'] . '</td>';
            $html .= '<td>' . $data['absoluteCount']['nativeUsers'] . '</td>';
            $html .= '<td>' . $data['absoluteCount']['bridgeUsers'] . '</td>';
            $html .= '</tr>';

            //informácie o validCount
            $html .= '<tr><th colspan="3" class="line"><h2>Počet platných hlasov</h2></th></tr>';
            $html .= '<tr><th>POČET HLASOV</th><th>z toho MARKIZA</th><th>z toho NIKE</th></tr>';
            $html .= '<td>' . $data['validCount']['votes'] . '</td>';
            $html .= '<td>' . $data['validCount']['nativeUsers'] . '</td>';
            $html .= '<td>' . $data['validCount']['bridgeUsers'] . '</td>';
            $html .= '</tr>';

            if ($enableRandomUser) {
                //informácie o random user
                $html .= '<tr><th class="line" colspan="3"><h2>Nahodní sutaziaci</h2></th></tr>';
                $html .= '<tr><th>#</th><th>MARKIZA</th><th>NIKE</th></tr>';
                $html .= '<td>ID (native)</td>';
                $html .= '<td>' . $data['randomUser']['native']['id'] . '</td>';
                $html .= '<td>' . $data['randomUser']['bridge']['id'] . '</td>';
                $html .= '</tr>';

                $html .= '<td>NikeID</td>';
                $html .= '<td>' . $data['randomUser']['native']['bridgeId'] . '</td>';
                $html .= '<td><input type="text" value="' . $data['randomUser']['bridge']['bridgeId'] . '"></td>';
                $html .= '</tr>';
            }

            $html .= '</tr>';
            $html .= '</table>';
            $html .= '<style>
                table {
                    width: 100%;
                    max-width: 700px;
                    border-collapse: collapse;
                    margin: 0px auto;
                }

                table, th, td {
                    border: 1px solid #ddd;
                    font-family: sans-serif;
                }

                th, td {
                    padding: 8px;
                    text-align: left;
                }

                th {
                    background-color: #f2f2f2;
                }
                
                th.line {
                    text-align:center;
                }
                
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }

                tr:hover {
                    background-color: #eee;
                }
            </style>';

            return $html;
        } else {
            return 'Error decoding JSON response.';
        }
    }

}

// Použitie metódy request
$report = new Report();
$response = $report->showData();
echo $response;

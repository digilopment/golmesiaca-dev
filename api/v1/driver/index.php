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
        $response = [
            "assetsVersion" => 1693405864,
            "data" => [
                "title" => "Gól mesiaca",
                "lang" => "sk",
                "form_id" => 100,
                "video_mp4" => "false",
                "layout" => "gol-mesiaca",
                "vendor_name" => "TVNOVINY.sk",
                "primary_color" => "#ff7f03",
                "error_color" => "#cc0000",
                "reverse_text_color_of_primary_color" => "#000000"
            ],
            "i18n" => [
                "title" => "Hlasujte za gól mesiaca a vyhrajte ceny v hodnote až 100 eur od stávkovej spoločnosti NIKÉ",
                "url" => "golmesiaca.markiza.sk",
                "end_of_vote_main" => "Hlasovanie v ankete Gól mesiaca sa pre tento mesiac skončilo.",
                "end_of_vote_description" => "Do hlasovania sa môžete opäť zapojiť v ďalšom mesiaci.",
                "btn_vote" => "Hlasovať",
                "btn_end_or_wait_to_vote" => "Hlasovanie nedostupné"
            ],
            "files" => [
                "statut" => "https://n1.cms.markiza.sk/e2fs/docs/2023/08/30/a412f316-3d74-4da7-8a11-81ec2b3553eb.pdf",
                "profiling" => "https://n1.cms.markiza.sk/e2fs/docs/2023/08/30/0fa4c1e8-0350-4308-a99e-ffe7cde01350.pdf",
                "personal" => "https://n1.cms.markiza.sk/e2fs/docs/2023/08/30/9fa2570c-044f-42d0-91f0-c0c230850099.pdf",
                "slider" => "https://cmesk-ott-images-tvnoviny.ssl.cdn.cra.cz/r1000x375n/a9be9fec-da67-499a-b9dd-c0250ca2078b",
                "banner" => "https://cmesk-ott-images-tvnoviny.ssl.cdn.cra.cz/r313xn/9bbe1fdd-b965-4d31-8bc6-31967c1eb0d4.jpg"
            ],
            "competition" => [
                "is_enabled" => $_GET['is_enabled'] ?? 'true',
                "show_progress_bar" => "true",
                "start" => $_GET['start'] ?? '2023-09-01',
                "end" => $_GET['end'] ?? '2023-09-07'
            ],
            "src" => [
                "sections" => "https://livedata.cms.markiza.sk/api/v1/gol-mesiaca/sections",
                "articles" => "https://livedata.cms.markiza.sk/api/v1/gol-mesiaca/detail",
                "bridge_validity" => "https://livedata.cms.markiza.sk/api/v1/nike-user-verifier"
            ]
        ];
        print(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
(new NikeSignatureVerifier())->process();
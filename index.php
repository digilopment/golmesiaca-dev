<?php
require_once 'src/Builder.php';
$builder = new Builder();
$builder->build('tvnoviny');

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <title>Gól Mesiaca Staging</title>
        <link rel="icon" href="" type="image/x-icon">
        <link rel="stylesheet" href="https://newtvnoviny.markiza.sk/html/styles/bundle.css?<?php echo time(); ?>">
        <link rel="stylesheet" href="<?php echo $builder->path ?>/media/build/html/tvnoviny/styles/bundle.css?<?php echo time(); ?>">
        <script>
            var PageData = {}
            var sssp = null;
        </script>
        <script>
            const __theme_def = {
                _possibilities: ['-system-theme', '-light-theme', '-dark-theme'],
                _system_index: 0,
                _light_index: 1,
                _dark_index: 2,
                _theme_store_name: '_theme'
            };
            window.__theme_def = __theme_def;

            setHtmlThemeClass = function () {
                let __theme = localStorage.getItem(__theme_def._theme_store_name) || __theme_def._possibilities[__theme_def._system_index];
                if (__theme === __theme_def._possibilities[__theme_def._system_index]) {
                    __theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? __theme_def._possibilities[__theme_def._dark_index] : __theme_def._possibilities[__theme_def._light_index];
                }
                document.getElementsByTagName('html')[0].classList.add(__theme);
            }

            setHtmlThemeClass();
        </script>
    </head>
    <body>
        <nav class="menu-header" style="display:none">
            <p>Nastavenie vzhľadu stránky:</p>
            <label class="c-radio"><input class="radiobtn" type="radio" name="theme" value="-system-theme" checked> <span class="label system-theme-label">Podľa nastavenia [SYSTEM]</span></label>
            <label class="c-radio"><input class="radiobtn" type="radio" name="theme" value="-light-theme"> <span class="label">Svetlý</span></label>
            <label class="c-radio"><input class="radiobtn" type="radio" name="theme" value="-dark-theme"> <span class="label">Tmavý</span></label>
        </nav> 
        <main>
            <div class="container">
                <script>
                    const ROOT_PATH = '';
                    var golMesiacaConfig = {
                        'id': 'golMesiaca',
                        'title': 'Gol Mesiaca',
                        'vendorName': 'TVNOVINY.sk',
                        'ajax': 'true',
                        'lang': 'sk',
                        'formId': 116, //100 is production
                        'videoMp4': false,
                        'primaryColor': '#ff7f03', //NIKE: ff7f03; FORTTUNA: #ffdf00
                        'reverseTextColorOfPrimaryColor': '#000000',
                        'errorColor': '#cc0000',
                        'formFields': {
                            'layout': 'gol-mesiaca'
                        },
                        'i18n': {
                            'title': 'Hlasujte za gól mesiaca a vyhrajte 100-eurový kredit od stávkovej spoločnosti NIKÉ',
                            'url': 'golmesiaca.markiza.sk',
                            'endOfVoteMain': 'Hlasovanie v ankete Gól mesiaca sa pre tento mesiac skončilo.',
                            'endOfVoteDescription': 'Do hlasovania sa môžete opäť zapojiť v ďalšom mesiaci.',
                            'btnVote': 'Hlasovať', //Hlasovanie ukončené | HLASOVAŤ | Hlasovanie nedostupné
                            'btnEndOrWaitToVote': 'Hlasovanie nedostupné' //this run automaticly on end of event or begin of event //Hlasovanie ukončené | Hlasovanie nedostupné | Hlasovanie čoskoro
                        },
                        'files': {
                            'statut': 'https://n1.cms.markiza.sk/e2fs/docs/2023/05/31/4dfb60e2-8565-4afa-b7ce-dad754220ba0.pdf',
                            'profiling': 'https://n1.cms.markiza.sk/e2fs/docs/2023/01/09/81785ae5-914f-4118-8e9a-d9d4a3ea42d4.pdf',
                            'personal': 'https://www.markiza.sk/osobne-udaje/clanok/548427-podmienky-a-informacie-o-spracovavani-osobnych-udajov-ucastnikov-a-vyhercov-sutazi',
                            'slider': 'https://cmesk-ott-images-tvnoviny.ssl.cdn.cra.cz/r952x357n/b079809c-21f2-46e4-a42f-0486200117fd',
                            'banner': ''
                        },
                        'competition': {
                            'isEnabled': true,
                            'showProgressBar': true,
                            'start': '2023-08-01',
                            'end': '2023-08-20'
                        },
                        'src': {
                            'sections': 'https://livedata.cms.markiza.sk/api/v1/gol-mesiaca/sections',
                            'articles': 'https://livedata.cms.markiza.sk/api/v1/gol-mesiaca-staging/detail',
                            'bridgeValidity': '<?php echo $builder->baseUrl ?>/api/v1/nike-user-verifier/'
                        },
                        'navigationGlobal': [
                            {fragment: '', url: '#', isActive: 1, name: 'Hlasovanie'},
                            {fragment: 'vysledky', url: ROOT_PATH + '#/vysledky', isActive: 0, name: 'Výsledky'},
                            {fragment: 'archiv', url: ROOT_PATH + '#/archiv', isActive: 0, name: 'Archív'}
                        ]
                    };
                </script>
                <div class="renderMainApp" id="renderMainApp-GolMesiaca">
                    <div class="renderAppPreloader size-16"></div>
                </div>
                <script src="https://www.google.com/recaptcha/api.js?render=6LfdW40hAAAAAGV9bZHzADrQiMx04zEWcl8nCeqF"></script>
                <style>
                    #renderMainApp-GolMesiaca .c-tabs-wrapper {
                        margin: 24px 0;
                    }
                    @media (max-width: 500px) {
                        #renderMainApp-GolMesiaca ._gm .widget .item .info h2 {
                            font-size: 16px;
                        }
                        #renderMainApp-GolMesiaca ._gm .widget .item .info h3 {
                            font-size: 14px;
                        }
                    }
                    .renderMainApp .renderAppPreloader.size-16 {
                        border-top: 16px solid #ff7f03 !important;
                    }
                </style>
            </div>
        </main>
        <script src="https://newtvnoviny.markiza.sk/html/scripts/bundle.js?<?php echo time(); ?>"></script>
        <script src="<?php echo $builder->path ?>/media/build/html/tvnoviny/scripts/bundle.js?<?php echo time(); ?>" defer></script>
    </body>
</html>

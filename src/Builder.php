<?php

class Builder
{

    private $pairs = [];
    public $path = '';
    public $baseUrl = '';

    public function __construct()
    {
        $this->calculatePairs();
    }

    private function calculatePairs()
    {
        $array1 = explode('/', __DIR__);
        $array2 = explode('/', $_SERVER['REQUEST_URI']);

        foreach ($array1 as $num1) {
            foreach ($array2 as $num2) {
                if ($num1 === $num2) {
                    $this->pairs[] = [$num1, $num2];
                }
            }
        }
    }

    private function getFinal()
    {
        $final = [];
        foreach ($this->pairs as $pair) {
            if ($pair[0]) {
                $final[] = $pair[0];
            }
        }
        return $final;
    }

    public function getPath()
    {
        $final = $this->getFinal();
        $this->path = '/' . join('/', $final);
        return $this->path;
    }

    public function buildUrl($project)
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domainName = $_SERVER['HTTP_HOST'];
        $this->baseUrl = $protocol . $domainName . $this->getPath();
        return $this->baseUrl . '/media/src/' . $project . '/index.php';
    }

    public function build($project)
    {
        $build = $this->buildUrl($project);
        return file_get_contents($build);
    }

}

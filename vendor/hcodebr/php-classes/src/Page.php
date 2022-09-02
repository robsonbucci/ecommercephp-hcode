<?php

namespace Hcode;

use Rain\Tpl;

class Page
{

    private $tpl;
    private $options = [];
    private $defaults = [
        "data" => []
    ];

    public function __construct($opts = array())
    {
        // * Sobrescrever dados default pela informação que vier de $opts;
        $this->options = array_merge($this->defaults, $opts);

        // * Variavel responsável por configurar o Rain template
        $config = array(
            "tpl_dir" => $_SERVER["DOCUMENT_ROOT"] . "/views/",
            "cahce_dir" => $_SERVER["DOCUMENT_ROOT"] . "/views-cache/",
            "debug" => false,
        );

        // * inserindo as configuracoes no Rain;
        Tpl::configure($config);

        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        // * Desenhando template na tela;
        $this->tpl->draw("header");
    }

    public function setData($data = array())
    {
        // * Percorrer array para criar template;
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
    }

    public function setTpl($templateName, $data = array(), $returnHTML = false)
    {
        $this->setData($data);

        return $this->tpl->draw($templateName, $returnHTML);
    }

    public function __destruct()
    {
        $this->tpl->draw("footer");
    }
}
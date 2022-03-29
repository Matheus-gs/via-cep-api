<?php

if (isset($_GET['cep'])) {
    $cep = $_GET['cep'];
    $url = "https://viacep.com.br/ws/{$cep}/xml/";
    $xml = simplexml_load_file($url);

    print "<tr>";
    print "<td>{$xml->cep[0]}</td>";
    print "<td>{$xml->logradouro[0]}</td>";
    print "<td>{$xml->complemento[0]}</td>";
    print "<td>{$xml->bairro[0]}</td>";
    print "<td>{$xml->localidade[0]}</td>";
    print "<td>{$xml->uf[0]}</td>";
    print "<td>{$xml->ibge[0]}</td>";
    print "<td>{$xml->gia[0]}</td>";
    print "<td>{$xml->ddd[0]}</td>";
    print "<td>{$xml->siafi[0]}</td>";
    print "</tr>";
}

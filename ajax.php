<?php
// CEP Passado como parâmetro na requisição
$cep = $_GET['cep'];

if (isset($cep) && strlen($cep) == 8 && $cep != '' ) {
    // API
    $url = "https://viacep.com.br/ws/{$cep}/xml/";

    // Transformando XML em objeto
    $xml = simplexml_load_file($url);

    // Criando arquivo json e iniciando o arquivo com um array vazio;
    $dataFileName = 'base.json';
    $jsonData = file_exists($dataFileName) ? json_decode(file_get_contents($dataFileName), true) : [];
    $jsonData[] = $xml; // Inserindo no array a resposta da API

    // Inserindo o array com os dados no arquivo
    file_put_contents($dataFileName, json_encode($jsonData, JSON_PRETTY_PRINT));

    // Pegando os dados do JSON para verificar se o CEP informado já foi consultado anteriormente
    $verifyData = json_decode(file_get_contents($dataFileName), true);

    

    foreach ($verifyData as $key => $value) {

        if (isset($value['cep'])) {

            // JSON Response
            if (str_replace("-", "", $value['cep']) === $cep) {
                print "<tr>";
                print "<td>{$value['cep']}</td>";
                print "<td>{$value['logradouro']}</td>";
                print "<td>{$value['complemento']}</td>";
                print "<td>{$value['bairro']}</td>";
                print "<td>{$value['localidade']}</td>";
                print "<td>{$value['uf']}</td>";
                print "<td>{$value['ibge']}</td>";
                print "<td>{$value['gia']}</td>";
                print "<td>{$value['ddd']}</td>";
                print "<td>{$value['siafi']}</td>";
                print "</tr>";
                break;

                // API XML Response
            } else {
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
        }
    }
}else{
    print "<div class='alert alert-warning'>Desculpe, não foi possível encontrar este endereço, tente novamente</div>";
}

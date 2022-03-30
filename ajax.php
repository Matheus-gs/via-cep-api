<?php
// CEP Passado como parâmetro na requisição
$cep = $_GET['cep'];

if (isset($cep) && strlen($cep) == 8 && $cep != '') {


    // Criando arquivo json e iniciando o arquivo com um array vazio;
    $dataFileName = 'base.json';
    $jsonData = file_exists($dataFileName) ? json_decode(file_get_contents($dataFileName), true) : [];

    // // Pegando os dados do JSON para verificar se o CEP informado já foi consultado anteriormente

    $verifyData = json_decode(file_get_contents($dataFileName), true);

    // var_dump(count($verifyData));


    foreach ($verifyData as $key => $value) {


        if (isset($value['cep'])) {

            $complemento = $value['complemento'];

            if (is_array($complemento)) {
                $complemento = implode(",", $value['complemento']);
            }

            // JSON Response
            if (str_replace("-", "", $value['cep']) === $cep) {
                print "<table class='table'>";

                print "
                        <thead>
                            <th>CEP</th>
                            <th>Logradouro</th>
                            <th>Complemento</th>
                            <th>Bairro</th>
                            <th>Localidade</th>
                            <th>UF</th>
                            <th>IBGE</th>
                            <th>GIA</th>
                            <th>DDD</th>
                            <th>SIAFI</th>
                        </thead>
                    ";

                print "<tbody>";
                print "<tr>";
                print "<td>{$value['cep']}</td>";
                print "<td>{$value['logradouro']}</td>";
                print "<td>{$complemento}</td>";
                print "<td>{$value['bairro']}</td>";
                print "<td>{$value['localidade']}</td>";
                print "<td>{$value['uf']}</td>";
                print "<td>{$value['ibge']}</td>";
                print "<td>{$value['gia']}</td>";
                print "<td>{$value['ddd']}</td>";
                print "<td>{$value['siafi']}</td>";
                print "</tr>";
                print "</tbody>";
                print "</table>";
                exit;
            }
            if (isset($value['erro']) && $value['erro'] == true) {
                print "<div class='alert alert-warning'>Desculpe, não foi possível encontrar este endereço, tente novamente</div>";
                exit;
            }
        }
    }



    // API
    $url = "https://viacep.com.br/ws/{$cep}/xml/";

    // Transformando XML em objeto
    $xml = simplexml_load_file($url);
    $jsonData[] = $xml; // Inserindo no array a resposta da API



    if ($xml->erro) {

        print "<div class='alert alert-warning'>Desculpe, não foi possível encontrar este endereço, tente novamente</div>";
    } else {
        print "<table class='table'>";

        print "
                    <thead>
                        <th>CEP</th>
                        <th>Logradouro</th>
                        <th>Complemento</th>
                        <th>Bairro</th>
                        <th>Localidade</th>
                        <th>UF</th>
                        <th>IBGE</th>
                        <th>GIA</th>
                        <th>DDD</th>
                        <th>SIAFI</th>
                    </thead>
                ";

        print "<tbody>";
        print "<tr>";
        print "<td>{$xml->cep}</td>";
        print "<td>{$xml->logradouro}</td>";
        print "<td>{$xml->complemento}</td>";
        print "<td>{$xml->bairro}</td>";
        print "<td>{$xml->localidade}</td>";
        print "<td>{$xml->uf}</td>";
        print "<td>{$xml->ibge}</td>";
        print "<td>{$xml->gia}</td>";
        print "<td>{$xml->ddd}</td>";
        print "<td>{$xml->siafi}</td>";
        print "</tr>";
        print "</tbody>";
        print "</table>";
    }


    // Inserindo o array com os dados no arquivo
    file_put_contents($dataFileName, json_encode($jsonData, JSON_PRETTY_PRINT));
} else {
    print "<div class='alert alert-warning'>Desculpe, não foi possível encontrar este endereço, tente novamente</div>";
}

<?php
// CEP Passado como parâmetro na requisição
$cep = $_GET['cep'];

if (isset($cep) && strlen($cep) == 8 && $cep != '') {


    // Criando arquivo json e iniciando o arquivo com um array vazio;
    $dataFileName = 'base.json';
    $jsonData = file_exists($dataFileName) ? json_decode(file_get_contents($dataFileName), true) : [];


    $verifyData = json_decode(file_get_contents($dataFileName), true);


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
                print"</table>";
                exit;
            }
        }

  
    }

    // API
    $url = "https://viacep.com.br/ws/{$cep}/xml/";
    // Transformando XML em objeto
    $xml = simplexml_load_file($url);
    $value = json_decode(json_encode($xml, JSON_PRETTY_PRINT), true);

    $jsonData[] = $value; // Inserindo no array a resposta da API

    

    // Inserindo o array com os dados no arquivo
    
    // Pegando os dados do JSON para verificar se o CEP informado já foi consultado anteriormente
    if (isset($value['erro'])) {
        print "<div class='alert alert-warning'>Desculpe, não foi possível encontrar este endereço, tente novamente</div>";
    }else{
        file_put_contents($dataFileName, json_encode($jsonData, JSON_PRETTY_PRINT));

    }

} else {
    print "<div class='alert alert-warning'>Desculpe, não foi possível encontrar este endereço, tente novamente</div>";
}

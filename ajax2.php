
<?php
// CEP Passado como parâmetro na requisição
$cep = $_GET['cep'];

if (isset($cep) && strlen($cep) == 8 && $cep != '') {
    
    // Criando arquivo json e iniciando o arquivo com um array vazio;
    $dataFileName = 'base.json';
    $jsonData = file_exists($dataFileName) ? json_decode(file_get_contents($dataFileName), true) : [];
    
    // Pegando os dados do JSON para verificar se o CEP informado já foi consultado anteriormente
    $verifyData = json_decode(file_get_contents($dataFileName), true);

    foreach ($verifyData as $key => $value) {
        if (isset($value['cep']) && str_replace("-", "", $value['cep']) == $cep ) {
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
            exit;
        }
    }

    // API
    $url = "https://viacep.com.br/ws/{$cep}/xml/";
    // Transformando XML em objeto
    $xml = simplexml_load_file($url);
    // $value['gia'] = ($value->gia->children() > 0)? $xml->gia: "";

    $value = json_decode(json_encode($xml, JSON_PRETTY_PRINT), true);
    $value['complemento'] = is_array($value['complemento']) ? "": $value['complemento'];
    $value['gia'] = is_array($value['gia']) ? "": $value['gia'];

    $jsonData[] = $value; // Inserindo no array a resposta da API

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

    // Inserindo o array com os dados no arquivo
    file_put_contents($dataFileName, json_encode($jsonData, JSON_PRETTY_PRINT));

} else {
    print "<div class='alert alert-warning'>Desculpe, não foi possível encontrar este endereço, tente novamente</div>";
}
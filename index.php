<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="d-flex flex-column align-items-center p-3">

        <h2>Consumindo API</h2>

        <div class="w-50 d-flex flex-column align-items-center mb-3">

            <div class="form-floating m-3 w-50">
                <input type="text" class="form-control" maxlength="8" name="cepAddress" id="cepAddress" placeholder="Digite o CEP"  required>
                <label for="cepAddress">Digite o CEP</label>
            </div>
            <button class="btn btn-outline-primary w-25" id="cepAddressBtn">Buscar</button>

        </div>

        <div class="container d-flex flex-column align-items-center">

            <!-- Table with response data -->
            <table class="table">

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

                <tbody>
                    <!--  -->
                </tbody>

            </table>

            <!-- Spinner -->
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

            <!-- Friendly error message -->
            <div class="alert alert-danger" role="alert">
                Desculpe mas não encontramos o CEP que você está procurando, verifique os dados e tente novamente.
            </div>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS -->
    <script src="js/script.js"></script>
</body>

</html>
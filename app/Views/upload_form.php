<html>

<head>
    <title>Fomulário de Upload</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h5 class="text-center">Pessoas - Análise para lanches saudáveis</h5>
        <hr>
        <div class="jumbotron">
            <h1 class="display-5">Instruções!</h1>
            <p class="lead">Segue abaixo os requisitos necessários do arquivo .csv</p>
            <hr class="my-4">
            <ul class="list-group">
                <li class="list-group-item">Deve ser separado por ;</li>
                <li class="list-group-item">Primeira Linha: Cabeçalho { Preencher com o nome dos campos}</li>
                <li class="list-group-item">Coluna A) Identificador</li>
                <li class="list-group-item">Coluna B) Nome</li>
                <li class="list-group-item">Coluna C) Altura</li>
                <li class="list-group-item">Coluna D) Lactose { Preencher com 0 ou 1 }</li>
                <li class="list-group-item">Coluna E) Peso</li>
                <li class="list-group-item">Coluna F) Atleta { Preencher com 0 ou 1 }</li>
            </ul>
            <br>
            <div class="col-12">
                <form action="<?php echo site_url('Upload/file_upload'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>
                            <h5>upload do arquivo csv<h5>
                        </label>
                    </div>
                    <div class="form-group">
                        <input type="file" name="file_excel" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>


    </div>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
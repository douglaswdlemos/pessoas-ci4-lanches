<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Arquivo enviado com suceso!</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets\css\datatables.net-dt\jquery.dataTables.css'); ?>" />
    <title>Arquivo enviado com sucesso</title>
</head>

<body>
    <div class="container">
        <h5 class="text-center">Seu arquivo foi enviado com sucesso!</h5>
        <hr>
        <div class="row">
            <div class="col-12">
                <table class="table dataTable stripe" id="datatable">
                    <thead>
                        <tr>
                            <th>Identificador</th>
                            <th>Nome</th>
                            <th>Altura</th>
                            <th>Class. Altura</th>
                            <th>Lactose</th>
                            <th>Peso</th>
                            <th>Class. Peso</th>
                            <th>Atleta</th>
                            <th><svg width="20" height="5" viewBox="0 0 20 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.1951 2.14286C12.1951 3.33333 11.2195 4.28571 10 4.28571C8.78049 4.28571 7.80488 3.33333 7.80488 2.14286C7.80488 0.952381 8.78049 0 10 0C11.2195 0 12.1951 0.952381 12.1951 2.14286ZM17.8049 0C16.5854 0 15.6098 0.952381 15.6098 2.14286C15.6098 3.33333 16.5854 4.28571 17.8049 4.28571C19.0244 4.28571 20 3.33333 20 2.14286C20 0.952381 19.0244 0 17.8049 0ZM2.19512 0C0.97561 0 0 0.952381 0 2.14286C0 3.33333 0.97561 4.28571 2.19512 4.28571C3.41463 4.28571 4.39024 3.33333 4.39024 2.14286C4.39024 0.952381 3.41463 0 2.19512 0Z" fill="#606F89" />
                                </svg>

                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <br>
        <br>
        <h5 class="text-center"><?php echo anchor('upload', 'Enviar outro arquivo!'); ?></h5>
    </div>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            var base_url = "<?php echo base_url(); ?>";
            $('#datatable').DataTable({
                'pageLength': 10,
                'order': [],
                'serverSide': true,
                'ajax': {
                    url: base_url + '/Upload/show',
                    type: 'POST'
                }

            });
        });
    </script>

</body>

</html>
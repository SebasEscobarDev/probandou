<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba 1</title>
</head>
<body>
    <style>
        body{
            text-align: center;
            font-size: 18px;
        }
        table{
            padding: 10px;
            width: 100%;
        }
        td{
            border-bottom: 1px solid grey;
            padding: 10px;
        }
    </style>
    <?php
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://my-json-server.typicode.com/rucardona16/notificaciones/stateRecords',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    $response = curl_exec($curl);
    $response = json_decode($response, true);
    curl_close($curl);
    ?>

    <h1>Tabla de Detalles</h1>
    <form action="index.php" method="POST">
        Correo: <input type="text" name="correo" placeholder="Filtrar por correo electrónico">
        <button type="submit">Filtrar</button>
        <a href="index.php">Ver Todos</a>
    </form>
    <table>
        <tbody>
            <tr>
                <th>Fecha</th>
                <th>Email</th>
                <th>Documento</th>
                <th>Estado</th>
                <th>Descripción</th>
            </tr>
            <?php 
            foreach( $response as $emails ){ 
                foreach( $emails as $events ){
                    foreach( $events as $value => $val ){
                        if ( isset( $_POST['correo'] ) ){
                            if( $val["targetEmail"] != $_POST['correo'] ){
                                return;
                            }
                        }
            ?>
                <tr>
                    <td> <?= $val["date"]; ?> </td>
                    <td> <?= $val["targetEmail"]; ?> </td>
                    <td> <?= $val["document"]; ?> </td>
                    <td> <?= $val["typeEvent"]; ?> </td>
                    <td> <?= ( ($val["typeEvent"] == "opened") ? "Abierto" : "Entregado" ) ?> </td>
                </tr>

            <?php 
                    }
                }
            } ?>
        </tbody>
    </table>

</body>
</html>
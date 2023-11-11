<?php 
include("../../bd.php");

if (isset($_GET["txtId"])) {
    // Recolecta los datos del método GET
    $txtID = (isset($_GET["txtId"])) ? $_GET["txtId"] : "";

    // Prepara la consulta para obtener los datos del empleado con el ID proporcionado
    $sentencia = $conexion->prepare("SELECT *,(SELECT nombredelpuesto 
    FROM tbl_puestos 
    WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto FROM tbl_empleados WHERE id = :id");
    // Asigna el valor del ID al parámetro de la consulta
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    // Obtiene los datos del empleado
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

//    print_r($registro);

    // Almacena los datos en variables
    $nombre = $registro["nombres"];
    $apellido = $registro["apellidos"];

    $nombreCompleto = $nombre." ".$apellido;

    $foto = $registro["foto"];
    $cv = $registro["cv"];

    $idpuesto = $registro["idpuesto"];
    $puesto = $registro["puesto"];
    $fechadeingreso = $registro["fechadeingreso"];

    $fechaInicio = new DateTime($fechadeingreso);
    $fechaFin = new DateTime(date('Y-m-d'));
    $diferencia = date_diff($fechaInicio,$fechaFin);       
}
ob_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendación</title>
</head>
<body>
    <h1>Carta de Recomendación Laboral</h1>
    <br><br>
    Buenos Aires, Argentina <strong><?php echo date('d M Y'); ?></strong>
    <br><br>
    A quien pueda interesar:
    <br><br>
    Reciba un cordial y respetuoso saludo.
    <br><br>
    A través de estas líneas deseo hacer de su conocimiento que Sr(a) <strong><?php echo $nombreCompleto?></strong>,
    quien trabajó en mi organización durante <strong><?php echo $diferencia->y;?> Años</strong>
    es un ciudadano de una conducta intachable. Ha demostrado ser un excelente gran trabajador,comprometido, responsable y fiel cumplidor de sus tareas.
    Siempre ha manifestado preocupación por mejorar, capacitarse y actualizar sus conocimientos.
    <br><br>
    Durante esos años se ha desempeñado como: <strong><?php echo $puesto?></strong>
    Es por ello le sugiero considere esta recomendación, con la confianza de que estará siempre a la altura de sus compromisos y responsabilidades.
    <br><br>
    Sin más nada a que referirme  y, esperando que esta misiva sea tomada en cuenta, dejo mi número de contacto para cualquiera información de interés.
    <br><br><br><br><br><br>
    ____________________<br>
    Atentamente,
    <br>
    Analista de Sistemas Meza Danilo
    </body>
</html>

<?php 
$HTML = ob_get_clean();
require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones ->set(array("isRemoteEnabled" => true));
$dompdf -> setOptions($opciones);
$dompdf -> loadHTML($HTML);
$dompdf -> setPaper('letter');
$dompdf -> render();
$dompdf -> stream("archivo.pdf", array("Attachment" => false));
?>
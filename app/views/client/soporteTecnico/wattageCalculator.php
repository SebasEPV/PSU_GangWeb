<?php
require './../../../../config/database.php';

$con = new Database;
$enlace = $con->getConnection();

if (!$enlace) {
    throw new Exception("Error al establecer la conexión a la base de datos.");
}

// Si se envía el formulario, calcula el wattage total
$totalWattage = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpu_id = intval($_POST['cpu']);
    $gpu_id = intval($_POST['gpu']);
    $mobo_id = intval($_POST['mobo']);

    function getWattage($table, $idColumn, $id)
    {
        global $enlace;
        $query = "SELECT wattage FROM $table WHERE $idColumn = :id";
        $stmt = $enlace->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    $cpuWattage = getWattage('cpuList', 'cpu_id', $cpu_id);
    $gpuWattage = getWattage('gpuList', 'gpu_id', $gpu_id);
    $moboWattage = getWattage('mobosList', 'mobo_id', $mobo_id);

    $totalWattage =  $cpuWattage + $gpuWattage + $moboWattage;
}

// Función para obtener opciones de la base de datos
function fetchOptions($table, $idColumn, $nameColumn)
{
    global $enlace;
    $query = "SELECT $idColumn, $nameColumn FROM $table";
    $stmt = $enlace->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Obtener las opciones para cada componente
$psuOptions = fetchOptions('psuList', 'psu_id', 'psuName');
$cpuOptions = fetchOptions('cpuList', 'cpu_id', 'cpuName');
$gpuOptions = fetchOptions('gpuList', 'gpu_id', 'gpuName');
$moboOptions = fetchOptions('mobosList', 'mobo_id', 'moboName');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Wattage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navBar.php'; ?>
    <?php include './../refs.html'; ?>
    <div class="container">
        <h1>Calculadora de Wattage</h1>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="cpu" class="form-label">CPU</label>
                <select name="cpu" class="form-select">
                    <option value="">Seleccione un CPU</option>
                    <?php foreach ($cpuOptions as $option) : ?>
                        <option value="<?php echo $option['cpu_id']; ?>" <?php echo isset($cpu_id) && $cpu_id == $option['cpu_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($option['cpuName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="gpu" class="form-label">GPU</label>
                <select name="gpu" class="form-select">
                    <option value="">Seleccione una GPU</option>
                    <?php foreach ($gpuOptions as $option) : ?>
                        <option value="<?php echo $option['gpu_id']; ?>" <?php echo isset($gpu_id) && $gpu_id == $option['gpu_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($option['gpuName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="mobo" class="form-label">Motherboard</label>
                <select name="mobo" class="form-select">
                    <option value="">Seleccione una Motherboard</option>
                    <?php foreach ($moboOptions as $option) : ?>
                        <option value="<?php echo $option['mobo_id']; ?>" <?php echo isset($mobo_id) && $mobo_id == $option['mobo_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($option['moboName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Calcular</button>
        </form>

        <?php if ($totalWattage !== null) : ?>
            <h2>Total de Wattage</h2>
            <p>El wattage total estimado de los componentes seleccionados es: <strong><?php echo $totalWattage; ?>W</strong></p>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
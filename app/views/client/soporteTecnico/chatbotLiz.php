<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSU Gang | Inicio</title>
</head>

<body>

    <body class="wrapper">
        <div class="wrapper">
            <?php include "navBar.php"; ?>
            <div class="content-wrapper">
                <section class="content">
                    <!-- Incluir contenido de los modulos -->
                    <div class="content-fluid">
                        <div>
                            <h1>Conversa con Liz!</h1>
                        </div>
                    </div>
                    <div>
                        <form>
                                <input type="text" name="prompt" placeholder="¡Hola Liz! Tengo una duda">
                            </div>
                        </form>
                    </div>
                </section>
            </div>
            <?php 
            // include "footer.php"; 
            function sendMessageToChatbot($message) {
                $url = 'http://localhost:5000/chatbot';
                $data = array('message' => $message);
            
                // Iniciar cURL
                $ch = curl_init($url);
            
                // Configurar cURL
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            
                // Ejecutar cURL
                $response = curl_exec($ch);
            
                // Cerrar cURL
                curl_close($ch);
            
                // Decodificar la respuesta
                $response_data = json_decode($response, true);
            
                return $response_data;
            }
            // Ejemplo de uso
            $message = "tiempo";

            $response = sendMessageToChatbot($message);
            if (!empty($response) && isset($response['response']) && is_string($response['response'])) {
                echo "Liz: " . $response['response'];
            } else {
                echo "No se recibió una respuesta válida del chatbot.";
            }
            ?>
        </div>
    </body>

</body>

</html>
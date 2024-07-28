<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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
                            <input type="text" name="prompt" placeholder="¡Hola Liz! Tengo una duda" method="POST">
                            <button type="button" class="btn btn-outline-primary">Enviar</button>
                        </form>
                    </div>
            </div>
            </section>
        </div>
        <?php
        // include "footer.php"; 




        function sendMessageToChatbot($message)
        {
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

        $responses = array();

        function addMessageToChatbot($message)
        {
            global $responses;
            $response = sendMessageToChatbot($message);

            if (!empty($response) && isset($response['response']) && is_string($response['response'])) {
                $responses[] = array('user' => $message, 'bot' => $response['response']);
            } else {
                $responses[] = array('user' => $message, 'bot' => 'No se recibió una respuesta válida del chatbot.');
            }
        }

        // Ejemplo de uso
        addMessageToChatbot("Hola chatbot!");
        addMessageToChatbot("¿Cómo estás?");
        addMessageToChatbot("Dime el clima.");
        addMessageToChatbot("Gracias");

        // Pintar la conversación
        foreach ($responses as $conversation) {
            echo "Usuario: " . $conversation['user'] . "<br>";
            echo "Chatbot: " . $conversation['bot'] . "<br><br>";
        }


        // Ejemplo de uso
        $message = "adios";

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
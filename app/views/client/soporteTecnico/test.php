<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat con Chatbot</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
            padding: 20px;
        }

        .message {
            margin-bottom: 15px;
        }

        .message .user {
            font-weight: bold;
            color: #007bff;
        }

        .message .bot {
            font-weight: bold;
            color: #28a745;
        }

        .message .content {
            margin-left: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <?php
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

    foreach ($responses as $conversation) {
        echo "Usuario: " . $conversation['user'] . "<br>";
        echo "Liz: " . $conversation['bot'] . "<br><br>";
    }
    addMessageToChatbot("Hola chatbot!");
    addMessageToChatbot("¿Cómo estás?");
    addMessageToChatbot("Dime el clima.");
    addMessageToChatbot("Gracias");
    addMessageToChatbot("Gracias");
    ?>
    <div class="chat-container">
        <?php foreach ($responses as $conversation) : ?>
            <div class="message">
                <span class="user">Usuario:</span>
                <span class="content"><?php echo htmlspecialchars($conversation['user']); ?></span>
            </div>
            <div class="message">
                <span class="bot">Chatbot:</span>
                <span class="content"><?php echo htmlspecialchars($conversation['bot']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>
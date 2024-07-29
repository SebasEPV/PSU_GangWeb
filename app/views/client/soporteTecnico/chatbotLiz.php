<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <title>PSU Gang | Platica con Liz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .chat-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
            padding: 30px;
            margin: 40px auto;
        }

        .chat-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .chat-header h2 {
            margin: 0;
        }

        .chat-body {
            padding: 20px;
            height: 300px;
            overflow-y: auto;
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

        .chat-input {
            padding: 20px;
            border-top: 1px solid #eee;
        }

        .chat-input input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .chat-input button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>


    <?php include './../../layouts/navBar.php'; ?>
    <?php include './../refs.html'; ?>

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



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
        $message = $_POST['message'];
        addMessageToChatbot($message);
    }
    ?>
    <div class="chat-container">
        <div class="chat-header">
            <h2>Plática con Liz!</h2>
        </div>
        <form action="chatbotLiz.php" method="post">
            <input type="text" id="message" method="post" name="message" placeholder="Escribele una duda a Liz!" require>
            <input type="submit" value="Enviar" class="btn btn-success">
        </form>
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
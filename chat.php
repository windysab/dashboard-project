<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Online</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .chat-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }
        .chat-container h2 {
            margin-bottom: 20px;
        }
        .chat-container #messages {
            height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .chat-container input, .chat-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .chat-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
        }
        .chat-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>Chat Online</h2>
        <div id="messages"></div>
        <input type="text" id="recipient" placeholder="Penerima">
        <textarea id="message" placeholder="Pesan"></textarea>
        <button id="send-message">Kirim</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#send-message').on('click', function () {
                var recipient = $('#recipient').val();
                var message = $('#message').val();

                $.ajax({
                    url: 'send_message.php',
                    method: 'POST',
                    data: { recipient: recipient, message: message },
                    success: function (response) {
                        $('#messages').append('<p>' + response + '</p>');
                        $('#message').val('');
                    }
                });
            });

            function loadMessages() {
                $.ajax({
                    url: 'get_messages.php',
                    method: 'GET',
                    success: function (response) {
                        $('#messages').html(response);
                    }
                });
            }

            setInterval(loadMessages, 3000);
        });
    </script>
</body>
</html>
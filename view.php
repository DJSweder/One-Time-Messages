<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odesílatel tohoto odkazu Vám posílá soukromou zprávu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Odesílatel zasílá zprávu s tímto textem:</h1>
        <div id="message"></div>
        <div id="replyForm" style="display:none;">
            <h2>Odpovědět na zprávu:</h2>
            <textarea id="replyMessage" placeholder="Napište svou odpověď zde"></textarea>
            <button id="sendReply">Vytvořit odpověď</button>
            <div id="replyResult"></div>
        </div>
    </div>
    <script src="view_script.js"></script>
</body>
</html>
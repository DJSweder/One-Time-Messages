<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zobrazení zprávy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Jednorázová zpráva</h1>
        <div id="message"></div>
    </div>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        const password = window.location.hash.slice(1);
        fetch(`get_message.php?id=${id}&password=${password}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('message').innerText = data;
            });
    </script>
</body>
</html>
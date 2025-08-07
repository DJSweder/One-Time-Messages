document.getElementById('createLink').addEventListener('click', function() {
    const message = document.getElementById('message').value;
    if (message.trim() === '') {
        alert('Prosím, napište zprávu.');
        return;
    }

    fetch('save_message.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'message=' + encodeURIComponent(message)
    })
    .then(response => response.json())
    .then(data => {
        const link = `${window.location.origin}${window.location.pathname.replace('index.html', '')}view.php?id=${data.id}#${data.password}`;
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = `
            <p>Váš odkaz je:</p>
            <input type="text" id="linkInput" value="${link}" readonly>
            <button onclick="copyToClipboard()">Kopírovat odkaz</button>
        `;
    });
});

function copyToClipboard() {
    const linkInput = document.getElementById('linkInput');
    linkInput.select();
    linkInput.setSelectionRange(0, 99999); // Pro mobilní zařízení
    
    navigator.clipboard.writeText(linkInput.value).then(() => {
        alert('Odkaz byl zkopírován do schránky.');
    }, (err) => {
        console.error('Nepodařilo se zkopírovat text: ', err);
        alert('Nepodařilo se zkopírovat odkaz. Prosím, zkopírujte ho ručně.');
    });
}
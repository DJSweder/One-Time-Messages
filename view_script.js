document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const password = window.location.hash.slice(1);

    fetch(`get_message.php?id=${id}&password=${password}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('message').innerText = data;
            document.getElementById('replyForm').style.display = 'block';
        });

    document.getElementById('sendReply').addEventListener('click', function() {
        const replyMessage = document.getElementById('replyMessage').value;
        if (replyMessage.trim() === '') {
            alert('Prosím, napište odpověď.');
            return;
        }

        fetch('save_message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'message=' + encodeURIComponent(replyMessage)
        })
        .then(response => response.json())
        .then(data => {
            const link = `${window.location.origin}${window.location.pathname.replace('view.php', '')}view.php?id=${data.id}#${data.password}`;
            const resultDiv = document.getElementById('replyResult');
            resultDiv.innerHTML = `
                <p>Odkaz na vaši odpověď:</p>
                <input type="text" id="linkInput" value="${link}" readonly>
                <button onclick="copyToClipboard()">Kopírovat odkaz</button>
            `;
        });
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
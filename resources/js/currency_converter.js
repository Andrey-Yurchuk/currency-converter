document.getElementById('conversionForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(convertUrl, {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            const resultDiv = document.getElementById('conversionResult');

            if (data.success) {
                resultDiv.innerHTML = `<h4>Converted Amount: ${data.data.converted_amount}</h4>`;
            } else {
                resultDiv.innerHTML = `<p>Error: ${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

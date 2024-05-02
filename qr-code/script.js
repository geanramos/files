const qrForm = document.getElementById('qrForm');
const urlInput = document.getElementById('urlInput');
const qrCodeImage = document.getElementById('qrCodeImage');

qrForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const url = urlInput.value.trim();

    if (!url) {
        alert('Please enter a valid URL.');
        return;
    }

    const qrCodeUrl = `https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=${encodeURIComponent(url)}`;
    qrCodeImage.src = qrCodeUrl;
});

setTimeout(() => {
    const message = document.getElementById('logout-message');
    if (message) {
        message.style.opacity = '0';
        setTimeout(() => message.style.display = 'none', 1000);
    }
}, 3000);
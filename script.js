document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search-input');
    const searchButton = document.querySelector('.buttons button:first-child');
    const luckyButton = document.querySelector('.buttons button:last-child');

    // Handle search
    searchButton.addEventListener('click', () => {
        if (searchInput.value.trim() !== '') {
            window.location.href = `https://www.google.com/search?q=${encodeURIComponent(searchInput.value)}`;
        }
    });

    // Handle "I'm Feeling Lucky"
    luckyButton.addEventListener('click', () => {
        if (searchInput.value.trim() !== '') {
            window.location.href = `https://www.google.com/search?q=${encodeURIComponent(searchInput.value)}&btnI`;
        }
    });

    // Handle Enter key in search input
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && searchInput.value.trim() !== '') {
            window.location.href = `https://www.google.com/search?q=${encodeURIComponent(searchInput.value)}`;
        }
    });

    // Add sign-in button handler
    const signInButton = document.querySelector('.sign-in');
    signInButton.addEventListener('click', () => {
        window.location.href = 'signin.html';
    });
});

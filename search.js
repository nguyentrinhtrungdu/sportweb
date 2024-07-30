document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchHistory = document.getElementById('search-history');

    searchInput.addEventListener('input', function() {
        const query = searchInput.value;

        if (query.length > 0) {
            fetch(`search.php?q=${encodeURIComponent(query)}`)
                .then(response => response.text())
                .then(html => {
                    searchHistory.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
        } else {
            searchHistory.innerHTML = '<p>Không có lịch sử tìm kiếm.</p>';
        }
    });
});
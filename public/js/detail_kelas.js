document.addEventListener('DOMContentLoaded', function() {
    const searchBar = document.getElementById('search-bar');
    const tableRows = document.querySelectorAll('#siswa-table tr');

    searchBar.addEventListener('input', function() {
        const searchTerm = searchBar.value.toLowerCase();

        tableRows.forEach(row => {
            const nama = row.cells[0].textContent.toLowerCase();
            row.style.display = nama.includes(searchTerm) ? '' : 'none';
        });
    });
});
// JavaScript to toggle sidebar
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const content = document.getElementById('content');
    const topBar = document.getElementById('top-bar');
    const burgerIcon = document.querySelector('.burger');

    // Toggle sidebar and layout
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('collapsed');
    topBar.classList.toggle('collapsed');
    burgerIcon.classList.toggle('is-closed');

    // Adjust content and top bar dynamically
    if (window.innerWidth <= 768) { // Untuk layar kecil
        if (sidebar.classList.contains('collapsed')) {
            sidebar.style.width = '0';
            content.style.marginLeft = '0';
            topBar.style.left = '0';
            topBar.style.width = '100%';
            content.style.width = '100%';
        } else {
            sidebar.style.width = '150px'; // Sesuaikan dengan desain Anda
            content.style.marginLeft = '150px';
            topBar.style.left = '150px';
            topBar.style.width = 'calc(100% - 150px)';
        }
    } else { // Untuk layar besar
        if (sidebar.classList.contains('collapsed')) {
            content.style.marginLeft = '0';
            topBar.style.left = '0';
            topBar.style.width = '100%';
            content.style.width = '100%';
        } else {
            content.style.marginLeft = '250px';
            topBar.style.left = '250px';
            topBar.style.width = 'calc(100% - 250px)';
        }
    }
}

// JavaScript to handle logout
function handleLogout() {
    const logoutBtn = document.querySelector('.logout-btn');
    logoutBtn.classList.add('loading'); // Add loading state

    // Perform logout request
    fetch(AppRoutes.logout, {
        method: 'POST',
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('authToken'),
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error('Logout failed');
    })
    .then(data => {
        console.log(data.message);
        localStorage.removeItem('authToken');
        window.location.href = '/login';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to logout. Please try again.');
    })
    .finally(() => {
        logoutBtn.classList.remove('loading'); // Remove loading state
    });
}

// Sidebar Toggle Logic
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById('sidebar');
    const topBar = document.getElementById('top-bar');
    const content = document.getElementById('content');
    const burgerContainer = document.querySelector(".burger-container");
    const burger = document.querySelector(".burger");

    // Tambahkan kelas 'collapsed' jika ukuran layar <= 768px
    if (window.innerWidth <= 768) {
        sidebar.classList.add('collapsed');
        topBar.classList.add('collapsed');
        content.classList.add('collapsed');
    }

    // Toggle sidebar
    
});

// Add active class to clicked sidebar menu item
document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.sidebar-menu li a');
    const sidebar = document.getElementById('sidebar');

    menuItems.forEach(item => {
        item.addEventListener('click', function(event) {
            // Jika sidebar tertutup, tetap izinkan navigasi
            if (sidebar.classList.contains('collapsed')) {
                // Pastikan hanya menu dengan atribut href yang valid yang bisa diakses
                if (this.getAttribute('href') && this.getAttribute('href') !== "#") {
                    // Biarkan navigasi berjalan normal
                    return;
                } else {
                    event.preventDefault(); // Hentikan aksi jika tidak ada href
                }
            }

            // Untuk sidebar terbuka, berikan efek aktif
            menuItems.forEach(i => i.classList.remove('active')); // Hapus semua active
            this.classList.add('active'); // Tambahkan ke menu yang diklik
        });
    });
});

// Function to toggle dropdown
function toggleDropdown() {
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.toggle('show');

    // Adjust position if dropdown is near the edge
    const rect = dropdown.getBoundingClientRect();
    if (rect.right > window.innerWidth) {
        dropdown.style.left = '0';
        dropdown.style.right = 'auto';
    } else {
        dropdown.style.left = '50%';
        dropdown.style.right = 'auto';
    }
}

// Event listener for dropdown toggle
document.addEventListener('DOMContentLoaded', () => {
    const profileContainer = document.querySelector('.profile-container');
    profileContainer.addEventListener('click', toggleDropdown);
});

// Close the dropdown if the user clicks outside it
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('profileDropdown');
    const profileContainer = document.querySelector('.profile-container');

    if (!profileContainer.contains(event.target)) {
        dropdown.classList.remove('show');
    }
});



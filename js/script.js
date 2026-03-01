/**
 * Tugas Akhir 2 - Praktikum Sistem Informasi Berbasis Web
 * Fitur: Wishlist (sessionStorage), Dark Mode (localStorage), Pengelolaan Stok
 * Dosen: Nur Fitria
 * Nama: M. Salman Auliya Alfarisi
 * NIM: 162023034
 */

// ================= STATE =================
let wishlist = []; // Menyimpan daftar item wishlist

// ================= INISIALISASI SESSIONSTORAGE =================
function loadWishlist() {
    const stored = sessionStorage.getItem('wishlist');
    if (stored) {
        try {
            wishlist = JSON.parse(stored);
        } catch (e) {
            wishlist = [];
        }
    } else {
        wishlist = [];
    }
}

function saveWishlist() {
    sessionStorage.setItem('wishlist', JSON.stringify(wishlist));
}

// ================= UPDATE BADGE NAVBAR =================
function updateWishlistBadge() {
    const badge = document.getElementById('wishlist-count');
    if (badge) {
        badge.textContent = wishlist.length;
    }
}

// ================= RENDER MODAL WISHLIST =================
function renderWishlistModal() {
    const modalBody = document.getElementById('wishlist-items');
    if (!modalBody) return;

    if (wishlist.length === 0) {
        modalBody.innerHTML = '<p class="text-muted">Wishlist kosong.</p>';
        return;
    }

    let html = '<ul class="list-group">';
    wishlist.forEach(item => {
        html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                    ${item}
                    <button class="btn btn-sm btn-danger remove-wishlist-item" data-item="${item}">Hapus</button>
                </li>`;
    });
    html += '</ul>';
    modalBody.innerHTML = html;
}

// ================= TAMBAH ITEM KE WISHLIST =================
function addToWishlist(itemName) {
    // Cegah duplikat (opsional)
    if (wishlist.includes(itemName)) {
        alert('Item sudah ada di wishlist!');
        return;
    }

    wishlist.push(itemName);
    saveWishlist();
    updateWishlistBadge();
    renderWishlistModal();
    alert(`"${itemName}" ditambahkan ke wishlist.`);
}

// ================= HAPUS ITEM DARI WISHLIST =================
function removeFromWishlist(itemName) {
    wishlist = wishlist.filter(item => item !== itemName);
    saveWishlist();
    updateWishlistBadge();
    renderWishlistModal();
}

// ================= EVENT LISTENER TOMBOL WISHLIST DI CARD =================
function initWishlistButtons() {
    const wishlistBtns = document.querySelectorAll('.btn-wishlist');
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const cardBody = this.closest('.card-body');
            if (cardBody) {
                const titleElem = cardBody.querySelector('.card-title');
                if (titleElem) {
                    const itemName = titleElem.innerText.trim();
                    addToWishlist(itemName);
                }
            }
        });
    });
}

// ================= EVENT LISTENER TOMBOL BELI (STOK) =================
function initBeliButtons() {
    const beliBtns = document.querySelectorAll('.btn-detail');
    beliBtns.forEach(button => {
        button.addEventListener('click', function(e) {
            const cardBody = e.target.closest('.card-body');
            const stokElement = cardBody.querySelector('.stok-text');
            let stok = parseInt(stokElement.innerHTML.replace("Stok: ", ""));
            if (stok > 0) {
                stok--;
                stokElement.innerHTML = "Stok: " + stok;
                const namaBarang = cardBody.querySelector('.card-title').innerText;
                alert("Berhasil membeli " + namaBarang);

                // Jika stok habis, nonaktifkan tombol
                if (stok === 0) {
                    e.target.disabled = true;
                    e.target.innerHTML = "Habis";
                }
            } else {
                alert("Stok Habis!");
                e.target.disabled = true;
                e.target.innerHTML = "Habis";
            }
        });
    });
}

// ================= DARK MODE (LOCALSTORAGE) =================
function initTheme() {
    const btnTheme = document.getElementById('btn-theme');
    const body = document.body;

    // Muat tema tersimpan
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        btnTheme.innerHTML = '<i class="bi bi-sun-fill"></i> Mode Terang';
    } else {
        btnTheme.innerHTML = '<i class="bi bi-moon-fill"></i> Mode Gelap';
    }

    btnTheme.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
            btnTheme.innerHTML = '<i class="bi bi-sun-fill"></i> Mode Terang';
        } else {
            localStorage.removeItem('theme');
            btnTheme.innerHTML = '<i class="bi bi-moon-fill"></i> Mode Gelap';
        }
    });
}

// ================= DELEGASI EVENT UNTUK TOMBOL HAPUS DI MODAL =================
function initModalRemove() {
    const modalBody = document.getElementById('wishlist-items');
    if (modalBody) {
        modalBody.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('.remove-wishlist-item');
            if (deleteBtn) {
                const itemName = deleteBtn.getAttribute('data-item');
                if (itemName) {
                    removeFromWishlist(itemName);
                }
            }
        });
    }
}

// ================= INISIALISASI SEMUA FITUR SAAT DOM SIAP =================
document.addEventListener('DOMContentLoaded', function() {
    loadWishlist();
    updateWishlistBadge();
    renderWishlistModal();

    initTheme();
    initBeliButtons();
    initWishlistButtons();
    initModalRemove();
});
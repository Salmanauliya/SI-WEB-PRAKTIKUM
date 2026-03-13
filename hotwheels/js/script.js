/**
 * Tugas Akhir 2 - Praktikum Sistem Informasi Berbasis Web
 * Fitur: Wishlist (sessionStorage), Dark Mode (localStorage), Pengelolaan Stok, Ringkasan Produk
 * Dosen: Nur Fitria
 * Nama: M. Salman Auliya Alfarisi
 * NIM: 162023034
 */

let wishlist = []; 

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

function updateWishlistBadge() {
    const badge = document.getElementById('wishlist-count');
    if (badge) {
        badge.textContent = wishlist.length;
    }
}

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

function addToWishlist(itemName) {
  
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

function removeFromWishlist(itemName) {
    wishlist = wishlist.filter(item => item !== itemName);
    saveWishlist();
    updateWishlistBadge();
    renderWishlistModal();
}

function updateSummary() {

    const totalProduk = document.querySelectorAll('.produk-card').length;
    document.getElementById('total-produk').textContent = totalProduk;

    let totalStok = 0;
    document.querySelectorAll('.stok-text').forEach(el => {
        let stok = parseInt(el.innerText.replace('Stok: ', ''));
        if (!isNaN(stok)) totalStok += stok;
    });
    document.getElementById('total-stok').textContent = totalStok;

    const kategoriSet = new Set();
    document.querySelectorAll('.produk-card').forEach(card => {
        const cat = card.dataset.category;
        if (cat) kategoriSet.add(cat);
    });
    document.getElementById('total-kategori').textContent = kategoriSet.size;
}

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


                if (stok === 0) {
                    e.target.disabled = true;
                    e.target.innerHTML = "Habis";
                }

                updateSummary();
            } else {
                alert("Stok Habis!");
                e.target.disabled = true;
                e.target.innerHTML = "Habis";
            }
        });
    });
}

function initTheme() {
    const btnTheme = document.getElementById('btn-theme');
    const body = document.body;

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

document.addEventListener('DOMContentLoaded', function() {
    loadWishlist();
    updateWishlistBadge();
    renderWishlistModal();

    initTheme();
    initBeliButtons();
    initWishlistButtons();
    initModalRemove();

    updateSummary();
});
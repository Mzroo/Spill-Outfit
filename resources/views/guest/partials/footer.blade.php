<footer class="footer">

    <div class="container">

        <div class="footer-wrapper">

            <div class="footer-brand">

                <div class="footer-logo">
                    <div class="footer-logo-icon">
                        <i class="mdi mdi-hanger"></i>
                    </div>
                    <div>
                        <h3>Spill Outfit</h3>
                        <span>Fashion Recommendation</span>
                    </div>
                </div>

                <p>
                    Temukan inspirasi outfit terbaik untuk kuliah, nongkrong, kerja, hingga daily outfit dengan tampilan modern dan stylish pilihan.
                </p>

                <div class="footer-social">
                    <a href="https://instagram.com" target="_blank">
                        <i class="mdi mdi-instagram"></i>
                    </a>
                    <a href="https://wa.me/628123456789" target="_blank">
                        <i class="mdi mdi-whatsapp"></i>
                    </a>
                    <a href="https://facebook.com" target="_blank">
                        <i class="mdi mdi-facebook"></i>
                    </a>
                    <a href="mailto:support@spilloutfit.com">
                        <i class="mdi mdi-email-outline"></i>
                    </a>
                </div>

            </div>

            <div class="footer-column">
                <h4>Menu</h4>
                
                <a href="/">Home</a>
                <a href="{{ route('guest.produk.index') }}">Produk</a>
                <a href="{{ route('guest.about') }}">About</a>
                <a href="{{ route('guest.community') }}">Community</a>
            </div>

            <div class="footer-column">
                <h4>Support</h4>
                
                <a href="javascript:void(0)" onclick="pemicuSupportAlert('FAQ')">FAQ</a>
                <a href="javascript:void(0)" onclick="pemicuSupportAlert('Terms & Conditions')">Terms & Condition</a>
                <a href="javascript:void(0)" onclick="pemicuSupportAlert('Privacy Policy')">Privacy Policy</a>
                <a href="javascript:void(0)" onclick="pemicuSupportAlert('Contact Us')">Contact Us</a>
            </div>

            <div class="footer-column footer-newsletter">
                <h4>Stay Updated</h4>
                <p>Dapatkan update fashion terbaru dan inspirasi outfit menarik.</p>

                <div class="newsletter-box">
                    <input type="email" id="newsletter-email" placeholder="Masukkan email kamu..." autocomplete="off">
                    <button type="button" onclick="pemicuNewsletter()">Kirim</button>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2026 Spill Outfit — All Rights Reserved</p>
            <span>Made with ❤️ for Fashion Lovers</span>
        </div>

    </div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Fungsi interaktif untuk kotak newsletter berlangganan update info fashion
    function pemicuNewsletter() {
        const emailInput = document.getElementById('newsletter-email').value;
        
        // Validasi inputan form email sederhana
        if (!emailInput || !emailInput.includes('@')) {
            Swal.fire({
                title: 'Email Tidak Valid! 😥',
                text: 'Silakan masukkan alamat email kamu dengan format yang benar ya.',
                icon: 'error',
                confirmButtonColor: '#8C6A2F',
                background: '#ffffff',
                customClass: { popup: 'rounded-5 border shadow-sm' }
            });
            return;
        }

        Swal.fire({
            title: 'Berhasil Berlangganan! 🎉',
            text: 'Terima kasih! Email kamu telah terdaftar untuk menerima update katalog trending mingguan.',
            icon: 'success',
            confirmButtonColor: '#8C6A2F',
            background: '#ffffff',
            customClass: { popup: 'rounded-5 border shadow-sm' }
        });
        
        // Kosongkan form kembali setelah tombol sukses ditekan
        document.getElementById('newsletter-email').value = '';
    }

    // Fungsi interaktif dummy untuk halaman statis pelengkap dokumen
    function pemicuSupportAlert(namaHalaman) {
        Swal.fire({
            title: 'Halaman ' + namaHalaman + ' 📖',
            text: 'Dokumen informasi ini sedang disiapkan oleh tim developer kami untuk rilis versi selanjutnya.',
            icon: 'info',
            confirmButtonColor: '#8C6A2F',
            background: '#ffffff',
            customClass: { popup: 'rounded-5 border shadow-sm' }
        });
    }
</script>

<style>
/* ================= FOOTER ARCHITECTURE DESIGN SYSTEM ================= */
.footer {
    margin-top: 100px;
    background: linear-gradient(180deg, #8C6A2F, #6B4F1D);
    border-radius: 50px 50px 0 0;
    padding: 80px 0 35px;
    color: white;
    position: relative;
    overflow: hidden;
    font-family: 'Poppins', sans-serif;
}
.footer *, .footer *::before, .footer *::after {
    box-sizing: border-box;
}

/* DECORATION MATTE WATERMARK BACKGROUND ELEMENTS */
.footer::before {
    content: "";
    position: absolute;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, .05);
    border-radius: 50%;
    top: -100px;
    right: -100px;
}
.footer::after {
    content: "";
    position: absolute;
    width: 220px;
    height: 220px;
    background: rgba(255, 255, 255, .05);
    border-radius: 50%;
    bottom: -100px;
    left: -80px;
}

/* WRAPPER COLS MATRIX */
.footer-wrapper {
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.5fr;
    gap: 50px;
}

/* BRAND COLUMN DETAILED STYLES */
.footer-logo {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}
.footer-logo-icon {
    width: 65px;
    height: 65px;
    border-radius: 20px;
    background: rgba(255, 255, 255, .12);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
}
.footer-logo h3 {
    margin: 0;
    font-size: 24px;
    font-weight: 700;
}
.footer-logo span {
    color: rgba(255, 255, 255, .8);
    font-size: 13px;
}
.footer-brand p {
    color: rgba(255, 255, 255, .85);
    line-height: 1.8;
    max-width: 400px;
    font-size: 14px;
}

/* MENUS COLUMN STYLES LINKS */
.footer-column h4 {
    margin-bottom: 25px;
    font-weight: 700;
    font-size: 18px;
    letter-spacing: 0.3px;
}
.footer-column a {
    display: block;
    margin-bottom: 14px;
    color: rgba(255, 255, 255, .85);
    font-size: 14.5px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.footer-column a:hover {
    color: white;
    transform: translateX(6px);
}

/* SOCIAL CHIPS MATRIX ICON BUTTON */
.footer-social {
    display: flex;
    gap: 14px;
    margin-top: 25px;
}
.footer-social a {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: rgba(255, 255, 255, .12);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    transition: all 0.3s ease;
}
.footer-social a:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, .25);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

/* NEWSLETTER INPUT BOX COMPONENT */
.footer-newsletter p {
    color: rgba(255, 255, 255, .85);
    margin-bottom: 20px;
    font-size: 14px;
    line-height: 1.6;
}
.newsletter-box {
    display: flex;
    background: white;
    border-radius: 50px;
    overflow: hidden;
    padding: 4px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}
.newsletter-box input {
    flex: 1;
    border: none;
    outline: none;
    padding: 12px 18px;
    font-size: 13.5px;
    color: #333;
    font-family: 'Poppins', sans-serif;
}
.newsletter-box input::placeholder {
    color: #aaa;
}
.newsletter-box button {
    border: none;
    background: linear-gradient(135deg, #8C6A2F, #B68D40);
    color: white;
    padding: 0 24px;
    font-weight: 600;
    font-size: 13.5px;
    border-radius: 50px;
    cursor: pointer;
    transition: transform 0.2s ease;
}
.newsletter-box button:hover {
    transform: scale(1.03);
}

/* BOTTOM AREA INFORMATION BAR */
.footer-bottom {
    position: relative;
    z-index: 2;
    margin-top: 60px;
    padding-top: 25px;
    border-top: 1px solid rgba(255, 255, 255, .15);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}
.footer-bottom p, .footer-bottom span {
    margin: 0;
    color: rgba(255, 255, 255, .8);
    font-size: 13.5px;
}

/* TUNING CORNER MODAL CLASS FOR SWEETALERT */
.rounded-5 {
    border-radius: 24px !important;
}

/* BREAKPOINTS GRAPHICS MATRIX RESPONSIVE MANAGER */
@media(max-width: 991px) {
    .footer-wrapper { grid-template-columns: 1fr 1fr; gap: 40px; }
}
@media(max-width: 768px) {
    .footer { border-radius: 35px 35px 0 0; padding: 60px 0 30px; }
    .footer-wrapper { grid-template-columns: 1fr; gap: 35px; }
    .footer-bottom { text-align: center; justify-content: center; flex-direction: column; gap: 8px; }
}
</style>
{{-- Footer Component for Laundry Website --}}
<footer class="site-footer">
    <div class="footer-container">
        {{-- Business Location Section --}}
        <div class="footer-section location">
            <h3>Our Location</h3>
            <address>
                Jalan Jenderal Sudirman Kav 52-53,<br> South Jakarta 12190
            </address>
        </div>

        {{-- Contact Information Section --}}
        <div class="footer-section contact">
            <h3>Contact Us</h3>
            <div class="contact-info">
                <p>
                    <i class="fas fa-phone"></i> 
                    <span class="phone-number">(+62) 896-5549-5354</span>
                </p>
            </div>
        </div>

        {{-- Social Media Section --}}
        <div class="footer-section social-media">
            <h3>Follow Us</h3>
            <div class="social-links">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&pp=ygUIcmlja3JvbGw%3D" target="_blank" class="social-link">
                    <i class="fab fa-instagram"></i>
                    <span>Instagram</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Copyright Section --}}
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} FreshLeaf Laundry. All Rights Reserved.</p>
    </div>
</footer>

{{-- Optional Footer Styles (can be moved to a separate CSS file) --}}

<style>
    .site-footer {
        background-color: #f8f9fa;
        color: #333;
        padding: 2rem 0;
        margin-top: 2rem;
    }
    
    .footer-container {
        display: flex; /* Menggunakan flexbox */
        justify-content: space-around; /* Menyebar elemen secara merata */
        flex-direction: row; /* Menampilkan elemen secara horizontal */
        flex-wrap: wrap; /* Membungkus elemen jika ruang tidak cukup */
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-section {
        margin: 0 1rem;
        text-align: center;
        flex: 1; /* Membuat setiap section memiliki lebar yang sama */
    }

    .footer-section h3 {
        border-bottom: 2px solid #007bff;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }

    .social-links a {
        color: #007bff;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .social-links a i {
        margin-right: 0.5rem;
        font-size: 1.5rem;
    }

    .footer-bottom {
        text-align: center;
        padding-top: 1rem;
        margin-top: 1rem;
        border-top: 1px solid #ddd;
    }
</style>


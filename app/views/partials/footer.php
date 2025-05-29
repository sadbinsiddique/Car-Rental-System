<style>
.footer {
    background-color: var(--primary-color-dark);
    position: relative;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(to right, var(--primary-color), var(--primary-color-dark));
}

.footer__container {
    padding-top: 4rem;
    padding-bottom: 2rem;
}

.footer__logo {
    margin-bottom: 1.5rem;
}

.footer__logo .logo {
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.footer__logo img {
    max-width: 45px;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
}

.footer__logo span {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--white);
}

.footer__col h4 {
    position: relative;
    padding-bottom: 12px;
    margin-bottom: 1.5rem;
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--white);
}

.footer__col h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background-color: var(--primary-color);
}

.footer__links {
    display: grid;
    gap: 1rem;
}

.footer__links a {
    display: flex;
    align-items: center;
    color: var(--extra-light);
    opacity: 0.85;
    transition: all 0.3s ease;
}

.footer__links a:hover {
    color: var(--primary-color);
    opacity: 1;
    transform: translateX(5px);
}

.footer__socials {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 1.5rem;
}

.footer__socials a {
    display: grid;
    place-items: center;
    width: 40px;
    height: 40px;
    font-size: 1.2rem;
    color: var(--text-dark);
    background-color: var(--white);
    border-radius: 50%;
    transition: all 0.3s ease;
}

.footer__socials a:hover {
    color: var(--white);
    background-color: var(--primary-color);
    transform: translateY(-3px);
    box-shadow: 0 6px 10px rgba(0,0,0,0.15);
}

.footer__bar {
    padding: 1.5rem;
    text-align: center;
    font-size: 0.9rem;
    color: var(--white);
    background-color: rgba(0, 0, 0, 0.1);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer__bar a {
    color: var(--primary-color);
    font-weight: 500;
}

.footer__bar a:hover {
    text-decoration: underline;
}

/* Improved layout for mobile */
@media (max-width: 768px) {
    .footer__col h4::after {
        width: 30px;
    }
    
    .footer__socials {
        flex-wrap: wrap;
    }
}
</style>

<footer class="footer">
    <div class="section__container footer__container">
        <div class="footer__col">
            <div class="footer__logo">                <a href="/" class="logo">
                    <img src="assets/logo-white.png" alt="logo" />
                    <span>কার রেন্টাল</span>
                </a>
            </div>
            <p>
                আমরা আপনাকে সেরা যানবাহন এবং নির্বিঘ্ন ভাড়ার অভিজ্ঞতা দিতে এখানে আছি।  
                আপডেট, বিশেষ অফার এবং আরও জানতে আমাদের সাথে থাকুন।  
                আত্মবিশ্বাসের সঙ্গে ড্রাইভ করুন!
            </p>
            <ul class="footer__socials">
                <li><a href="#" aria-label="Facebook"><i class="ri-facebook-fill"></i></a></li>
                <li><a href="#" aria-label="Twitter"><i class="ri-twitter-fill"></i></a></li>
                <li><a href="#" aria-label="LinkedIn"><i class="ri-linkedin-fill"></i></a></li>
                <li><a href="#" aria-label="Instagram"><i class="ri-instagram-line"></i></a></li>
                <li><a href="#" aria-label="YouTube"><i class="ri-youtube-fill"></i></a></li>
            </ul>
        </div>
        <div class="footer__col">
            <h4>আমাদের সেবা</h4>
            <ul class="footer__links">
                <li><a href="/#home"><i class="ri-arrow-right-s-line"></i> হোম</a></li>
                <li><a href="/#about"><i class="ri-arrow-right-s-line"></i> আমাদের সম্পর্কে</a></li>
                <li><a href="/#deals"><i class="ri-arrow-right-s-line"></i> ভাড়ার ডিল</a></li>
                <li><a href="/#choose"><i class="ri-arrow-right-s-line"></i> কেন আমাদের বেছে নেবেন</a></li>
                <li><a href="/#client"><i class="ri-arrow-right-s-line"></i> গ্রাহক মতামত</a></li>
            </ul>
        </div>
        <div class="footer__col">
            <h4>গাড়ির মডেল</h4>
            <ul class="footer__links">
                <li><a href="#"><i class="ri-arrow-right-s-line"></i> টয়োটা করোলা</a></li>
                <li><a href="#"><i class="ri-arrow-right-s-line"></i> টয়োটা নোহা</a></li>
                <li><a href="#"><i class="ri-arrow-right-s-line"></i> টয়োটা অলিয়ন</a></li>
                <li><a href="#"><i class="ri-arrow-right-s-line"></i> টয়োটা প্রিমিও</a></li>
                <li><a href="#"><i class="ri-arrow-right-s-line"></i> মিত্রুবিশি পাজেরো</a></li>
            </ul>
        </div>
        <div class="footer__col">
            <h4>যোগাযোগ</h4>
            <ul class="footer__links">
                <li>
                    <a href="#">
                        <span><i class="ri-phone-fill"></i></span> +৮৮০ ১৩৪৫৬৭৮৯১
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><i class="ri-map-pin-fill"></i></span> ঢাকা, বাংলাদেশ
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><i class="ri-mail-fill"></i></span> info@cr.com
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><i class="ri-time-fill"></i></span> সোম-শুক্র: সকাল ৯টা - সন্ধ্যা ৬টা
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer__bar">
        <p>
            &copy; <span id="year"></span>
            <a href="https://github.com/sadbinsiddique/Car-Rental-System" target="_blank" rel="noopener noreferrer">
                ওয়েব টেক প্রকল্প
            </a>. সর্বস্বত্ব সংরক্ষিত।
        </p>
    </div>
</footer>

<script>
    // Set current year in footer
    document.getElementById('year').textContent = new Date().getFullYear();
    
    // Highlight active nav link based on scroll position
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('section, header .header__container');
        const navLinks = document.querySelectorAll('.nav__links a');
        
        window.addEventListener('scroll', function() {
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                
                if(window.scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if(link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    });
</script>

<script src="https://unpkg.com/scrollreveal"></script>

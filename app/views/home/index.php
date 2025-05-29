<?php
$title = "Car Rental - Home";
$showNavigation = true;
$showFooter = true;
$currentPage = 'home';

ob_start();
?>

<!-- Hero Section -->
<div class="header__container" id="home">    <div class="header__image">
        <img src="assets/header.png" alt="header" />
    </div>
    <div class="header__content">
        <h2>১০০% বিশ্বস্ত গাড়ি ভাড়ার প্ল্যাটফর্ম বাংলাদেশে 👍</h2>
        <h1>দ্রুত এবং সহজ উপায়ে গাড়ি ভাড়া নিন</h1>
        <p class="section__description">
            একটি নিরবিচার, প্রিমিয়াম গাড়ি ভাড়ার অভিজ্ঞতা উপভোগ করুন। আপনার স্টাইল ও প্রয়োজন অনুযায়ী প্রিমিয়াম গাড়ি নির্বাচন করুন এবং আত্মবিশ্বাসের সঙ্গে রাস্তায় নামুন।
            দ্রুত, সহজ এবং নির্ভরযোগ্য - আজই আপনার যাত্রা শুরু করুন!
        </p>
    </div>
</div>

<!-- Search Form -->
<section class="header__form">
    <form action="/vehicles/search" method="GET">
        <div class="input__group">
            <label for="location">পিক আপ ও রিটার্ন লোকেশন</label>
            <input type="text" name="location" id="location" placeholder="গুলশান, ঢাকা" />
        </div>
        <div class="input__group">
            <label for="start_date">পিক আপ তারিখ</label>
            <input type="datetime-local" name="start_date" id="start_date" />
        </div>
        <div class="input__group">
            <label for="end_date">রিটার্ন তারিখ</label>
            <input type="datetime-local" name="end_date" id="end_date" />
        </div>
        <button type="submit" class="btn">সার্চ করুন <i class="ri-search-line"></i></button>
    </form>
</section>

<!-- How It Works -->
<section class="section__container about__container" id="about">
    <h2 class="section__header">এটি কীভাবে কাজ করে</h2>
    <p class="section__description">
        আমাদের কাছ থেকে গাড়ি ভাড়া নেওয়া খুবই সহজ! আপনার লোকেশন, তারিখ নির্বাচন করুন এবং বুকিং সম্পন্ন করুন। আমরা বাকিটা দেখবো—একটি নিরবিঘ্ন যাত্রার জন্য প্রস্তুত থাকুন।
    </p>
    <div class="about__grid">
        <div class="about__card">
            <span><i class="ri-map-pin-2-fill"></i></span>
            <h4>লোকেশন নির্বাচন</h4>
            <p>বিভিন্ন পিক-আপ লোকেশন থেকে নির্বাচন করুন, আপনার প্রয়োজন অনুসারে – হোক সেটা বাসার কাছে, অফিস বা এয়ারপোর্ট।</p>
        </div>
        <div class="about__card">
            <span><i class="ri-calendar-event-fill"></i></span>
            <h4>পিক আপ তারিখ</h4>
            <p>নির্ভুল তারিখ ও সময় নির্বাচন করুন, যাতে আপনার গাড়ি নির্দিষ্ট সময়ে প্রস্তুত থাকে।</p>
        </div>
        <div class="about__card">
            <span><i class="ri-roadster-fill"></i></span>
            <h4>গাড়ি বুক করুন</h4>
            <p>কয়েকটি ক্লিকেই বুকিং সম্পন্ন করুন, আর আমরা আপনার জন্য নিরবিচারে প্রস্তুত রাখব গাড়িটি।</p>
        </div>
    </div>
</section>

<!-- Rental Deals -->
<section class="deals" id="deals">
    <div class="section__container deals__container">
        <h2 class="section__header">জনপ্রিয় গাড়ি ভাড়ার ডিল</h2>
        <p class="section__description">আমাদের নির্বাচিত সেরা গাড়ি ভাড়ার প্যাকেজগুলো দেখুন, যেগুলো আপনাকে সর্বোচ্চ মান এবং অভিজ্ঞতা দেবে।</p>
        
        <div class="deals__tabs">
            <button class="btn active" data-id="Tesla">টেসলা</button>
            <button class="btn" data-id="Mitsubishi">মিত্সুবিশি</button>
            <button class="btn" data-id="Mazda">মাজদা</button>
            <button class="btn" data-id="Toyota">টয়োটা</button>
            <button class="btn" data-id="Honda">হোন্ডা</button>
        </div>

        <!-- Tesla Tab -->
        <div id="Tesla" class="tab__content active">            <div class="deals__card">
                <img src="assets/deals-1.png" alt="Tesla Model S" />
                <div class="deals__rating">
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-line"></i></span>
                    <span>(৫৫০)</span>
                </div>
                <h4>টেসলা মডেল এস</h4>
                <div class="deals__card__grid">
                    <div><span><i class="ri-group-line"></i></span>৪ জন</div>
                    <div><span><i class="ri-steering-2-line"></i></span>অটোপাইলট</div>
                    <div><span><i class="ri-speed-up-line"></i></span>৪০০ কিমি</div>
                    <div><span><i class="ri-car-line"></i></span>ইলেকট্রিক</div>
                </div>
                <hr />
                <div class="deals__card__footer">
                    <h3>৳৮০০০<span>/প্রতি দিন</span></h3>
                    <a href="/vehicles/1">ভাড়া নিন <span><i class="ri-arrow-right-line"></i></span></a>
                </div>
            </div>
              <div class="deals__card">
                <img src="assets/deals-2.png" alt="Tesla Model 3" />
                <div class="deals__rating">
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-line"></i></span>
                    <span>(৪৫০)</span>
                </div>
                <h4>টেসলা মডেল ৩</h4>
                <div class="deals__card__grid">
                    <div><span><i class="ri-group-line"></i></span>৪ জন</div>
                    <div><span><i class="ri-steering-2-line"></i></span>অটোপাইলট</div>
                    <div><span><i class="ri-speed-up-line"></i></span>৩৫০ কিমি</div>
                    <div><span><i class="ri-car-line"></i></span>ইলেকট্রিক</div>
                </div>
                <hr />
                <div class="deals__card__footer">
                    <h3>৳৬০০০<span>/প্রতি দিন</span></h3>
                    <a href="/vehicles/2">ভাড়া নিন <span><i class="ri-arrow-right-line"></i></span></a>
                </div>
            </div>
              <div class="deals__card">
                <img src="assets/deals-3.png" alt="Tesla Model Y" />
                <div class="deals__rating">
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-line"></i></span>
                    <span>(৫৫০)</span>
                </div>
                <h4>টেসলা মডেল ওয়াই</h4>
                <div class="deals__card__grid">
                    <div><span><i class="ri-group-line"></i></span>৭ জন</div>
                    <div><span><i class="ri-steering-2-line"></i></span>অটোপাইলট</div>
                    <div><span><i class="ri-speed-up-line"></i></span>৪০০ কিমি</div>
                    <div><span><i class="ri-car-line"></i></span>ইলেকট্রিক</div>
                </div>
                <hr />
                <div class="deals__card__footer">
                    <h3>৳৭৫০০<span>/প্রতি দিন</span></h3>
                    <a href="/vehicles/3">ভাড়া নিন <span><i class="ri-arrow-right-line"></i></span></a>
                </div>
            </div>
        </div>

        <!-- Other tabs content will be loaded dynamically -->
        <div id="Mitsubishi" class="tab__content">
            <!-- Mitsubishi vehicles will be loaded here -->
        </div>
        
        <div id="Mazda" class="tab__content">
            <!-- Mazda vehicles will be loaded here -->
        </div>
        
        <div id="Toyota" class="tab__content">
            <!-- Toyota vehicles will be loaded here -->
        </div>
        
        <div id="Honda" class="tab__content">
            <!-- Honda vehicles will be loaded here -->
        </div>
    </div>
</section>

<!-- Showroom Section -->
<section class="section__container showroom__container" id="showroom">
    <h2 class="section__header">Explore Our Showroom</h2>
    <p class="section__description">
        Discover our wide range of premium vehicles. Click on a car to see more details and a 3D view.
    </p>
    <div class="deals__grid"> <!-- Using deals__grid for similar styling, can be renamed to showroom__grid -->
        <!-- Car Card 1 -->
        <div class="deals__card"> <!-- Using deals__card for similar styling, can be renamed to showroom__card -->
            <img src="assets/car_placeholder_1.png" alt="Luxury Sedan" />
            <h4>Luxury Sedan Model X</h4>
            <p style="padding: 0 1rem 1rem 1rem; text-align: center; font-size: 0.9rem; color: #555;">Experience unparalleled comfort and style. Perfect for executive travel and special occasions.</p>
            <hr />
            <div class="deals__card__footer">
                <h3>Inquire</h3>
                <a href="#" class="btn">View Details & 3D</a>
            </div>
        </div>
        <!-- Car Card 2 -->
        <div class="deals__card"> <!-- Using deals__card for similar styling, can be renamed to showroom__card -->
            <img src="assets/car_placeholder_2.png" alt="SUV Adventure" />
            <h4>SUV Adventure Pro</h4>
            <p style="padding: 0 1rem 1rem 1rem; text-align: center; font-size: 0.9rem; color: #555;">Ready for any terrain. Spacious and powerful for your next family adventure or off-road trip.</p>
            <hr />
            <div class="deals__card__footer">
                <h3>Inquire</h3>
                <a href="#" class="btn">View Details & 3D</a>
            </div>
        </div>
        <!-- Car Card 3 -->
        <div class="deals__card"> <!-- Using deals__card for similar styling, can be renamed to showroom__card -->
            <img src="assets/car_placeholder_3.png" alt="Electric City Car" />
            <h4>Electric City Car Z</h4>
            <p style="padding: 0 1rem 1rem 1rem; text-align: center; font-size: 0.9rem; color: #555;">Eco-friendly and agile. Ideal for navigating the city with ease and zero emissions.</p>
            <hr />
            <div class="deals__card__footer">
                <h3>Inquire</h3>
                <a href="#" class="btn">View Details & 3D</a>
            </div>
        </div>
        <!-- Add more car cards as needed -->
    </div>
</section>

<!-- Why Choose Us -->
<section class="choose" id="choose">
    <div class="section__container choose__container">
        <div class="choose__content">
            <h2 class="section__header">কেন আমাদের বেছে নেবেন</h2>
            <p class="section__description">
                আমরা শুধু গাড়ি ভাড়া দেই না, আমরা একটি সম্পূর্ণ অভিজ্ঞতা প্রদান করি। 
                আমাদের পেশাদার সেবা এবং বিশ্বস্ততার জন্য আমাদের বেছে নিন।
            </p>
            <ul class="choose__list">
                <li>
                    <span><i class="ri-checkbox-fill"></i></span>
                    সেরা দাম গ্যারান্টি
                </li>
                <li>
                    <span><i class="ri-checkbox-fill"></i></span>
                    ২৪/৭ গ্রাহক সেবা
                </li>
                <li>
                    <span><i class="ri-checkbox-fill"></i></span>
                    ফ্রি ক্যানসেলেশন
                </li>
                <li>
                    <span><i class="ri-checkbox-fill"></i></span>
                    সম্পূর্ণ বীমা কভার
                </li>
            </ul>
        </div>
        <div class="choose__image">
            <img src="assets/choose.png" alt="choose" />
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="client" id="client">
    <div class="section__container client__container">
        <h2 class="section__header">আমাদের সন্তুষ্ট গ্রাহকদের মতামত</h2>
        <p class="section__description">
            হাজারো সন্তুষ্ট গ্রাহকের মতামত দেখুন, যারা আমাদের সেবা নিয়ে খুশি।
        </p>
        <!-- Swiper -->
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="client__card">
                        <img src="assets/client-1.jpg" alt="client" />
                        <div class="client__content">
                            <div class="client__rating">
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                            </div>
                            <p>
                                অসাধারণ সেবা! গাড়িটি একদম পরিষ্কার ছিল এবং সময়মতো পেয়েছি। 
                                দারুণ অভিজ্ঞতা ছিল।
                            </p>
                            <h4>আহমেদ করিম</h4>
                            <h5>ব্যবসায়ী</h5>
                        </div>
                    </div>
                </div>
                
                <div class="swiper-slide">
                    <div class="client__card">
                        <img src="assets/client-2.jpg" alt="client" />
                        <div class="client__content">
                            <div class="client__rating">
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-line"></i></span>
                            </div>
                            <p>
                                খুবই সুবিধাজনক এবং সাশ্রয়ী। গ্রাহক সেবা চমৎকার ছিল। 
                                আবার ব্যবহার করব।
                            </p>
                            <h4>ফাতেমা বেগম</h4>
                            <h5>শিক্ষক</h5>
                        </div>
                    </div>
                </div>
                
                <div class="swiper-slide">
                    <div class="client__card">
                        <img src="assets/client-3.jpg" alt="client" />
                        <div class="client__content">
                            <div class="client__rating">
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                                <span><i class="ri-star-fill"></i></span>
                            </div>
                            <p>
                                দ্রুত এবং নির্ভরযোগ্য সেবা। গাড়িটি একদম নতুনের মতো ছিল। 
                                সুপারিশ করব।
                            </p>
                            <h4>রহিম উদ্দিন</h4>
                            <h5>প্রকৌশলী</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="subscribe">
    <div class="section__container subscribe__container">
        <div class="subscribe__content">
            <h2 class="section__header">নিউজলেটার সাবস্ক্রাইব করুন</h2>
            <p class="section__description">
                বিশেষ অফার এবং নতুন গাড়ির আপডেট পেতে আমাদের নিউজলেটার সাবস্ক্রাইব করুন।
            </p>
            <form class="subscribe__form" action="/newsletter/subscribe" method="POST">
                <input type="email" name="email" placeholder="আপনার ইমেইল ঠিকানা" required />
                <button type="submit" class="btn">সাবস্ক্রাইব</button>
            </form>
        </div>
        <div class="subscribe__image">
            <img src="assets/subscribe.png" alt="subscribe" />
        </div>
    </div>
</section>

<script>
// Tab functionality for deals section
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.deals__tabs .btn');
    const tabContents = document.querySelectorAll('.tab__content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.getAttribute('data-id');
            
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked button and corresponding content
            button.classList.add('active');
            document.getElementById(targetId).classList.add('active');
        });
    });
    
    // Initialize Swiper for testimonials
    const swiper = new Swiper('.swiper', {
        direction: 'horizontal',
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 40,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 50,
            },
        },
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>

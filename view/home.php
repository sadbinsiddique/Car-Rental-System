<?php
    session_start();
    if(isset($_COOKIE['status'])){
?>

<!DOCTYPE html>
<html lang="bn">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="styles.css" />
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
        
        .footer__socials a {
          width: 36px;
          height: 36px;
          font-size: 1rem;
        }
      }
    </style>
    <title>Car Rental</title>
  </head>
  <body>
    <header>
      <!-- Restored original navigation structure -->
      <nav>
        <div class="nav__header">
          <div class="nav__logo">
            <a href="#" class="logo">
              <img src="assets/logo-white.png" alt="logo" class="logo-white" />
              <img src="assets/logo-dark.png" alt="logo" class="logo-dark" />
              <span>Car Rental</span>
            </a>
          </div>
          <div class="nav__menu__btn" id="menu-btn">
            <i class="ri-menu-line"></i>
          </div>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="#home">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#deals">Rental Deals</a></li>
          <li><a href="#choose">Why Choose Us</a></li>
          <li><a href="#client">Testimonials</a></li>
          <li><a href="#">Register</a></li>
        </ul>
        <div class="nav__btns">
          <a href="../controller/logout.php" class="btn">Logout</a>
        </div>
      </nav>
      <div class="header__container" id="home">
        <div class="header__image">
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
    </header>

    <section class="header__form">
      <form action="/">
        <div class="input__group">
          <label for="location">পিক আপ ও রিটার্ন লোকেশন</label>
          <input
            type="text"
            name="location"
            id="location"
            placeholder="গুলশান, ঢাকা"
          />
        </div>
        <div class="input__group">
          <label for="start">পিক আপ তারিখ</label>
          <input
            type="text"
            name="start"
            id="start"
            placeholder="আগস্ট ০১, সকাল ১০:০০"
          />
        </div>
        <div class="input__group">
          <label for="stop">রিটার্ন তারিখ</label>
          <input
            type="text"
            name="stop"
            id="stop"
            placeholder="আগস্ট ০৬,  ০৮:০০ PM"
          />
        </div>
        <button class="btn">সার্চ করুন <i class="ri-search-line"></i></button>
      </form>
    </section>

    <section class="section__container about__container" id="about">
      <h2 class="section__header">এটি কীভাবে কাজ করে</h2>
      <p class="section__description">
        আমাদের কাছ থেকে গাড়ি ভাড়া নেওয়া খুবই সহজ! আপনার লোকেশন, তারিখ নির্বাচন করুন এবং বুকিং সম্পন্ন করুন। আমরা বাকিটা দেখবো—একটি নিরবিঘ্ন যাত্রার জন্য প্রস্তুত থাকুন।
      </p>
      <div class="about__grid">
        <div class="about__card">
          <span><i class="ri-map-pin-2-fill"></i></span>
          <h4> লোকেশন নির্বাচন</h4>
          <p>
            বিভিন্ন পিক-আপ লোকেশন থেকে নির্বাচন করুন, আপনার প্রয়োজন অনুসারে – হোক সেটা বাসার কাছে, অফিস বা এয়ারপোর্ট।
          </p>
        </div>
        <div class="about__card">
          <span><i class="ri-calendar-event-fill"></i></span>
          <h4>পিক আপ তারিখ</h4>
          <p>
            নির্ভুল তারিখ ও সময় নির্বাচন করুন, যাতে আপনার গাড়ি নির্দিষ্ট সময়ে প্রস্তুত থাকে。
          </p>
        </div>
        <div class="about__card">
          <span><i class="ri-roadster-fill"></i></span>
          <h4>গাড়ি বুক করুন</h4>
          <p>কয়েকটি ক্লিকেই বুকিং সম্পন্ন করুন, আর আমরা আপনার জন্য নিরবিচারে প্রস্তুত রাখব গাড়িটি।</p>
        </div>
      </div>
    </section>

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
        <div id="Tesla" class="tab__content active">
          <div class="deals__card">
            <img src="assets/deals-1.png" alt="deals" />
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
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>অটোপাইলট
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>৪০০ কিমি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ইলেকট্রিক
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳৮০০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-2.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(৪৫০)</span>
            </div>
            <h4>টেসলা মডেল ই</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>অটোপাইলট
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>৪০০ কিমি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ইলেকট্রিক
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳৮০০০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-3.png" alt="deals" />
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
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>অটোপাইলট
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>৪০০ কিমি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ইলেকট্রিক
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳৮০০০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
        </div>
        <div id="Mitsubishi" class="tab__content">
          <div class="deals__card">
            <img src="assets/deals-4.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(৩৫০)</span>
            </div>
            <h4>মিরাজ</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১২০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-5.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(২৫০)</span>
            </div>
            <h4>এক্সপ্যান্ডার</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১৫০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-6.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(১৫০)</span>
            </div>
            <h4>পাজেরো স্পোর্টস</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১৮০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
        </div>
        <div id="Mazda" class="tab__content">
          <div class="deals__card">
            <img src="assets/deals-7.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(২০০)</span>
            </div>
            <h4>মাজদা CX5</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১৩০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-8.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(১০০)</span>
            </div>
            <h4>মাজদা CX-30</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳২০০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-9.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(১৮০)</span>
            </div>
            <h4>মাজদা CX-9</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১৮০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
        </div>
        <div id="Toyota" class="tab__content">
          <div class="deals__card">
            <img src="assets/deals-10.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(২৫০)</span>
            </div>
            <h4>করোলা</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১৮০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-11.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(৫৫০)</span>
            </div>
            <h4>ইনোভা</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১৫০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-12.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(১৮০)</span>
            </div>
            <h4>ফরচুনার</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১৯০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
        </div>
        <div id="Honda" class="tab__content">
          <div class="deals__card">
            <img src="assets/deals-13.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(২০০)</span>
            </div>
            <h4>অ্যামেজ</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১০০<span>/প্রতি দিন</span></h3>
              <a href="#">
          ভাড়া নিন
          <span><i class="ri-arrow-right-line"></i></span>
              </a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-14.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(৩৫০)</span>
            </div>
            <h4>এলেভেট</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১২০<span>/প্রতি দিন</span></h3>
              <a href="#">ভাড়া নিন <span><i class="ri-arrow-right-line"></i></span></a>
            </div>
          </div>
          <div class="deals__card">
            <img src="assets/deals-15.png" alt="deals" />
            <div class="deals__rating">
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-fill"></i></span>
              <span><i class="ri-star-line"></i></span>
              <span>(৩০০)</span>
            </div>
            <h4>সিটি</h4>
            <div class="deals__card__grid">
              <div>
          <span><i class="ri-group-line"></i></span>৪ জন
              </div>
              <div>
          <span><i class="ri-steering-2-line"></i></span>ম্যানুয়াল
              </div>
              <div>
          <span><i class="ri-speed-up-line"></i></span>১৮ কিমি/লি
              </div>
              <div>
          <span><i class="ri-car-line"></i></span>ডিজেল
              </div>
            </div>
            <hr />
            <div class="deals__card__footer">
              <h3>৳১৫০<span>/প্রতি দিন</span></h3>
              <a href="#">ভাড়া নিন <span><i class="ri-arrow-right-line"></i></span></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="choose__container" id="choose">
      <div class="choose__image">
        <img src="assets/choose.png" alt="choose" />
      </div>
      <div class="choose__content">
        <h2 class="section__header">কেন আমাদের বেছে নেবেন</h2>
        <p class="section__description">
          আমাদের কার ভাড়ার সেবার অনন্যতা অনুভব করুন। বিশ্বস্ত যানবাহন, অসাধারণ
          গ্রাহক সেবা এবং প্রতিযোগিতামূলক মূল্য দিয়ে আমরা নিশ্চিত করি আপনার ভাড়ার
          অভিজ্ঞতা হবে নির্বিঘ্ন।
        </p>
        <div class="choose__grid">
          <div class="choose__card">
            <span><i class="ri-customer-service-line"></i></span>
            <div>
              <h4>গ্রাহক সেবা</h4>
              <p>আমাদের নিবেদিত সহায়তা দল ২৪/৭ সবসময় আপনার পাশে আছে।</p>
            </div>
          </div>
          <div class="choose__card">
            <span><i class="ri-map-pin-line"></i></span>
            <div>
              <h4>বহু লোকেশন</h4>
              <p>আপনার যাত্রার প্রয়োজন অনুসারে সুবিধাজনক পিক-আপ ও ড্রপ-অফ পয়েন্ট।</p>
            </div>
          </div>
          <div class="choose__card">
            <span><i class="ri-wallet-line"></i></span>
            <div>
              <h4>সেরা মূল্য</h4>
              <p>প্রতিযোগিতামূলক দাম ও মানসম্মত সেবা পেয়ে যান।</p>
            </div>
          </div>
          <div class="choose__card">
            <span><i class="ri-user-star-line"></i></span>
            <div>
              <h4>অভিজ্ঞ চালক</h4>
              <p>অনুরোধকৃত সময়ে পেশাদার এবং বিশ্বস্ত চালক আপনার সুবিধার জন্য প্রস্তুত।</p>
            </div>
          </div>
          <div class="choose__card">
            <span><i class="ri-verified-badge-line"></i></span>
            <div>
              <h4>নির্ভরযোগ্য ব্র্যান্ড</h4>
              <p>বিশ্বাসযোগ্য ও সঠিকভাবে রক্ষণাবেক্ষণ করা গাড়ি ব্র্যান্ড থেকে বেছে নিন।</p>
            </div>
          </div>
          <div class="choose__card">
              <span><i class="ri-calendar-close-line"></i></span>
            <div>
              <h4>ফ্রি বাতিলকরণ</h4>
              <p>নরম বুকিং নীতিসহ ফ্রি বাতিলকরণের সুবিধা উপভোগ করুন।</p>
            </div>
          </div>          
          </div>
        </div>
      </div>
    </section>

    <section class="subscribe__container">
      <div class="subscribe__image">
        <img src="assets/subscribe.png" alt="সাবস্ক্রাইব" />
      </div>
      <div class="subscribe__content">
        <h2 class="section__header">
          সর্বশেষ গাড়ি ভাড়ার আপডেট পেতে সাবস্ক্রাইব করুন
        </h2>
        <p class="section__description">
          খবর রাখুন! সর্বশেষ গাড়ি ভাড়ার ডিল, এক্সক্লুসিভ অফার এবং আপডেট
          সরাসরি আপনার ইনবক্সে পেতে সাবস্ক্রাইব করুন। বিশেষ প্রচারণা এবং
          আমাদের ফ্লিটে নতুন সংযোজনগুলো মিস করবেন না।
        </p>
        <form action="/">
          <input type="text" placeholder="আপনার ইমেইল" />
          <button class="btn">সাবস্ক্রাইব</button>
        </form>
      </div>
    </section>

    <section class="section__container client__container" id="client">
      <h2 class="section__header">গ্রাহকরা আমাদের সম্পর্কে কী বলছেন?</h2>
      <p class="section__description">
        জানুন কেন আমাদের গ্রাহকরা আমাদের সাথে গাড়ি ভাড়া করতে ভালোবাসেন! আসল
        রিভিউ এবং টেস্টিমনিয়াল পড়ে দেখুন আমরা কীভাবে ব্যতিক্রমী সেবা প্রদান
        করি।
      </p>
      <!-- Slider main container -->
      <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <div class="client__card">
              <div class="client__details">
                <img src="assets/client-1.jpg" alt="client" />
                <div>
                  <h4>Sarah Johnson</h4>
                  <div class="client__rating">
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-line"></i></span>
                  </div>
                </div>
              </div>
              <p>
                এই সার্ভিস থেকে গাড়ি ভাড়া নিয়ে আমার অভিজ্ঞতা ছিল অসাধারণ। বুকিং প্রক্রিয়াটি দ্রুত এবং সহজ ছিল, এবং গাড়িটি নিখুঁত অবস্থায় ছিল। অত্যন্ত পরামর্শযোগ্য!
              </p>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="client__card">
              <div class="client__details">
                <img src="assets/client-2.jpg" alt="client" />
                <div>
                  <h4>Michael Adams</h4>
                  <div class="client__rating">
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-line"></i></span>
                  </div>
                </div>
              </div>
              <p>
                কাস্টমার সাপোর্ট ছিল চমৎকার! তারা আমার সব প্রশ্নের উত্তর দিয়েছিল, এবং আমি আমার বুকিং নিয়ে আত্মবিশ্বাসী বোধ করেছি। আমি অবশ্যই আবার তাদের কাছ থেকে গাড়ি ভাড়া নেব。
              </p>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="client__card">
              <div class="client__details">
                <img src="assets/client-3.jpg" alt="client" />
                <div>
                  <h4>Emily Martinez</h4>
                  <div class="client__rating">
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-line"></i></span>
                  </div>
                </div>
              </div>
              <p>
                সাশ্রয়ী মূল্য এবং বিস্তৃত যানবাহন নির্বাচন! আমি ঠিকই যা প্রয়োজন তা পেয়েছিলাম, এবং পিক-আপ ও ড্রপ-অফ প্রক্রিয়াটি নির্বিঘ্ন ছিল। আমার ভাড়াতে আমি অত্যন্ত সন্তুষ্ট।
              </p>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="client__card">
              <div class="client__details">
                <img src="assets/client-4.jpg" alt="client" />
                <div>
                  <h4>Jason Lee</h4>
                  <div class="client__rating">
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-line"></i></span>
                  </div>
                </div>
              </div>
              <p>
                ফ্রি বাতিলকরণের নমনীয়তা আমার যাত্রাকে চাপমুক্ত করেছে। আমার পরিকল্পনা পরিবর্তন করতে হয়েছিল, কিন্তু বুকিং সামঞ্জস্য করা কোনো ঝামেলা হয়নি। সার্বিকভাবে দারুণ সেবা!
              </p>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="client__card"></div>
              <div class="client__details">
                <img src="assets/client-5.jpg" alt="client" />
                <div>
                  <h4>David Thompson</h4>
                  <div class="client__rating">
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-fill"></i></span>
                    <span><i class="ri-star-line"></i></span>
                  </div>
                </div>
              </div>
              <p>
                আমি যে গাড়িটি ভাড়া নিয়েছিলাম তা ছিল অসাধারণ, এবং ড্রাইভার ছিলেন খুবই অভিজ্ঞ। এটির কারণে আমার রোড ট্রিপ আরও উপভোগ্য হয়েছে। পরবর্তী বারও আমি অবশ্যই তাদেরই ব্যবহার করব!
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="footer__logo">
            <a href="#" class="logo">
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
            <li><a href="#home"><i class="ri-arrow-right-s-line"></i> হোম</a></li>
            <li><a href="#about"><i class="ri-arrow-right-s-line"></i> আমাদের সম্পর্কে</a></li>
            <li><a href="#deals"><i class="ri-arrow-right-s-line"></i> ভাড়ার ডিল</a></li>
            <li><a href="#choose"><i class="ri-arrow-right-s-line"></i> কেন আমাদের বেছে নেবেন</a></li>
            <li><a href="#client"><i class="ri-arrow-right-s-line"></i> গ্রাহক মতামত</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="main.js"></script>
  </body>
</html>

<?php
    }else{
        header('location: login.html');
    }

?>
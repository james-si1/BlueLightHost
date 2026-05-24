@extends('frontend.layout')

@section('content')
@php
$fishImages = [];

for ($i = 1; $i <= 8; $i++) {
    foreach (['jpeg', 'jpg' , 'png' , 'webp' ] as $ext) {
    $path=public_path("frontend/img/ikan{$i}.{$ext}");

    if (file_exists($path)) {
    $fishImages[]=asset("frontend/img/ikan{$i}.{$ext}");
    break;
    }
    }
    }
    @endphp

    <style>
    .beranda-page {
    background:
    linear-gradient(rgba(0, 28, 45, 0.28), rgba(0, 28, 45, 0.42)),
    url("{{ asset('frontend/img/bgberanda.png') }}") top center / cover no-repeat;
    color: white;
    min-height: calc(100vh - 75px);
    padding: 120px 20px 80px;
    }

    .hero-section {
    width: 100%;
    max-width: 1180px;
    margin: 0 auto;
    }

    .hero-box {
    width: 100%;
    max-width: 610px;
    }

    .hero-title {
    font-size: clamp(30px, 5vw, 48px);
    line-height: 1.15;
    font-weight: 700;
    margin: 0;
    letter-spacing: 0.2px;
    color: #f3f8fb;
    }

    .hero-title span {
    background: linear-gradient(90deg, #00c6ff, #00f2c3);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 700;
    }

    .hero-desc {
    width: 100%;
    max-width: 560px;
    font-size: 15px;
    line-height: 1.6;
    margin-top: 16px;
    margin-bottom: 26px;
    color: #e4f1f7;
    font-weight: 400;
    }

    .hero-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #09b5df;
    color: white;
    padding: 13px 22px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    }

    .fish-slider {
    width: 100%;
    max-width: 980px;
    margin: 130px auto 0;
    display: grid;
    grid-template-columns: auto 1fr auto;
    align-items: center;
    gap: 18px;
    }

    .arrow {
    color: white;
    font-size: clamp(30px, 5vw, 42px);
    font-weight: bold;
    cursor: pointer;
    user-select: none;
    z-index: 2;
    transition: 0.3s;
    line-height: 1;
    }

    .arrow:hover {
    transform: scale(1.15);
    color: #04d9ff;
    }

    .fish-window {
    width: 100%;
    overflow: hidden;
    }

    .fish-track {
    display: flex;
    gap: 20px;
    transition: transform 0.5s ease;
    will-change: transform;
    }

    .fish-card {
    flex: 0 0 155px;
    width: 155px;
    height: 400px;
    overflow: hidden;
    transform: skew(-5deg);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.45);
    transition: 0.3s;
    border-radius: 4px;
    }

    .fish-card:hover {
    transform: skew(-5deg) translateY(-10px);
    }

    .fish-card img {
    width: 120%;
    height: 100%;
    object-fit: cover;
    transform: skew(5deg) translateX(-10px);
    display: block;
    }

    .slider-dots {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 25px;
    }

    .dot {
    width: 9px;
    height: 9px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    cursor: pointer;
    transition: 0.3s;
    }

    .dot.active {
    width: 25px;
    border-radius: 20px;
    background: #04d9ff;
    }

    .why-title {
    text-align: center;
    font-size: clamp(23px, 4vw, 30px);
    font-weight: 600;
    margin: 95px auto 55px;
    padding: 0 12px;
    }

    .feature-row {
    width: 100%;
    max-width: 1050px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 28px;
    padding-bottom: 40px;
    }

    .feature-card {
    min-height: 360px;
    background: rgba(0, 91, 120, 0.58);
    border-radius: 16px;
    text-align: center;
    padding: 48px 28px 34px;
    backdrop-filter: blur(3px);
    transition: 0.3s;
    }

    .feature-card:hover {
    transform: translateY(-8px);
    background: rgba(0, 110, 145, 0.68);
    }

    .feature-card i {
    font-size: clamp(54px, 7vw, 78px);
    margin-bottom: 45px;
    color: white;
    }

    .feature-card h3 {
    font-size: 21px;
    margin: 0 0 25px;
    font-weight: 700;
    }

    .feature-card p {
    font-size: 15px;
    line-height: 1.55;
    color: #eefaff;
    margin: 0;
    }

    .footer-beranda {
    background: white;
    color: #222;
    padding: 50px 20px 70px;
    }

    .footer-inner {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 40px;
    font-size: 14px;
    }

    .footer-beranda h4 {
    font-size: 15px;
    margin: 0 0 18px;
    font-weight: 700;
    }

    .footer-beranda p {
    margin: 10px 0;
    }

    @media (max-width: 900px) {
    .beranda-page {
    padding-top: 85px;
    }

    .fish-slider {
    margin-top: 80px;
    gap: 12px;
    }

    .fish-card {
    flex-basis: 135px;
    width: 135px;
    height: 340px;
    }

    .feature-row {
    grid-template-columns: 1fr;
    max-width: 420px;
    }

    .feature-card {
    min-height: auto;
    padding: 36px 24px;
    }

    .feature-card i {
    margin-bottom: 26px;
    }

    .footer-inner {
    grid-template-columns: 1fr;
    gap: 24px;
    }
    }

    @media (max-width: 600px) {
    .beranda-page {
    padding: 60px 14px 60px;
    background-position: center top;
    }

    .hero-box {
    text-align: center;
    margin: 0 auto;
    }

    .hero-desc {
    font-size: 14px;
    }

    .hero-btn {
    width: 100%;
    max-width: 300px;
    }

    .fish-slider {
    grid-template-columns: 34px 1fr 34px;
    margin-top: 55px;
    gap: 6px;
    }

    .fish-card {
    flex-basis: 118px;
    width: 118px;
    height: 280px;
    }

    .fish-track {
    gap: 14px;
    }

    .why-title {
    margin-top: 70px;
    margin-bottom: 35px;
    }

    .footer-beranda {
    padding: 38px 20px 50px;
    }
    }

    @media (max-width: 380px) {
    .fish-card {
    flex-basis: 100px;
    width: 100px;
    height: 240px;
    }
    }
    </style>

    <section class="beranda-page">
        <div class="hero-section">
            <div class="hero-box">
                <h1 class="hero-title">
                    Pilihan Ikan Hias Terbaik<br>
                    <span>Lengkap dan Berkualitas</span>
                </h1>

                <p class="hero-desc">
                    Jl. Musyawarah No., RT.6/RW.9, Kb. Jeruk, Kec. Kb. Jeruk, Kota Jakarta Barat,
                    Daerah Khusus Ibukota Jakarta 11530
                </p>

                <a href="{{ route('frontend.products.index') }}" class="hero-btn">
                    Lihat Koleksi Produk →
                </a>
            </div>
        </div>

        <div class="fish-slider">
            <div class="arrow" onclick="prevFish()">&lt;</div>

            <div class="fish-window" id="fishWindow">
                <div class="fish-track" id="fishTrack">
                    @foreach($fishImages as $index => $image)
                    <div class="fish-card">
                        <img src="{{ $image }}" alt="Ikan {{ $index + 1 }}">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="arrow" onclick="nextFish()">&gt;</div>
        </div>

        <div class="slider-dots" id="sliderDots"></div>

        <h2 class="why-title">Kenapa Memilih Blue Light Aquarium?</h2>

        <div class="feature-row">
            <div class="feature-card">
                <i class="fas fa-crown"></i>
                <h3>Kualitas Terjamin</h3>
                <p>Produk diseleksi ketat dan dipastikan standar kualitas tinggi sebelum dipasarkan</p>
            </div>

            <div class="feature-card">
                <i class="fas fa-handshake"></i>
                <h3>Terpercaya</h3>
                <p>Pelanggan yang puas dengan layanan dan keaslian produk kami</p>
            </div>

            <div class="feature-card">
                <i class="fas fa-users"></i>
                <h3>Konsultasi Gratis</h3>
                <p>Tim ahli kami siap membantu Anda mulai dari setup hingga perawatan harian</p>
            </div>
        </div>
    </section>

    <footer class="footer-beranda">
        <div class="footer-inner">
            <div>
                <h4>Use cases</h4>
                <p>UI design</p>
                <p>UX design</p>
                <p>Wireframing</p>
                <p>Diagramming</p>
                <p>Brainstorming</p>
                <p>Online whiteboard</p>
                <p>Team collaboration</p>
            </div>

            <div>
                <h4>Explore</h4>
                <p>Design</p>
                <p>Prototyping</p>
                <p>Development features</p>
                <p>Design systems</p>
                <p>Collaboration features</p>
                <p>Design process</p>
                <p>FigJam</p>
            </div>

            <div>
                <h4>Resources</h4>
                <p>Blog</p>
                <p>Best practices</p>
                <p>Colors</p>
                <p>Color wheel</p>
                <p>Support</p>
                <p>Developers</p>
                <p>Resource library</p>
            </div>
        </div>
    </footer>

    <script>
        let currentFishIndex = 0;

        const fishWindow = document.getElementById('fishWindow');
        const fishTrack = document.getElementById('fishTrack');
        const fishCards = document.querySelectorAll('.fish-card');
        const sliderDots = document.getElementById('sliderDots');

        function getGap() {
            if (!fishTrack) return 0;
            return parseInt(window.getComputedStyle(fishTrack).gap) || 0;
        }

        function getCardWidth() {
            if (!fishCards.length) return 0;
            return fishCards[0].getBoundingClientRect().width;
        }

        function getVisibleCards() {
            if (!fishWindow || !fishCards.length) return 1;

            const windowWidth = fishWindow.getBoundingClientRect().width;
            const cardWidth = getCardWidth();
            const gap = getGap();

            return Math.max(1, Math.floor((windowWidth + gap) / (cardWidth + gap)));
        }

        function getMaxIndex() {
            return Math.max(fishCards.length - getVisibleCards(), 0);
        }

        function createDots() {
            if (!sliderDots) return;

            const maxIndex = getMaxIndex();
            sliderDots.innerHTML = '';

            for (let i = 0; i <= maxIndex; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');

                if (i === currentFishIndex) {
                    dot.classList.add('active');
                }

                dot.addEventListener('click', function() {
                    currentFishIndex = i;
                    updateFishSlider();
                });

                sliderDots.appendChild(dot);
            }
        }

        function updateFishSlider() {
            if (!fishTrack) return;

            const maxIndex = getMaxIndex();
            const cardWidth = getCardWidth();
            const gap = getGap();

            currentFishIndex = Math.min(currentFishIndex, maxIndex);
            fishTrack.style.transform = `translateX(-${currentFishIndex * (cardWidth + gap)}px)`;

            document.querySelectorAll('.dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === currentFishIndex);
            });
        }

        function nextFish() {
            const maxIndex = getMaxIndex();
            currentFishIndex = currentFishIndex < maxIndex ? currentFishIndex + 1 : 0;
            updateFishSlider();
        }

        function prevFish() {
            const maxIndex = getMaxIndex();
            currentFishIndex = currentFishIndex > 0 ? currentFishIndex - 1 : maxIndex;
            updateFishSlider();
        }

        createDots();
        updateFishSlider();

        window.addEventListener('resize', function() {
            createDots();
            updateFishSlider();
        });

        if (fishCards.length > 1) {
            setInterval(function() {
                nextFish();
            }, 3500);
        }
    </script>
    @endsection
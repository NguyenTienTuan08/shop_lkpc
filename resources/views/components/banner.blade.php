<!-- Carousel Wrapper -->
<div class="carousel-wrapper">
    <div class="carousel">
        <div class="carousel-item">
            <img src="{{ asset('images/anh1.jpg') }}" class="carousel-image" alt="Banner 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/anh2.jpg') }}" class="carousel-image" alt="Banner 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/anh3.jpg') }}" class="carousel-image" alt="Banner 3">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/anh4.jpg') }}" class="carousel-image" alt="Banner 4">
        </div>

    </div>

    <!-- Dấu hiệu vị trí slide -->
    <div class="dots">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
    </div>

    <!-- Nút Chuyển Slide -->
    <button class="prev" onclick="prevSlide()">❮</button>
    <button class="next" onclick="nextSlide()">❯</button>
</div>

<!-- CSS Code -->
<style>
    .carousel-wrapper {
        position: relative;
        width: 100%;
        max-width: 1550px;
        margin: auto;
        overflow: hidden;
    }

    .carousel {
        display: flex;
        transition: transform 0.5s ease;
    }

    .carousel-item {
        min-width: 100%;
        height: 500px;
    }

    .carousel-image {
        width: 100%;
        height: 100%;
        object-fit: cover;

    }

    /* Nút chuyển slide */
    .prev,
    .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        font-size: 24px;
        z-index: 10;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }

    /* Dấu hiệu vị trí slide */
    .dots {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        justify-content: center;
    }

    .dot {
        width: 10px;
        height: 10px;
        margin: 0 5px;
        background-color: #bbb;
        border-radius: 50%;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .dot.active {
        background-color: #717171;
    }

    /* Ẩn các dấu hiệu khi không có ảnh */
    .dot:focus {
        outline: none;
    }
</style>

<!-- JavaScript Code -->
<script>
    let currentIndex = 0;
    const slides = document.querySelectorAll(".carousel-item");
    const dots = document.querySelectorAll(".dot");

    function showSlide(index) {
        currentIndex = (index + slides.length) % slides.length;
        document.querySelector(".carousel").style.transform = `translateX(-${currentIndex * 100}%)`;
        updateDots();
    }

    function prevSlide() {
        showSlide(currentIndex - 1);
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    function currentSlide(index) {
        showSlide(index - 1);
    }

    function updateDots() {
        dots.forEach((dot, i) => {
            dot.classList.toggle("active", i === currentIndex);
        });
    }

    setInterval(nextSlide, 3000); // Tự động chuyển ảnh mỗi 3 giây
</script>
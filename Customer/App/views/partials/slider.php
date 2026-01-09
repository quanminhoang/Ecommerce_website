<section class="slider">
    <div class="slides">
        <!-- radio button start -->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">
        <!-- radio button end -->

        <!-- Slide images start -->
        <div class="slide first">
            <img src="./public/img/slide-img1.jpg" alt="1">
        </div>
        <div class="slide ">
            <img src="./public/img/slide-img2.jpg" alt="2">
        </div>
        <div class="slide ">
            <img src="./public/img/slide-img3.jpg" alt="3">
        </div>
        <!-- Slide images end -->

        <!-- navigation auto start -->
        <div class="navigation-auto">
            <div class="auto-btn1"></div>
            <div class="auto-btn2"></div>
            <div class="auto-btn3"></div>
        </div>
        <!-- navigation auto end -->

        <!-- navigation manual start -->
        <!-- navigation manual end -->
    </div>
    <div class="navigation-manual">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
        <label for="radio3" class="manual-btn"></label>
    </div>
</section>
<script>
    let counter = 2;
    setInterval(function() {
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if (counter > 3) {
            counter = 1;
        }
    }, 5000);
</script>
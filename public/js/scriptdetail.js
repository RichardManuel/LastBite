document.addEventListener('DOMContentLoaded', function() {
    const btnWhatYouGet = document.getElementById('btnWhatYouGet');
    const btnPickUpTime = document.getElementById('btnPickUpTime');
    const btnEateryDetail = document.getElementById('btnEateryDetail');
    const dynamicPanelContent = document.getElementById('dynamicPanelContent');
    const navButtons = document.querySelectorAll('.nav-button');

    function clearActiveButtons() {
        navButtons.forEach(button => {
            button.classList.remove('active');
        });
    }

    function setActiveButton(button) {
        clearActiveButtons();
        button.classList.add('active');
    }

    function showWhatYouGet() {
        setActiveButton(btnWhatYouGet);
        dynamicPanelContent.className = 'container-fluid dynamic-panel-container mb-5 panel-what-you-get';
        dynamicPanelContent.innerHTML = `
            <div class="container"> 
                <div class="row align-items-center"> 
                    <div class="col-md-5 text-center text-md-start">
                        <img src="Surpised-Bag.svg" alt="Surprise Bag" class="img-fluid">
                    </div>
                    <div class="col-md-7">
                        <h3 class="fw-bold display-1">Surprise Bag</h3>
                        <p class="price">Rp 50.000</p>
                        <p class="description">A Surprise Bag is a mystery bundle of unsold but perfectly good food offered at a much lower price, ideal for food lovers who enjoy surprises and want to fight food waste!</p>
                        <button class="btn order-now-btn">Order Now</button>
                    </div>
                </div>
            </div>
        `;
    }

    function showPickUpTime() {
        setActiveButton(btnPickUpTime);
        dynamicPanelContent.className = 'container-fluid dynamic-panel-container mb-5 panel-pick-up-time';
        dynamicPanelContent.innerHTML = `
            <div class="container">
                <div class="row align-items-center"> 
                    <div class="col-md-5 text-center text-md-start">
                        <img src="Pick up time.svg" alt="Illustration" class="img-fluid"> 
                    </div>
                    <div class="col-md-7">
                        <h3>Pick Up Time Policy</h3>
                        <p class="time"><strong class="timeEat">Lunch</strong> 🕛 12:00 PM - 1:00 PM</p>
                        <div class="note mt-3">
                            <p class="mb-0"><strong class="text-warning">⚠️ Please Note:</strong></p>
                            <p class="mb-0">Orders must be picked up on time. Missed orders (after 1:00 PM for lunch, 6:00 PM for dinner) will be canceled automatically with no refund.</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    function showEateryDetail() {
    setActiveButton(btnEateryDetail);
    dynamicPanelContent.className = 'container-fluid dynamic-panel-container mb-5 panel-eatery-detail';
    dynamicPanelContent.innerHTML = `
        <div class="container">
            <h3 class="panel-main-title text-center">Eatery Detail</h3>

            <div class="row mt-4 align-items-start">
                <div class="col-lg-8 col-md-7 mb-4 mb-md-0"> 
                    <div class="d-flex align-items-start">
                        <img src="Logo dunkin.svg" alt="Dunkin' Donuts Logo" class="eatery-logo-main">
                        
                        <div class="eatery-text-details"> 
                            <h4 class="eatery-name">Dunkin' Donuts</h4>
                            <p class="eatery-address mb-3">Jl. Siliwangi No.29 4, RT.02/RW.02, Sukasari, Kec. Bogor Tim., Kota Bogor, Jawa Barat 16142</p>
                            
                            <p class="eatery-hours-title mb-1"><strong>Hours Of Operation</strong></p>
                            <p class="eatery-hours-time mb-3">Sun-Sat 7.00 am - 9.30 pm</p>
                            
                            <p class="eatery-phone">
                                <i class="fas fa-phone-alt me-2"></i>081234598968 
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-5">
                    <div class="map-placeholder">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63411.76934216762!2d106.73989212167974!3d-6.617627799999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5e43b20dbc7%3A0xc0166ec8d5df7426!2sDunkin&#39;%20Donuts%20Sukasari!5e0!3m2!1sen!2sid!4v1749096248502!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    `;
}

    btnWhatYouGet.addEventListener('click', showWhatYouGet);
    btnPickUpTime.addEventListener('click', showPickUpTime);
    btnEateryDetail.addEventListener('click', showEateryDetail);

    showWhatYouGet();
});
<?php include "includes/header.php"; ?>

    <section id="main" class="justify-content-center align-items-center d-flex">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                

                <div class="form_wrapper first_form">
                    <div class="form_img">
                        <img src="images/logo.png" alt="Form Logo" />
                    </div>
                    <h4>Calcula el precio de tu reforma integral</h4>
                    <ul>
                        <li>Nuestro equipo te acompañará durante el proceso.</li>
                        <li>Te asesoraremos sobre las ayudas públicas a las que puedes optar.</li>
                        <li>Nuestras constructoras respetarán el presupuesto. Precio cerrado y sin sorpresas.</li>
                    </ul>
                    <h6>En 5 minutos, gratis y desde la palma de tu mano.</h6>

                    <button class="btn btn-calculate" onclick="changeContent('.first_form','.second_form')">Calculate your reform</button>

                </div>

                <div class="form_wrapper second_form d-none">
                    <div class="form_img">
                        <img src="images/second_form.png" alt="Form Logo" />
                    </div>
                    <div class="input_wrapper position-relative">
                        <input type="text" id="province_input" class="form-control" placeholder="Province" autocomplete="off" onblur="closeSubmenu('province_list')"/>
                        <ul id="province_list" class="sub_list"></ul>
                    </div>
                    <div class="search_btn_wrapper text-center mb-5">
                        <button class="btn w-75 mt-3">
                            <i class="fa-solid fa-location-crosshairs"></i> Search Around You</button>
                    </div>
                    <button class="btn btn-calculate mt-5 text-uppercase" onclick="changeContent('.second_form','.third_form')" >Continue <i class="fa-solid fa-arrow-right ms-2"></i></button>
                </div>
                <div class="form_wrapper third_form d-none">
                    <div class="form_img">
                        <img src="images/third_form.png" alt="Form Logo" />
                    </div>

                    <button class="indicate_btn w-100" onclick="changeContent('.third_form','.four_form')"><span>INDICATES YOUR</span>Address</button>

                    <button class="btn btn-secondary w-100 mt-5 text-uppercase" onclick="changeContent('.third_form','.second_form')">Back</button>
                </div>
                <div class="form_wrapper four_form d-none">
                    <div class="form_img">
                        <img src="images/four_form.png" alt="Form Logo" />
                    </div>
                    <div class="input_wrapper">
                        <div class="position-relative">
                            <input type="text" id="municipality_input" autocomplete="off" class="form-control" placeholder="Municipality" onblur="closeSubmenu('municipality_list')"/>
                            <ul id="municipality_list" class="sub_list"></ul>
                        </div>
                        <div class="position-relative">
                            <input type="text" id="via_input" autocomplete="off" class="form-control" placeholder="Via" onblur="closeSubmenu('via_list')"/>
                            <ul id="via_list" class="sub_list"></ul>
                        </div>
                        <input type="number" id="number_input" class="form-control" autocomplete="off" placeholder="Number"/>
                        <div id="error_massage"></div>
                    </div>

                    <div class="btn_wrapper d-flex gap-3 mt-5">
                        <button class="btn w-50 btn-return" onclick="changeContent('.four_form','.third_form')" >Return</button>
                        <button class="btn w-50 btn-follow" onclick="finalSubmit()">Following 
                            <i class="fa-solid fa-arrow-right ms-1"></i>
                        </button>
                    </div>
                    
                </div>

            </div>
        </div>
    </section>

    <div id="spinner">
        <div class="d-flex justify-content-center">
            <div class="spinner-border text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

<?php include "includes/footer.php"; ?>
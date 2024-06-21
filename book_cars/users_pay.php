<form name="contactForm" id="paymentForm" method="post">
    <h4>Booking this car</h4>

    <div class="spacer-20"></div>

    <div class="row">
        <div class="col-lg-12 mb20">
            <h5>Pick Up Location</h5>
            <input type="text" name="PickupLocation" onfocus="geolocate()" placeholder="Enter your pickup location" id="autocomplete" autocomplete="off" class="form-control" required>
        </div>

        <div class="col-lg-12 mb20">
            <h5>Drop Off Location</h5>
            <input type="text" name="DropoffLocation" onfocus="geolocate()" placeholder="Enter your dropoff location" id="autocomplete2" autocomplete="off" class="form-control" required>
        </div>

        <div class="col-lg-12 mb20">
            <h5>Pick Up Date & Time</h5>
            <div class="date-time-field">
                <input type="text" id="date-picker" name="PickUpDate" value="">
                <select name="Pick Up Time" id="pickup-time">
                    <option selected disabled value="Select time">Time</option>
                    <option value="00:00">00:00</option>
                    <option value="00:30">00:30</option>
                    <option value="01:00">01:00</option>
                    <option value="01:30">01:30</option>
                    <option value="02:00">02:00</option>
                    <option value="02:30">02:30</option>
                    <option value="03:00">03:00</option>
                    <option value="03:30">03:30</option>
                    <option value="04:00">04:00</option>
                    <option value="04:30">04:30</option>
                    <option value="05:00">05:00</option>
                    <option value="05:30">05:30</option>
                    <option value="06:00">06:00</option>
                    <option value="06:30">06:30</option>
                    <option value="07:00">07:00</option>
                    <option value="07:30">07:30</option>
                    <option value="08:00">08:00</option>
                    <option value="08:30">08:30</option>
                    <option value="09:00">09:00</option>
                    <option value="09:30">09:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="11:30">11:30</option>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                    <option value="20:00">20:00</option>
                    <option value="20:30">20:30</option>
                    <option value="21:00">21:00</option>
                    <option value="21:30">21:30</option>
                    <option value="22:00">22:00</option>
                    <option value="22:30">22:30</option>
                    <option value="23:00">23:00</option>
                    <option value="23:30">23:30</option>
                </select>
            </div>
        </div>

        <div class="col-lg-12 mb20">
            <h5>Return Date & Time</h5>
            <div class="date-time-field">
                <input type="text" id="date-picker-2" name="ReturnDate" value="">
                <select name="Collection Time" id="collection-time">
                    <option selected disabled value="Select time">Time</option>
                    <option value="00:00">00:00</option>
                    <option value="00:30">00:30</option>
                    <option value="01:00">01:00</option>
                    <option value="01:30">01:30</option>
                    <option value="02:00">02:00</option>
                    <option value="02:30">02:30</option>
                    <option value="03:00">03:00</option>
                    <option value="03:30">03:30</option>
                    <option value="04:00">04:00</option>
                    <option value="04:30">04:30</option>
                    <option value="05:00">05:00</option>
                    <option value="05:30">05:30</option>
                    <option value="06:00">06:00</option>
                    <option value="06:30">06:30</option>
                    <option value="07:00">07:00</option>
                    <option value="07:30">07:30</option>
                    <option value="08:00">08:00</option>
                    <option value="08:30">08:30</option>
                    <option value="09:00">09:00</option>
                    <option value="09:30">09:30</option>
                    <option value="10:00">10:00</option>
                    <option value="10:30">10:30</option>
                    <option value="11:00">11:00</option>
                    <option value="11:30">11:30</option>
                    <option value="12:00">12:00</option>
                    <option value="12:30">12:30</option>
                    <option value="13:00">13:00</option>
                    <option value="13:30">13:30</option>
                    <option value="14:00">14:00</option>
                    <option value="14:30">14:30</option>
                    <option value="15:00">15:00</option>
                    <option value="15:30">15:30</option>
                    <option value="16:00">16:00</option>
                    <option value="16:30">16:30</option>
                    <option value="17:00">17:00</option>
                    <option value="17:30">17:30</option>
                    <option value="18:00">18:00</option>
                    <option value="18:30">18:30</option>
                    <option value="19:00">19:00</option>
                    <option value="19:30">19:30</option>
                    <option value="20:00">20:00</option>
                    <option value="20:30">20:30</option>
                    <option value="21:00">21:00</option>
                    <option value="21:30">21:30</option>
                    <option value="22:00">22:00</option>
                    <option value="22:30">22:30</option>
                    <option value="23:00">23:00</option>
                    <option value="23:30">23:30</option>
                </select>
            </div>
        </div>
    </div>

    <div class="spacer-20"></div>
    <h5>Payment Method <small>(Momo)</small></h5>
    <div class="mb20">
        <div class="mb20" style="display: flex; justify-content: space-between;">
            <div class="form-check">
                <label class="form-check-label" for="momo_atm">
                    <img src="images/png/atm-card.png" alt="" class="img-fluid me-2" style="height: 2rem; width: 2rem;">
                </label>
                <input class="form-check-input" type="radio" name="payment_method" id="momo_atm" value="momo_atm" style="margin-top: 5px;">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="momo_qr">
                    <img src="images/png/qr-scan.png" alt="" class="img-fluid me-2" style="height: 2rem; width: 2rem;">
                </label>
                <input class="form-check-input" type="radio" name="payment_method" id="momo_qr" value="momo_qr" style="margin-top: 5px;">
            </div>
        </div>
        <input type='submit' id='submitBtn' value='Book Now' class="btn-main btn-fullwidth">

        <div class="clearfix"></div>
    </div>
</form>
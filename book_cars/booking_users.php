<form name="contactForm" id="Booking" class="form-s2 row g-4 on-submit-hide" method="post" action="process_booking.php">
    <div class="col-lg-6 d-light">
        <h4>Booking a Car</h4>
        <?php
        include('config/config.php'); // Include your database configuration

        $sql = "SELECT cars.id AS car_id, cars.name, cars_details.total_price, cars_image.removal_image 
                FROM cars 
                JOIN cars_details ON cars.id = cars_details.car_id 
                JOIN cars_image ON cars.id = cars_image.car_id";
        $result = $conn->query($sql);

        function formatPrice($price)
        {
            return (strpos($price, '.00') !== false) ? rtrim(rtrim($price, '0'), '.') : $price;
        }
        ?>
        <select name="car_id" id="vehicle_type" class="form-control" required>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <option value='<?php echo $row['car_id']; ?>' data-src='<?php echo $row['removal_image']; ?>'>
                    <?php echo $row['name']; ?> - $<?php echo formatPrice($row['total_price']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <!-- Other form fields for pickup and return locations, dates, and times -->
        <div class="row g-4">
            <div class="col-lg-6">
                <h5>Pick Up Location</h5>
                <select name="pickup_location" id="pickup_location" class="form-control opt-1-disable" required>
                    <option value='New York'>Enter your pickup location</option>
                    <option value='New York'>New York</option>
                    <option value='Pennsylvania'>Pennsylvania</option>
                    <option value='New Jersey'>New Jersey</option>
                    <option value='Connecticut'>Connecticut</option>
                    <option value='Massachusetts'>Massachusetts</option>
                    <option value='Vermont'>Vermont</option>
                    <option value='Rhode Island'>Rhode Island</option>
                    <option value='New Hampshire'>New Hampshire</option>
                </select>
            </div>
            <div class="col-lg-6">
                <h5>Destination</h5>
                <select name="destination" id="destination" class="form-control opt-1-disable" required>
                    <option value='New York'>Enter your destination</option>
                    <option value='New York'>New York</option>
                    <option value='Pennsylvania'>Pennsylvania</option>
                    <option value='New Jersey'>New Jersey</option>
                    <option value='Connecticut'>Connecticut</option>
                    <option value='Massachusetts'>Massachusetts</option>
                    <option value='Vermont'>Vermont</option>
                    <option value='Rhode Island'>Rhode Island</option>
                    <option value='New Hampshire'>New Hampshire</option>
                </select>
            </div>
            <div class="col-lg-6">
                <h5>Pick Up Date & Time</h5>
                <div class="date-time-field">
                    <input type="text" id="date-picker" name="pickup_date" value="">
                    <select name="pickup_time" id="pickup-time">
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
            <div class="col-lg-6">
                <h5>Return Date & Time</h5>
                <div class="date-time-field">
                    <input type="text" id="date-picker-2" name="return_date" value="">
                    <select name="return_time" id="collection-time">
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
    </div>
    <div class="col-lg-6">
        <h4>Enter Your Details</h4>
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="field-set">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="field-set">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="field-set">
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="field-set">
                    <textarea name="message" id="message" class="form-control" placeholder="Do you have any request?"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <input type="submit" id="send_message" value="Submit" class="btn-main btn-fullwidth">
    </div>
</form>
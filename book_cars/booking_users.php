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
                    <option value=''>Enter your pickup location</option>
                    <option value='New York'>New York</option>
                </select>
            </div>
            <div class="col-lg-6">
                <h5>Destination</h5>
                <select name="destination" id="destination" class="form-control opt-1-disable" required>
                    <option value=''>Enter your destination</option>
                    <option value='New York'>New York</option>
                </select>
            </div>
            <div class="col-lg-6">
                <h5>Pick Up Date & Time</h5>
                <div class="date-time-field">
                    <input type="text" id="date-picker" name="pickup_date" value="">
                    <select name="pickup_time" id="pickup-time">
                        <option value="00:00">00:00</option>
                        <!-- Add other pickup times dynamically if needed -->
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <h5>Return Date & Time</h5>
                <div class="date-time-field">
                    <input type="text" id="date-picker-2" name="return_date" value="">
                    <select name="return_time" id="collection-time">
                        <option value="00:00">00:00</option>
                        <!-- Add other return times dynamically if needed -->
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
<form id="filterForm" method="GET" action="">
    <!-- Vehicle Type Filter Group -->
    <div class="item_filter_group">
        <h4>Vehicle Type</h4>
        <div class="de_form">
            <div class="de_checkbox">
                <input id="vehicle_type_1" name="vehicle_type[]" type="checkbox" value="Car">
                <label for="vehicle_type_1">Car</label>
            </div>
            <div class="de_checkbox">
                <input id="vehicle_type_2" name="vehicle_type[]" type="checkbox" value="Van">
                <label for="vehicle_type_2">Van</label>
            </div>
            <div class="de_checkbox">
                <input id="vehicle_type_3" name="vehicle_type[]" type="checkbox" value="Minibus">
                <label for="vehicle_type_3">Minibus</label>
            </div>
            <div class="de_checkbox">
                <input id="vehicle_type_4" name="vehicle_type[]" type="checkbox" value="Prestige">
                <label for="vehicle_type_4">Prestige</label>
            </div>
        </div>
    </div>

    <!-- Car Body Type Filter Group -->
    <div class="item_filter_group">
        <h4>Car Body Type</h4>
        <div class="de_form">
            <div class="de_checkbox">
                <input id="car_body_type_1" name="car_body_type[]" type="checkbox" value="Convertible">
                <label for="car_body_type_1">Convertible</label>
            </div>
            <div class="de_checkbox">
                <input id="car_body_type_2" name="car_body_type[]" type="checkbox" value="Coupe">
                <label for="car_body_type_2">Coupe</label>
            </div>
            <div class="de_checkbox">
                <input id="car_body_type_3" name="car_body_type[]" type="checkbox" value="Exotic Cars">
                <label for="car_body_type_3">Exotic Cars</label>
            </div>
            <div class="de_checkbox">
                <input id="car_body_type_4" name="car_body_type[]" type="checkbox" value="Hatchback">
                <label for="car_body_type_4">Hatchback</label>
            </div>
            <div class="de_checkbox">
                <input id="car_body_type_5" name="car_body_type[]" type="checkbox" value="Minivan">
                <label for="car_body_type_5">Minivan</label>
            </div>
            <div class="de_checkbox">
                <input id="car_body_type_6" name="car_body_type[]" type="checkbox" value="Truck">
                <label for="car_body_type_6">Truck</label>
            </div>
            <div class="de_checkbox">
                <input id="car_body_type_7" name="car_body_type[]" type="checkbox" value="Sedan">
                <label for="car_body_type_7">Sedan</label>
            </div>
            <div class="de_checkbox">
                <input id="car_body_type_8" name="car_body_type[]" type="checkbox" value="Sports Car">
                <label for="car_body_type_8">Sports Car</label>
            </div>
            <div class="de_checkbox">
                <input id="car_body_type_9" name="car_body_type[]" type="checkbox" value="Station Wagon">
                <label for="car_body_type_9">Station Wagon</label>
            </div>
            <div class="de_checkbox">
                <input id="car_body_type_10" name="car_body_type[]" type="checkbox" value="SUV">
                <label for="car_body_type_10">SUV</label>
            </div>
        </div>
    </div>

    <!-- Car Seats Filter Group -->
    <div class="item_filter_group">
        <h4>Car Seats</h4>
        <div class="de_form">
            <div class="de_checkbox">
                <input id="car_seat_1" name="car_seat[]" type="checkbox" value="2">
                <label for="car_seat_1">2 seats</label>
            </div>
            <div class="de_checkbox">
                <input id="car_seat_2" name="car_seat[]" type="checkbox" value="4">
                <label for="car_seat_2">4 seats</label>
            </div>
            <div class="de_checkbox">
                <input id="car_seat_3" name="car_seat[]" type="checkbox" value="6">
                <label for="car_seat_3">6 seats</label>
            </div>
            <div class="de_checkbox">
                <input id="car_seat_4" name="car_seat[]" type="checkbox" value="7+">
                <label for="car_seat_4">6+ seats</label>
            </div>
        </div>
    </div>

    <!-- Car Engine Capacity Filter Group -->
    <div class="item_filter_group">
        <h4>Car Engine Capacity (cc)</h4>
        <div class="de_form">
            <div class="de_checkbox">
                <input id="car_engine_1" name="car_engine[]" type="checkbox" value="1000 - 2000">
                <label for="car_engine_1">1000 - 2000</label>
            </div>
            <div class="de_checkbox">
                <input id="car_engine_2" name="car_engine[]" type="checkbox" value="2000 - 4000">
                <label for="car_engine_2">2000 - 4000</label>
            </div>
            <div class="de_checkbox">
                <input id="car_engine_3" name="car_engine[]" type="checkbox" value="4000 - 6000">
                <label for="car_engine_3">4000 - 6000</label>
            </div>
            <div class="de_checkbox">
                <input id="car_engine_4" name="car_engine[]" type="checkbox" value="6000+">
                <label for="car_engine_4">6000+</label>
            </div>
        </div>
    </div>

    <!-- Price Filter Group -->
    <div class="item_filter_group">
        <h4>Price ($)</h4>
        <div class="price-input">
            <div class="field">
                <span>Min</span>
                <input type="number" class="input-min" name="price_min" value="0">
            </div>
            <div class="field">
                <span>Max</span>
                <input type="number" class="input-max" name="price_max" value="2000">
            </div>
        </div>
        <div class="slider">
            <div class="progress"></div>
        </div>
        <div class="range-input">
            <input type="range" class="range-min" min="0" max="2000" value="0" step="1">
            <input type="range" class="range-max" min="0" max="2000" value="2000" step="1">
        </div>
    </div>

    <!-- Filter Button -->
    <div class="item_filter_group">
        <button class="btn-main pull-center" type="submit">Filter now</button>
    </div>
</form>
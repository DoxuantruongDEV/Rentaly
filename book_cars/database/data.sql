CREATE DATABASE IF NOT EXISTS rentaly CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE rentaly;

-- Drop tables if they exist to avoid conflicts
DROP TABLE IF EXISTS momo_payments,
customer_feedback,
bookings,
user_favorites,
cars_image,
features,
cars_details,
cars,
users;
-- Create users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(20),
    hour VARCHAR(50),
    language VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255),
    address TEXT,
    dob DATE,
    role VARCHAR(255) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create cars table
CREATE TABLE cars (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    body VARCHAR(50),
    seat VARCHAR(10),
    door VARCHAR(10),
    luggage VARCHAR(50),
    horsepower VARCHAR(50),
    likes_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create cars_details table
CREATE TABLE cars_details (
    car_id INT PRIMARY KEY,
    description TEXT,
    fuel_type VARCHAR(50),
    engine_capacity VARCHAR(255),
    year INT,
    mileage VARCHAR(255),
    transmission VARCHAR(50),
    drive VARCHAR(50),
    fuel_economy VARCHAR(50),
    exterior_color VARCHAR(50),
    interior_color VARCHAR(50),
    total_price DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create features table
CREATE TABLE features (
    id INT PRIMARY KEY AUTO_INCREMENT,
    car_id INT,
    feature_name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create cars_image table
CREATE TABLE cars_image (
    id INT PRIMARY KEY AUTO_INCREMENT,
    car_id INT,
    front_image VARCHAR(255),
    rear_image VARCHAR(255),
    right_image VARCHAR(255),
    left_image VARCHAR(255),
    removal_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create user_favorites table
CREATE TABLE user_favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (car_id) REFERENCES cars (id)
);

-- Create bookings table
CREATE TABLE bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    car_id INT, -- Ensure this line exists
    vehicle_type VARCHAR(255),
    pick_up_location VARCHAR(255),
    destination VARCHAR(255),
    pick_up_date DATE NOT NULL,
    pick_up_time TIME NOT NULL,
    return_date DATE NOT NULL,
    return_time TIME NOT NULL,
    name VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(255),
    message TEXT,
    status ENUM(
        'scheduled',
        'cancelled',
        'completed'
    ) DEFAULT 'scheduled',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create customer_feedback table
CREATE TABLE customer_feedback (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    your_name VARCHAR(255),
    your_email VARCHAR(255),
    your_phone VARCHAR(255),
    your_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Create momo_payments table
CREATE TABLE momo_payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    booking_id INT,
    car_id INT,
    partner_code VARCHAR(50),
    order_id INT,
    request_id INT,
    amount DECIMAL(10, 2),
    order_info VARCHAR(255),
    order_type VARCHAR(50),
    trans_id BIGINT,
    result_code INT,
    message TEXT,
    response_time BIGINT,
    extra_data VARCHAR(255),
    pay_type VARCHAR(50),
    signature VARCHAR(255),
    payment_option VARCHAR(50),
    payment_status ENUM(
        'pending',
        'completed',
        'failed'
    ) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (booking_id) REFERENCES bookings (booking_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (car_id) REFERENCES cars (id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Insert data into users table
INSERT INTO
    users (
        username,
        name,
        email,
        phone,
        hour,
        language,
        password,
        avatar,
        address,
        dob,
        role
    )
VALUES (
        'vusena',
        'Nguyen Nhu Vu',
        'vusena@gmail.com',
        '0384804325',
        '9AM - 5PM',
        'English',
        '123',
        'images/profile/3.jpg',
        '123 Main St, Hanoi, Vietnam',
        '1990-01-01',
        'user'
    ),
    (
        'Huy',
        'Le Quang Huy',
        'huy@gmail.com',
        '0123456789',
        '10AM - 6PM',
        'Vietnamese',
        '123',
        'images/profile/2.jpg',
        '456 Elm St, Ho Chi Minh City, Vietnam',
        '1985-05-15',
        'user'
    ),
    (
        'Truong',
        'Nguyen Xuan Truong',
        'truong@gmail.com',
        '0123456789',
        '8AM - 4PM',
        'French',
        '123',
        'images/profile/3.jpg',
        '789 Oak St, Da Nang, Vietnam',
        '1992-03-20',
        'user'
    ),
    (
        'Vũ',
        'Nguyễn Như Vũ',
        'vunnth2307024@fpt.edu.vn',
        '0123456789',
        '8AM - 4PM',
        'French',
        '123',
        'images/profile/3.jpg',
        '789 Oak St, Da Nang, Vietnam',
        '1992-03-20',
        'admin'
    );

-- Insert data into cars table
INSERT INTO
    cars (
        name,
        body,
        seat,
        door,
        luggage,
        horsepower,
        likes_count,
        created_at,
        updated_at
    )
VALUES (
        'Toyota Camry',
        'Sedan',
        '5',
        '4',
        '2',
        '200',
        300,
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        'Honda CR-V',
        'SUV',
        '5',
        '4',
        '3',
        '180',
        300,
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        'Ford Mustang',
        'Sports Car',
        '4',
        '2',
        '1',
        '300',
        3040,
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    );

-- Insert data into cars_details table
INSERT INTO
    cars_details (
        car_id,
        description,
        fuel_type,
        engine_capacity,
        year,
        mileage,
        transmission,
        drive,
        fuel_economy,
        exterior_color,
        interior_color,
        total_price,
        created_at,
        updated_at
    )
VALUES (
        1,
        'The Toyota Camry is a comfortable and fuel-efficient sedan, perfect for city driving and long road trips.',
        'Hybrid',
        '2.5L',
        2022,
        '15000',
        'Automatic',
        'FWD',
        '30',
        'Blue Metallic',
        'Black',
        300.00,
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        2,
        'The Honda CR-V is a versatile and spacious SUV, ideal for families and outdoor adventures.',
        'Gasoline',
        '1.5L',
        2021,
        '20000',
        'Automatic',
        'AWD',
        '28',
        'White Pearl',
        'Gray',
        280.00,
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        3,
        'The Ford Mustang is a powerful and iconic sports car, delivering thrilling performance and style.',
        'Gasoline',
        '5.0L',
        2020,
        '10000',
        'Manual',
        'RWD',
        '20',
        'Red',
        'Black',
        450.00,
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    );

-- Insert data into features table
INSERT INTO
    features (car_id, feature_name)
VALUES (1, 'Air Conditioning'),
    (1, 'Navigation System'),
    (2, 'Sunroof'),
    (3, 'Leather Seats'),
    (3, 'Heated Seats'),
    (2, 'Bluetooth Connectivity');

-- Insert data into cars_image table
INSERT INTO
    cars_image (
        car_id,
        front_image,
        rear_image,
        right_image,
        left_image,
        removal_image,
        created_at,
        updated_at
    )
VALUES (
        1,
        'images/cars/1.jpg',
        'images/cars/2.jpg',
        'images/cars/3.jpg',
        'images/cars/4.jpg',
        'images/cars-alt/5.png',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        2,
        'images/cars/5.jpg',
        'images/cars/6.jpg',
        'images/cars/7.jpg',
        'images/cars/8.jpg',
        'images/cars-alt/6.png',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        3,
        'images/cars/9.jpg',
        'images/cars/10.jpg',
        'images/cars/11.jpg',
        'images/cars/12.jpg',
        'images/cars-alt/7.png',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    );

-- Insert data into user_favorites table
INSERT INTO
    user_favorites (user_id, car_id)
VALUES (1, 2),
    (2, 1),
    (3, 3);

-- Insert data into bookings table
INSERT INTO
    bookings (
        user_id,
        car_id,
        vehicle_type,
        pick_up_location,
        destination,
        pick_up_date,
        pick_up_time,
        return_date,
        return_time,
        name,
        email,
        phone,
        message,
        created_at,
        updated_at
    )
VALUES (
        1,
        1,
        'Sedan',
        'Hanoi',
        'Ho Chi Minh City',
        '2022-01-01',
        '09:00:00',
        '2022-01-05',
        '17:00:00',
        'Nguyen Nhu Vu',
        'vusena@gmail.com',
        '0384804325',
        'Looking forward to the trip!',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        2,
        2,
        'SUV',
        'Ho Chi Minh City',
        'Da Nang',
        '2022-02-01',
        '10:00:00',
        '2022-02-07',
        '18:00:00',
        'Le Quang Huy',
        'huy@gmail.com',
        '0123456789',
        'Excited for this adventure!',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        3,
        3,
        'Sports Car',
        'Da Nang',
        'Hanoi',
        '2022-03-01',
        '08:00:00',
        '2022-03-05',
        '16:00:00',
        'Nguyen Xuan Truong',
        'truong@gmail.com',
        '0123456789',
        'Can’t wait to drive the Mustang!',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    );

-- Insert data into customer_feedback table
INSERT INTO
    customer_feedback (
        user_id,
        your_name,
        your_email,
        your_phone,
        your_description,
        created_at,
        updated_at
    )
VALUES (
        1,
        'Nguyen Nhu Vu',
        'vusena@gmail.com',
        '0384804325',
        'Great service and friendly staff!',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        2,
        'Le Quang Huy',
        'huy@gmail.com',
        '0123456789',
        'The booking process was smooth and easy!',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        3,
        'Nguyen Xuan Truong',
        'truong@gmail.com',
        '0123456789',
        'Had an amazing experience driving the Mustang!',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    );

-- Insert data into momo_payments table
INSERT INTO
    momo_payments (
        user_id,
        booking_id,
        car_id,
        partner_code,
        order_id,
        request_id,
        amount,
        order_info,
        order_type,
        trans_id,
        result_code,
        message,
        response_time,
        extra_data,
        pay_type,
        signature,
        payment_option,
        payment_status,
        created_at,
        updated_at
    )
VALUES (
        1,
        1,
        1,
        'PARTNER123',
        9876,
        5432,
        100.00,
        'Booking Payment',
        'online',
        1234567890,
        200,
        'Payment successful',
        1609426800,
        '{"discount": 10}',
        'credit_card',
        'abcxyz123',
        'credit_card',
        'completed',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        2,
        2,
        2,
        'PARTNER456',
        8765,
        4321,
        200.00,
        'Booking Payment',
        'online',
        2345678901,
        200,
        'Payment successful',
        1609430400,
        '{"discount": 15}',
        'credit_card',
        'defuvw456',
        'credit_card',
        'completed',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    ),
    (
        3,
        3,
        3,
        'PARTNER789',
        7654,
        3210,
        300.00,
        'Booking Payment',
        'online',
        3456789012,
        200,
        'Payment successful',
        1609434000,
        '{"discount": 20}',
        'credit_card',
        'ghijkl789',
        'credit_card',
        'completed',
        CURRENT_TIMESTAMP,
        CURRENT_TIMESTAMP
    );
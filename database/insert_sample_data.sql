-- Sample Data for Car Rental System

-- Insert sample users
INSERT INTO users (username, password, full_name, email, phone, address, user_type) VALUES
('admin', 'admin123', 'Admin User', 'admin@carental.com', '01712345678', 'Dhaka, Bangladesh', 'admin'),
('sadbin', 'pass123', 'Sadbin Siddique', 'sadbin@example.com', '01812345678', 'Gulshan, Dhaka', 'customer'),
('karim', 'pass123', 'Karim Ahmed', 'karim@example.com', '01912345678', 'Banani, Dhaka', 'customer'),
('rahima', 'pass123', 'Rahima Begum', 'rahima@example.com', '01612345678', 'Dhanmondi, Dhaka', 'customer'),
('fahim', 'pass123', 'Fahim Rahman', 'fahim@example.com', '01512345678', 'Uttara, Dhaka', 'customer');

-- Insert sample cars
INSERT INTO cars (brand, model, year, registration_number, color, seating_capacity, fuel_type, transmission, price_per_day, availability, image_url, description) VALUES
('Tesla', 'Model S', 2022, 'DHK-12345', 'Red', 4, 'Electric', 'Automatic', 8000.00, TRUE, 'assets/deals-1.png', 'Luxury electric vehicle with autopilot features'),
('Tesla', 'Model Y', 2022, 'DHK-12346', 'Blue', 4, 'Electric', 'Automatic', 8000.00, TRUE, 'assets/deals-3.png', 'Electric SUV with long range and advanced features'),
('Mitsubishi', 'Mirage', 2021, 'DHK-12347', 'Silver', 4, 'Petrol', 'Manual', 1200.00, TRUE, 'assets/deals-4.png', 'Compact and fuel-efficient city car'),
('Mitsubishi', 'Pajero Sports', 2021, 'DHK-12348', 'Black', 7, 'Diesel', 'Manual', 1800.00, TRUE, 'assets/deals-6.png', 'Rugged SUV perfect for long journeys'),
('Mazda', 'CX-5', 2022, 'DHK-12349', 'White', 5, 'Petrol', 'Manual', 1300.00, TRUE, 'assets/deals-7.png', 'Stylish crossover with excellent handling'),
('Mazda', 'CX-9', 2022, 'DHK-12350', 'Grey', 7, 'Petrol', 'Automatic', 1800.00, TRUE, 'assets/deals-9.png', 'Spacious family SUV with premium features'),
('Toyota', 'Corolla', 2021, 'DHK-12351', 'Silver', 5, 'Petrol', 'Manual', 1800.00, TRUE, 'assets/deals-10.png', 'Reliable and economical sedan'),
('Toyota', 'Innova', 2021, 'DHK-12352', 'White', 7, 'Diesel', 'Manual', 1500.00, TRUE, 'assets/deals-11.png', 'Versatile MPV ideal for family trips'),
('Toyota', 'Fortuner', 2022, 'DHK-12353', 'Black', 7, 'Diesel', 'Automatic', 1900.00, TRUE, 'assets/deals-12.png', 'Powerful SUV with excellent off-road capabilities'),
('Honda', 'Amaze', 2021, 'DHK-12354', 'Blue', 5, 'Petrol', 'Manual', 1000.00, TRUE, 'assets/deals-13.png', 'Compact sedan with spacious interiors'),
('Honda', 'City', 2022, 'DHK-12355', 'Red', 5, 'Petrol', 'Automatic', 1500.00, TRUE, 'assets/deals-15.png', 'Stylish sedan with advanced features');

-- Insert sample bookings
INSERT INTO bookings (user_id, car_id, pickup_location, pickup_date, return_date, booking_status, total_amount) VALUES
(2, 1, 'Gulshan, Dhaka', '2023-08-01 10:00:00', '2023-08-06 20:00:00', 'Completed', 40000.00),
(3, 4, 'Banani, Dhaka', '2023-08-15 12:00:00', '2023-08-18 12:00:00', 'Completed', 5400.00),
(4, 7, 'Dhanmondi, Dhaka', '2023-09-01 09:00:00', '2023-09-03 18:00:00', 'Completed', 3600.00),
(5, 10, 'Uttara, Dhaka', '2023-09-10 11:00:00', '2023-09-15 11:00:00', 'Confirmed', 5000.00),
(2, 3, 'Gulshan, Dhaka', '2023-10-05 10:00:00', '2023-10-10 18:00:00', 'Pending', 6000.00);

-- Insert sample reviews
INSERT INTO reviews (user_id, car_id, booking_id, rating, comment) VALUES
(2, 1, 1, 5, 'Amazing car with great performance. The autopilot feature was outstanding!'),
(3, 4, 2, 4, 'Very comfortable SUV, perfect for our family trip. Fuel efficiency could be better.'),
(4, 7, 3, 5, 'Toyota Corolla is as reliable as always. Great fuel economy and smooth drive.');

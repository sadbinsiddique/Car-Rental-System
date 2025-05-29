-- Sample Data for Car Rental System (Updated for 'gg' database)

-- Insert admin user with proper password hashing
INSERT IGNORE INTO users (username, email, password, full_name, user_type, email_verified) VALUES
('admin', 'admin@carrental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator', 'admin', 1);

-- Insert sample vehicle owners
INSERT IGNORE INTO users (username, email, password, full_name, user_type, email_verified) VALUES
('owner1', 'owner1@carrental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rahul Ahmed', 'owner', 1),
('owner2', 'owner2@carrental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Fatima Khan', 'owner', 1),
('owner3', 'owner3@carrental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Mohammad Hassan', 'owner', 1);

-- Insert sample customers
INSERT IGNORE INTO users (username, email, password, full_name, user_type, email_verified) VALUES
('customer1', 'customer1@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nasir Uddin', 'customer', 1),
('customer2', 'customer2@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Ayesha Rahman', 'customer', 1);

-- Insert sample riders  
INSERT IGNORE INTO users (username, email, password, full_name, user_type, email_verified) VALUES
('rider1', 'rider1@carrental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Karim Sheikh', 'rider', 1),
('rider2', 'rider2@carrental.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Salma Begum', 'rider', 1);

-- Insert sample vehicles (using correct schema)
INSERT INTO vehicles (owner_id, make, model, year, color, license_plate, vehicle_type, fuel_type, transmission, seats, daily_rate, location, description, status, is_available) VALUES
(2, 'Tesla', 'Model S', 2022, 'Red', 'DHK-12345', 'luxury', 'electric', 'automatic', 4, 8000.00, 'Gulshan, Dhaka', 'Luxury electric vehicle with autopilot features', 'approved', 1),
(2, 'Tesla', 'Model Y', 2022, 'Blue', 'DHK-12346', 'suv', 'electric', 'automatic', 5, 7500.00, 'Banani, Dhaka', 'Electric SUV with long range and advanced features', 'approved', 1),
(3, 'Mitsubishi', 'Mirage', 2021, 'Silver', 'DHK-12347', 'hatchback', 'petrol', 'manual', 4, 1200.00, 'Dhanmondi, Dhaka', 'Compact and fuel-efficient city car', 'approved', 1),
(3, 'Mitsubishi', 'Pajero Sport', 2021, 'Black', 'DHK-12348', 'suv', 'diesel', 'manual', 7, 1800.00, 'Uttara, Dhaka', 'Rugged SUV perfect for long journeys', 'approved', 1),
(4, 'Mazda', 'CX-5', 2022, 'White', 'DHK-12349', 'suv', 'petrol', 'manual', 5, 1300.00, 'Wari, Dhaka', 'Stylish crossover with excellent handling', 'approved', 1),
(4, 'Mazda', 'CX-9', 2022, 'Grey', 'DHK-12350', 'suv', 'petrol', 'automatic', 7, 1800.00, 'Mirpur, Dhaka', 'Spacious family SUV with premium features', 'approved', 1),
(2, 'Toyota', 'Corolla', 2021, 'Silver', 'DHK-12351', 'sedan', 'petrol', 'manual', 5, 1800.00, 'Mohammadpur, Dhaka', 'Reliable and economical sedan', 'approved', 1),
(3, 'Toyota', 'Innova', 2021, 'White', 'DHK-12352', 'van', 'diesel', 'manual', 7, 1500.00, 'Tejgaon, Dhaka', 'Versatile MPV ideal for family trips', 'approved', 1),
(4, 'Toyota', 'Fortuner', 2022, 'Black', 'DHK-12353', 'suv', 'diesel', 'automatic', 7, 1900.00, 'Badda, Dhaka', 'Powerful SUV with excellent off-road capabilities', 'approved', 1),
(2, 'Honda', 'Amaze', 2021, 'Blue', 'DHK-12354', 'sedan', 'petrol', 'manual', 5, 1000.00, 'Farmgate, Dhaka', 'Compact sedan with spacious interiors', 'approved', 1),
(3, 'Honda', 'City', 2022, 'Red', 'DHK-12355', 'sedan', 'petrol', 'automatic', 5, 1500.00, 'Panthapath, Dhaka', 'Stylish sedan with advanced features', 'approved', 1);

-- Insert sample bookings (using correct schema)
INSERT INTO bookings (customer_id, vehicle_id, pickup_location, start_date, end_date, booking_status, total_amount) VALUES
(5, 1, 'Gulshan, Dhaka', '2024-08-01 10:00:00', '2024-08-06 20:00:00', 'completed', 40000.00),
(6, 4, 'Banani, Dhaka', '2024-08-15 12:00:00', '2024-08-18 12:00:00', 'completed', 5400.00),
(5, 7, 'Dhanmondi, Dhaka', '2024-09-01 09:00:00', '2024-09-03 18:00:00', 'completed', 3600.00),
(6, 10, 'Uttara, Dhaka', '2024-09-10 11:00:00', '2024-09-15 11:00:00', 'confirmed', 5000.00),
(5, 3, 'Gulshan, Dhaka', '2025-06-05 10:00:00', '2025-06-10 18:00:00', 'pending', 6000.00);

-- Insert sample ratings (using correct schema)
INSERT INTO ratings (booking_id, rater_id, rated_type, rated_id, rating, review) VALUES
(1, 5, 'vehicle', 1, 5, 'Amazing car with great performance. The autopilot feature was outstanding!'),
(2, 6, 'vehicle', 4, 4, 'Very comfortable SUV, perfect for our family trip. Fuel efficiency could be better.'),
(3, 5, 'vehicle', 7, 5, 'Toyota Corolla is as reliable as always. Great fuel economy and smooth drive.');

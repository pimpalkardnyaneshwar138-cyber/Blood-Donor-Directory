CREATE DATABASE IF NOT EXISTS blood_donor_directory;
USE blood_donor_directory;

CREATE TABLE IF NOT EXISTS donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    donor_name VARCHAR(100) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    city VARCHAR(50) NOT NULL,
    contact VARCHAR(15) NOT NULL,
    availability VARCHAR(20) NOT NULL
);

INSERT INTO donors (donor_name, blood_group, city, contact, availability) VALUES
('Rahul Sharma', 'A+', 'Pune', '9000000001', 'Available'),
('Amit Patil', 'O+', 'Nashik', '9000000002', 'Available'),
('Neha Joshi', 'B+', 'Nagpur', '9000000003', 'Unavailable'),
('Rohan Deshmukh', 'AB+', 'Amravati', '9000000004', 'Available'),
('Priya Kulkarni', 'O-', 'Pune', '9000000005', 'Available');
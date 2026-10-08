-- Run this once to create the database and table.
-- Easiest way in MAMP: open http://localhost:8888/phpMyAdmin (or whatever port
-- your MAMP uses), click "SQL" in the top menu, paste this in, and click "Go".

CREATE DATABASE IF NOT EXISTS dae_survey;
USE dae_survey;

CREATE TABLE IF NOT EXISTS post_class_survey (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(100),
    lname VARCHAR(100),
    ctrack VARCHAR(100),
    lfuture TEXT,
    vphone VARCHAR(20),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create database if not EXISTS xuongth;

use xuongth;

create table
    if NOT exists users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        avatar text NOT NULL,
        name NVARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        student_code VARCHAR(100) NOT NULL UNIQUE,
        gender BIT,
        birthday DATE,
        address NVARCHAR(500),
        course NVARCHAR(100)
    );

CREATE Table
    if not exists posts (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title NVARCHAR(100) NOT NULL,
        content NVARCHAR(5000) NOT NULL,
        created_at DATETIME NOT NULL
    );

create table
    if not exists schedules (
        id INT PRIMARY KEY AUTO_INCREMENT,
        room NVARCHAR(100) NOT NULL,
        day DATE NOT NULL,
        time NVARCHAR(100) NOT NULL,
        course_name NVARCHAR(100) NOT NULL,
        class_name NVARCHAR(100) NOT NULL,
        teacher_name NVARCHAR(100) NOT NULL,
        address NVARCHAR(100) NOT NULL,
        type BIT NOT NULL
    );
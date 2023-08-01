create database if not EXISTS demo_md17306;

use demo_md17306;

create table
    users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(100) NOT null UNIQUE,
        password TEXT NOT NULL,
        name TEXT NOT NULL,
        isVerify BIT DEFAULT 0;

);

insert into
    users (id, email, password, name)
values (
        1,
        'raiko@gmail.com',
        '123',
        'raiko'
    );

insert into
    users (id, email, password, name)
values (
        2,
        'kmidgley1@behance.net',
        'vG2>(GAE9!8?~K@U',
        'Katusha Midgley'
    );

insert into
    users (id, email, password, name)
values (
        3,
        'pbrodeau2@japanpost.jp',
        'rZ3?uKqc',
        'Patty Brodeau'
    );

insert into
    users (id, email, password, name)
values (
        4,
        'rgaller3@usnews.com',
        'nN6=gb''_moR9URF',
        'Rowney Galler'
    );

insert into
    users (id, email, password, name)
values (
        5,
        'pterbeek4@eepurl.com',
        'wN2%$c@i!D#@IU',
        'Pall Terbeek'
    );

CREATE Table
    reset_password (
        id INT PRIMARY KEY AUTO_INCREMENT,
        token VARCHAR(50) NOT null,
        email VARCHAR(100) NOT null,
        createdAt DATETIME NOT NULL DEFAULT NOW(),
        available BIT DEFAULT 1
    );

create table
    if not exists categories (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        image VARCHAR(5000) NOT NULL
    );

insert into
    categories (id, name, image)
values (
        1,
        'Điện thoại',
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg'
    );

insert into
    categories (id, name, image)
values (
        2,
        'Laptop',
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg'
    );

insert into
    categories (id, name, image)
values (
        3,
        'Phụ kiện',
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg'
    );

create table
    if not exists products (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        price INT NOT NULL,
        image VARCHAR(5000) NOT NULL,
        description VARCHAR(50) NOT NULL,
        quantity INT NOT NULL,
        categoryId INT NOT NULL,
        FOREIGN KEY (categoryId) REFERENCES categories(id)
    );

insert into
    products (
        id,
        name,
        price,
        image,
        description,
        quantity,
        categoryId
    )
values (
        1,
        'Điện thoại 1',
        1000,
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg',
        'Điện thoại 1',
        10,
        1
    );

insert into
    products (
        id,
        name,
        price,
        image,
        description,
        quantity,
        categoryId
    )
values (
        2,
        'Điện thoại 2',
        2000,
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg',
        'Điện thoại 2',
        20,
        2
    );

insert into
    products (
        id,
        name,
        price,
        image,
        description,
        quantity,
        categoryId
    )
values (
        3,
        'Điện thoại 3',
        3000,
        'https://asianwiki.com/images/d/de/Chi_Pu-p001.jpg',
        'Điện thoại 3',
        30,
        3
    );
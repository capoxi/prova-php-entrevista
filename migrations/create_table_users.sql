create table users(
    id INTEGER PRIMARY KEY,
    name varchar(100) NOT NULL,
    email varchar(100) NOT NULL,
    active INTEGER NOT NULL DEFAULT 1
)
CREATE TABLE `logins` (
                          `login`  VARCHAR(100) NOT NULL unique,`password` VARCHAR(255) NOT NULL
);

CREATE TABLE `user_log` (`user_name` VARCHAR(255) NOT NULL, `update_at` TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP);

INSERT INTO logins VALUES ('user', '$2y$10$3L0.p2YstLdeDDWwP4GTUuGLzLkMDu.LNU1DYF/EfNqzVnWIzVh2K');
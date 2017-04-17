--
-- Setup for anaxlite_users table:
--

-- Ensure UTF8 as character encoding within connection.
SET NAMES utf8;

--
-- Create table user
--
DROP TABLE IF EXISTS anaxlite_users;
CREATE TABLE IF NOT EXISTS anaxlite_users
(
    user char(20) PRIMARY KEY NOT NULL,
    pass char(255) NOT NULL,
    fname char(20),
    lname char(20),
    email char(40),
    permission int NOT NULL DEFAULT 1,
    created DATETIME DEFAULT '1970-01-01 00:00:00'
);


-- Insert some users
INSERT INTO anaxlite_users(user, pass, fname, lname, email, permission, created)
    VALUES ('Mumin', '$2y$10$mDUxJ1GkpR0PkwtC1pN4kOoAdXCAHnqoUBSXo9hdrq2sRBHfpvc02', '', '', '', 1, '2017-04-17 14:00:03');

INSERT INTO anaxlite_users(user, pass, fname, lname, email, permission, created)
    VALUES ('Muminmamman', '$2y$10$rB9gAZnSf//wTDBNfP5q6uH2TAjF7ixVNihwULusypxeZmRupGq9a', '', '', '', 1, '2017-04-17 14:00:25');

INSERT INTO anaxlite_users(user, pass, fname, lname, email, permission, created)
    VALUES ('Muminpappan', '$2y$10$JD9sKV9gLsYV3YmzezKktOSaxreVl12uLRWdZN4nvfVXqPi7InU..', '', '', '', 1, '2017-04-17 14:00:18');

INSERT INTO anaxlite_users(user, pass, fname, lname, email, permission, created)
    VALUES ('Snusmumriken', '$2y$10$sIDrAUmMBL/MP7qznxfHzO6l.XbjgrMjGahAG52bGwY/rBckPCBWO', '', '', '', 2, '2017-04-17 14:00:11');

INSERT INTO anaxlite_users(user, pass, fname, lname, email, permission, created)
    VALUES ('Tarondar', '$2y$10$F8lqneazuyqGX9z5IEAKJux.TEFmFzgKNz75h2H589QAlI0Blu4Xm', '', '', '', 1, '2017-04-17 13:59:40');

INSERT INTO anaxlite_users(user, pass, fname, lname, email, permission, created)
    VALUES ('Snorkfr&ouml;ken', '$2y$10$FSy6AzyD8dq.mG6mTyq.vOaa1TkTOqAIz0/rEHg4pWm.cWI6YZO72', '', '', '', 1, '2017-04-17 14:00:32');


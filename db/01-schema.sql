CREATE TABLE IF NOT EXISTS fruits (
    id SERIAL PRIMARY KEY,
    name VARCHAR(35),
    category VARCHAR(20),
    season VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS vegetables (
    id SERIAL PRIMARY KEY,
    name VARCHAR(35),
    category VARCHAR(20),
    season VARCHAR(20)
);
-- TODO check varchar lengths

CREATE TABLE exercise (
    id NUMBER(4) PRIMARY KEY,
    exercise_name VARCHAR(20) UNIQUE NOT NULL,
    difficulty_level VARCHAR(12) NOT NULL,
    CHECK (difficulty_level in ('Beginner', 'Intermediate', 'Advanced'))
);

CREATE TABLE exercise_description (
    id NUMBER(4) REFERENCES exercise(id),
    exercise_description VARCHAR(200)
);

CREATE TABLE equipment (
    id NUMBER(4) PRIMARY KEY,
    equipment_name VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE muscle (
    id NUMBER(4) PRIMARY KEY,
    muscle_name VARCHAR(20) UNIQUE NOT NULL
);

CREATE TABLE required_equipment (
    exercise_id NUMBER(4) REFERENCES exercise(id),
    equipment_id NUMBER(4) REFERENCES equipment(id),
    CONSTRAINT required_equipment_primary_key PRIMARY KEY (exercise_id, equipment_id)
);

CREATE TABLE used_muscle (
    exercise_id NUMBER(4) REFERENCES exercise(id),
    muscle_id NUMBER(4) REFERENCES muscle(id),
    CONSTRAINT used_muscle_primary_key PRIMARY KEY (exercise_id, muscle_id)
);

-- examples for test

-- INSERT INTO exercise VALUES (1000, 'pull-up', 'Intermediate');
-- INSERT INTO exercise VALUES (1001, 'push-up', 'Beginner');
-- INSERT INTO exercise VALUES (1002, 'muscle-up', 'Advanced');

-- INSERT INTO equipment VALUES (1000, 'joga mat');
-- INSERT INTO equipment VALUES (1001, 'pull-up bar');

-- INSERT INTO muscle VALUES (1000, 'to many xd');

-- INSERT INTO required_equipment (1000, 1001);
-- INSERT INTO required_equipment (1001, 100);
-- INSERT INTO required_equipment (1002, 1001);

-- INSERT INTO used_muscle (1000, 1000);
-- INSERT INTO used_muscle (1001, 1000);
-- INSERT INTO used_muscle (1002, 1000);

COMMIT;
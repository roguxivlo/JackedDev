--  Select muscle names:
SELECT muscle_name FROM muscle WHERE muscle_name IN ('ABS', 'Butt/Hips');

-- For a given exercise, select the names of the muscles used in it:
SELECT exercise.id, exercise_name, muscle_name
FROM muscle JOIN used_muscle ON muscle.id = used_muscle.muscle_id
  JOIN exercise ON exercise.id = used_muscle.exercise_id
WHERE exercise_name = 'Seated Biceps Curl';

-- Select exercises, that engage given muscles:
SELECT E.id, exercise_name FROM exercise E
WHERE (
  SELECT COUNT(*) FROM
    ((SELECT muscle_name FROM muscle WHERE muscle_name IN ('Abs', 'Butt/Hips'))
    MINUS (SELECT muscle_name
      FROM muscle JOIN used_muscle ON muscle.id = used_muscle.muscle_id
        JOIN exercise ON exercise.id = used_muscle.exercise_id
      WHERE exercise.id = E.id))
) = 0;

-- Select exercises, that require given equipment:
SELECT E.id, exercise_name
FROM exercise E JOIN required_equipment ON E.id = exercise_id
  JOIN equipment ON equipment.id = equipment_id
WHERE equipment_name = 'Barbell';

-- Select exercises, that require given equipment and have specified difficulty:
SELECT E.id, exercise_name
FROM exercise E JOIN required_equipment RE ON E.id = RE.exercise_id
  JOIN equipment ON equipment.id = RE.equipment_id
WHERE equipment_name = 'Barbell' AND difficulty_level = 'Intermediate';

-- Select exercises, that fulfill all criteria:
SELECT A.id, A.exercise_name
FROM (
  SELECT E.id, exercise_name
  FROM exercise E JOIN required_equipment RE ON E.id = RE.exercise_id
  JOIN equipment ON equipment.id = RE.equipment_id
  WHERE equipment_name = 'Barbell'
    AND difficulty_level IN ('Beginner', 'Intermediate', 'Advanced')) A
WHERE (
  SELECT COUNT(*) FROM
    ((SELECT muscle_name FROM muscle WHERE muscle_name IN ('ABS'))
    MINUS (SELECT muscle_name
      FROM muscle JOIN used_muscle ON muscle.id = used_muscle.muscle_id
        JOIN exercise ON exercise.id = used_muscle.exercise_id
      WHERE exercise.id = A.id))
) = 0;
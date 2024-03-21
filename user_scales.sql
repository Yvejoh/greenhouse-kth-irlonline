CREATE TABLE IF NOT EXISTS USER_SCALES(
    ID INT NOT NULL AUTO_INCREMENT,
    USER_ID INT NOT NULL,
    SCALE_ID INT NOT NULL,
    CURRENT_LEVEL INT(1) NOT NULL,
    PLANNED_LEVEL INT(9) NOT NULL,
    PLANNED_GOAL_1 VARCHAR(1000),
    PLANNED_GOAL_2 VARCHAR(1000),
    PLANNED_GOAL_3 VARCHAR(1000),
    DEADLINE_GOAL_1 DATE,
    DEADLINE_GOAL_2 DATE,
    DEADLINE_GOAL_3 DATE,
    PRIMARY KEY(ID),
    FOREIGN KEY(USER_ID) REFERENCES USERS(ID) ON DELETE CASCADE,
    FOREIGN KEY(SCALE_ID) REFERENCES SCALES(ID) ON DELETE CASCADE
);
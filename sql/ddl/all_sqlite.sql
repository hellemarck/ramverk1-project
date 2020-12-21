--
-- Creating tables.
--

--
-- Table User
--
DROP TABLE IF EXISTS User;
CREATE TABLE User (
    "userid" INTEGER PRIMARY KEY NOT NULL,
    "username" TEXT UNIQUE NOT NULL,
    "pw" TEXT NOT NULL,
    "email" TEXT,
    -- "activity" INTEGER DEFAULT 0
);

--
-- Table Question
--
DROP TABLE IF EXISTS Question;
CREATE TABLE Question (
    "questionid" INTEGER PRIMARY KEY NOT NULL,
    "userid" INTEGER NOT NULL,
    "date" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    "title" TEXT,
    "text" TEXT,
    FOREIGN KEY("userid") REFERENCES User("userid")
);

--
-- Table Reply
--
DROP TABLE IF EXISTS Reply;
CREATE TABLE Reply (
    "replyid" INTEGER PRIMARY KEY NOT NULL,
    "questionid" INTEGER,
    "userid" INTEGER,
    "date" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    "text" TEXT,
    FOREIGN KEY("questionid") REFERENCES Question("questionid"),
    FOREIGN KEY("userid") REFERENCES User("userid")
);

--
-- Table Comment
--
DROP TABLE IF EXISTS Comment;
CREATE TABLE Comment (
    "commentid" INTEGER PRIMARY KEY NOT NULL,
    "questionid" INTEGER,
    "replyid" INTEGER,
    "userid" INTEGER,
    "date" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    "text" TEXT,
    FOREIGN KEY("userid") REFERENCES User("userid")
);

--
-- Table Tag
--
DROP TABLE IF EXISTS Tag;
CREATE TABLE Tag (
    "tagid" INTEGER PRIMARY KEY NOT NULL,
    "tag" TEXT
);

--
-- Table Tag2Question
--
DROP TABLE IF EXISTS Tag2Question;
CREATE TABLE Tag2Question (
    "id" INTEGER PRIMARY KEY NOT NULL,
    "tagid" INTEGER,
    "questionid" INTEGER,
    FOREIGN KEY("tagid") REFERENCES Tag("tagid"),
    FOREIGN KEY("questionid") REFERENCES Question("questionid")
);

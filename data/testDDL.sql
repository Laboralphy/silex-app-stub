--
-- Fichier généré par SQLiteStudio v3.1.1 sur mer. mai 17 17:31:13 2017
--
-- Encodage texte utilisé : UTF-8
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table : al_qualities
DROP TABLE IF EXISTS al_qualities;
CREATE TABLE al_qualities (id INTEGER PRIMARY KEY, label TEXT, rank INTEGER);
INSERT INTO al_qualities (id, label, rank) VALUES (1, 'high', 100);
INSERT INTO al_qualities (id, label, rank) VALUES (2, 'medium', 50);

-- Table : al_shows
DROP TABLE IF EXISTS al_shows;
CREATE TABLE al_shows (id INTEGER PRIMARY KEY AUTOINCREMENT, label TEXT NOT NULL);

-- Table : al_title_versions
DROP TABLE IF EXISTS al_title_versions;
CREATE TABLE al_title_versions (id INTEGER PRIMARY KEY AUTOINCREMENT, alang TEXT, slang TEXT, id_quality INTEGER REFERENCES al_qualities (id));
INSERT INTO al_title_versions (id, alang, slang, id_quality) VALUES (1, 'fr', NULL, 1);
INSERT INTO al_title_versions (id, alang, slang, id_quality) VALUES (2, 'ja', 'fr', 1);

-- Table : al_titles
DROP TABLE IF EXISTS al_titles;
CREATE TABLE al_titles (id INTEGER PRIMARY KEY AUTOINCREMENT, id_type INTEGER REFERENCES al_types (id) NOT NULL, n INTEGER, label TEXT);

-- Table : al_types
DROP TABLE IF EXISTS al_types;
CREATE TABLE al_types (id INTEGER PRIMARY KEY, label TEXT);
INSERT INTO al_types (id, label) VALUES (1, 'episode');
INSERT INTO al_types (id, label) VALUES (2, 'document');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;


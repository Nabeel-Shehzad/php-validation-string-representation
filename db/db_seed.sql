USE cs3620;

INSERT INTO test (col_number, col_string, col_dttm, col_password) VALUES(1, 'One', now(), '1234pass');
INSERT INTO test (col_number, col_string, col_dttm, col_password) VALUES(2, 'Two', now(), 'pass1234');
INSERT INTO test (col_number, col_string, col_dttm, col_password) VALUES(3, 'Three', now(), 'pswd1234');

SELECT * from test;
SELECT * FROM test WHERE col_string = 'Two' OR 1=1 -- AND col_number = 2

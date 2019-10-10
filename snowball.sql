CREATE SCHEMA "Snowball"
    AUTHORIZATION xdrbhlbarfsrme;
	
CREATE TABLE "Snowball"."Users"
(
    user_id integer NOT NULL,
    last_name text NOT NULL,
    first_name text NOT NULL,
    addit_funds double precision NOT NULL,
    PRIMARY KEY (user_id)
)
WITH (
    OIDS = FALSE
);

ALTER TABLE "Snowball"."Users"
    OWNER to xdrbhlbarfsrme;
	
CREATE TABLE "Snowball"."Debt"
(
    debt_id integer NOT NULL,
    debt_name text NOT NULL,
    minimum_payment double precision NOT NULL,
    remaining_amount double precision NOT NULL,
    fk_user_id integer,
    PRIMARY KEY (debt_id),
    CONSTRAINT user_id FOREIGN KEY (debt_id)
        REFERENCES "Snowball"."Users" (user_id) MATCH SIMPLE
        ON UPDATE CASCADE
        ON DELETE CASCADE
)
WITH (
    OIDS = FALSE
);

ALTER TABLE "Snowball"."Debt"
    OWNER to xdrbhlbarfsrme;
	
	CREATE TABLE "Snowball"."Schedule"
(
    schedule_id integer NOT NULL,
    date date NOT NULL,
    PRIMARY KEY (schedule_id)
)
WITH (
    OIDS = FALSE
);

ALTER TABLE "Snowball"."Schedule"
    OWNER to xdrbhlbarfsrme;
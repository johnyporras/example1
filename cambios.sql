INSERT INTO "modules" VALUES (27, 'Recargas', '#', 57, 'glyphicon glyphicon-king', '2017-5-16 00:00:00', '2017-5-17 00:00:00', NULL);

INSERT INTO "submodules" ("id", "description", "modules_id", "url", "order", "created_at", "updated_at", "deleted_at", "url2", "url3", "url4", "url5") VALUES (155, 'Historial de Recargas', 27, 'recargas/historial', 2, '2017-4-1 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO "submodules" ("id", "description", "modules_id", "url", "order", "created_at", "updated_at", "deleted_at", "url2", "url3", "url4", "url5") VALUES (154, 'Recargas Pendientes', 27, 'recargas/pendiente', 1, '2017-4-3 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL);


CREATE TABLE ac_pagos (
    id integer NOT NULL,
    id_cuenta integer,
    fechacorte date,
    monto double precision,
    fechapago date,
    hora time without time zone,
    codtransaccion character varying(150),
    modpago character(2),
    estatuspago integer,
    observacion character varying(255),
    created_at date,
    updated_at date,
    detpago character varying(255)
);


CREATE SEQUENCE ac_pagos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;



ALTER SEQUENCE ac_pagos_id_seq OWNED BY ac_pagos.id;

ALTER TABLE ONLY ac_pagos ALTER COLUMN id SET DEFAULT nextval('ac_pagos_id_seq'::regclass);

INSERT INTO ac_pagos VALUES (1, 1, '2017-06-15', 3000, NULL, NULL, NULL, NULL, 1, NULL, '2017-08-15', '2017-08-15', NULL);

--
-- PostgreSQL database dump
--

-- Dumped from database version 17.5
-- Dumped by pg_dump version 17.5

-- Started on 2025-06-07 10:51:28

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 220 (class 1259 OID 16396)
-- Name: boissons; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.boissons (
    id integer NOT NULL,
    nom character varying(100) NOT NULL,
    description text,
    prix numeric(5,2) NOT NULL,
    stock integer NOT NULL,
    categorie_id integer
);


ALTER TABLE public.boissons OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16395)
-- Name: boissons_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.boissons_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.boissons_id_seq OWNER TO postgres;

--
-- TOC entry 4877 (class 0 OID 0)
-- Dependencies: 219
-- Name: boissons_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.boissons_id_seq OWNED BY public.boissons.id;


--
-- TOC entry 218 (class 1259 OID 16389)
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    id integer NOT NULL,
    nom character varying(100) NOT NULL
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16388)
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO postgres;

--
-- TOC entry 4878 (class 0 OID 0)
-- Dependencies: 217
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- TOC entry 222 (class 1259 OID 24589)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    email character varying(100) NOT NULL,
    password character varying(255) NOT NULL,
    role character varying(20) DEFAULT 'user'::character varying,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 24588)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 4879 (class 0 OID 0)
-- Dependencies: 221
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 4706 (class 2604 OID 16399)
-- Name: boissons id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boissons ALTER COLUMN id SET DEFAULT nextval('public.boissons_id_seq'::regclass);


--
-- TOC entry 4705 (class 2604 OID 16392)
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- TOC entry 4707 (class 2604 OID 24592)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 4869 (class 0 OID 16396)
-- Dependencies: 220
-- Data for Name: boissons; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.boissons (id, nom, description, prix, stock, categorie_id) FROM stdin;
1	Coca-Cola	Soda classique	1.50	50	1
2	Fanta	Soda orange	1.40	30	1
3	Jus d'orange	100% pur jus	2.00	40	2
4	Evian	Eau minérale	1.00	100	3
5	Heineken	Bière blonde	2.50	20	4
7	Cristaline	Eau minérale	1.00	70	3
8	Bush triple	bière triple	2.70	30	4
9	Jus de pomme	jus de pomme naturel	1.80	40	2
10	Sprite	Eau gazeuse citronné	2.00	50	1
\.


--
-- TOC entry 4867 (class 0 OID 16389)
-- Dependencies: 218
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, nom) FROM stdin;
1	Sodas
2	Jus
3	Eaux
4	Bières
\.


--
-- TOC entry 4871 (class 0 OID 24589)
-- Dependencies: 222
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, email, password, role, created_at) FROM stdin;
3	Admin	Admin@gmail.com	$2y$10$X8fcee5vwmIDkegPdSxrpO1MxhLvMIu2yCLlMcZY.Y4r2kNkh1XZe	admin	2025-06-07 01:40:03.259407
6	Ophélie	Ophelie@gmail.com	$2y$10$YLvBw.6YeqASC.bkRHhzhOGxt9Q/Y4rtJbh8QvHTI8Z03VsXgSDkW	user	2025-06-07 02:54:30.797206
7	Noah	noah.kula@condorcet.be	$2y$10$WVueG9M/mIOd5A0ay.a/Gezxm8FsbMzFNDBcv7fejX6I.oMbBhGv2	user	2025-06-07 09:16:38.487466
\.


--
-- TOC entry 4880 (class 0 OID 0)
-- Dependencies: 219
-- Name: boissons_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.boissons_id_seq', 10, true);


--
-- TOC entry 4881 (class 0 OID 0)
-- Dependencies: 217
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 4, true);


--
-- TOC entry 4882 (class 0 OID 0)
-- Dependencies: 221
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 7, true);


--
-- TOC entry 4713 (class 2606 OID 16403)
-- Name: boissons boissons_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boissons
    ADD CONSTRAINT boissons_pkey PRIMARY KEY (id);


--
-- TOC entry 4711 (class 2606 OID 16394)
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- TOC entry 4715 (class 2606 OID 24600)
-- Name: users users_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- TOC entry 4717 (class 2606 OID 24596)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 4719 (class 2606 OID 24598)
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- TOC entry 4720 (class 2606 OID 16404)
-- Name: boissons boissons_categorie_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.boissons
    ADD CONSTRAINT boissons_categorie_id_fkey FOREIGN KEY (categorie_id) REFERENCES public.categories(id);


-- Completed on 2025-06-07 10:51:28

--
-- PostgreSQL database dump complete
--


CREATE SCHEMA uptown;

CREATE TABLE uptown.estate_sheets ( 
	id                   integer  NOT NULL,
	CONSTRAINT "pk_estate sheet" PRIMARY KEY ( id )
 );

CREATE TABLE uptown.users ( 
	id                   integer  NOT NULL,
	email                varchar(70)  ,
	"role"               varchar(20)  ,
	confirm              bool  ,
	CONSTRAINT pk_users PRIMARY KEY ( id )
 );

CREATE TABLE uptown.ads ( 
	id                   integer  NOT NULL,
	estate_type          integer  ,
	price                integer  ,
	total_area           float8  ,
	living_area          float8  ,
	kitchen_area         float8  ,
	number_of_rooms      integer  ,
	number_of_balconies  integer  ,
	balconies_area       float8  ,
	have_photos          integer  ,
	floor                integer  ,
	description          text  ,
	last_floor           bool  ,
	number_of_lifts      integer  ,
	transaction_type     integer  ,
	user_id              integer  ,
	numbers_of_wc        integer  ,
	wc_type              integer  ,
	create_time          timestamp  ,
	total_floors         integer  ,
	open_plan            bool  ,
	part                 bool  ,
	possible_mortgage    bool  ,
	city                 integer  ,
	street               varchar(45)  ,
	house_number         integer  ,
	corps                varchar(10)  ,
	window_view          varchar(30)  ,
	telephone            varchar(17)  ,
	published            bool  ,
	CONSTRAINT pk_ads PRIMARY KEY ( id )
 );

CREATE INDEX idx_ads ON uptown.ads ( user_id );

COMMENT ON COLUMN uptown.ads.estate_type IS 'Тип недвижимости: квартиры, загородная недвижимость или нежилая';

COMMENT ON COLUMN uptown.ads.price IS 'Цена';

COMMENT ON COLUMN uptown.ads.total_area IS 'Общая площадь';

COMMENT ON COLUMN uptown.ads.living_area IS 'Жилая площадь';

COMMENT ON COLUMN uptown.ads.kitchen_area IS 'Площадь кухни';

COMMENT ON COLUMN uptown.ads.number_of_rooms IS 'Количество комнат';

COMMENT ON COLUMN uptown.ads.number_of_balconies IS 'Количество балконов';

COMMENT ON COLUMN uptown.ads.balconies_area IS 'Площадь балконов';

COMMENT ON COLUMN uptown.ads.have_photos IS 'Имеются фотографии';

COMMENT ON COLUMN uptown.ads.floor IS 'Этаж';

COMMENT ON COLUMN uptown.ads.description IS 'Описание';

COMMENT ON COLUMN uptown.ads.last_floor IS 'Последний этаж';

COMMENT ON COLUMN uptown.ads.number_of_lifts IS 'Количество лифтов';

COMMENT ON COLUMN uptown.ads.transaction_type IS 'Тип сделки: свободная или альтернативная';

COMMENT ON COLUMN uptown.ads.numbers_of_wc IS 'Количество санузлов';

COMMENT ON COLUMN uptown.ads.wc_type IS 'Тип санузлов: совмешенный или раздельный';

COMMENT ON COLUMN uptown.ads.total_floors IS 'Этажность дома';

COMMENT ON COLUMN uptown.ads.open_plan IS 'Свободная планировка';

COMMENT ON COLUMN uptown.ads.part IS 'Доля';

COMMENT ON COLUMN uptown.ads.possible_mortgage IS 'Возможна ипотека';

COMMENT ON COLUMN uptown.ads.street IS 'Улица';

COMMENT ON COLUMN uptown.ads.corps IS 'Корпус';

COMMENT ON COLUMN uptown.ads.window_view IS 'Вид из окна';

COMMENT ON COLUMN uptown.ads.telephone IS 'Телефон';

COMMENT ON COLUMN uptown.ads.published IS 'Опубликовано';

ALTER TABLE uptown.ads ADD CONSTRAINT fk_ads_users FOREIGN KEY ( user_id ) REFERENCES uptown.users( id );


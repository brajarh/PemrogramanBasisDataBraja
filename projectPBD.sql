CREATE TABLE PRODUK (
idProduk INT NOT NULL,
jenis CHAR(1),
namaProduk VARCHAR(45) NOT NULL,
idsatuan INT NOT NULL,
Setatus tinyint,
harga INT
);
ALTER TABLE PRODUK
ADD CONSTRAINT fksatuan
FOREIGN KEY (idsatuan)
REFERENCES SATUAN(idsatuan);
ALTER TABLE PRODUK
ADD PRIMARY KEY(idProduk);

SELECT * FROM PRODUK;




CREATE TABLE SATUAN (
idsatuan INT NOT NULL,
namaSatuan VARCHAR(45) NOT NULL,
Status tinyint
);

ALTER TABLE SATUAN
add PRIMARY KEY(idsatuan);

SELECT * FROM SATUAN;


CREATE TABLE PENGADAAN (
idPengadaan BIGINT PRIMARY KEY NOT NULL,
timestamp TIMESTAMP,
user_iduser INT NOT NULL,
status CHAR(1) NOT NULL,
vendor_idvendor INT NOT NULL,
subtotal_nilai INT ,
ppn INT,
total_nilai INT
);

CREATE TABLE PENERIMAAN (
idpenerimaan BIGINT PRIMARY KEY NOT NULL,
created_at TIMESTAMP not NULL,
status CHAR(1),
idpengadaan BIGINT,
iduser INT
);

CREATE TABLE PENJUALAN (
idpenjualan INT PRIMARY KEY NOT NULL,
created_at TIMESTAMP,
subtotal_nilai INT,
ppn INT,
total_nilai INT,
iduser INT,
idmargin_penjualan INT);

CREATE TABLE MARGIN_PENJUALAN (
idmargin_penjualan INT PRIMARY KEY NOT NULL,
created_at TIMESTAMP,
persen DOUBLE,
status tinyint,
iduser INT,
updated_at TIMESTAMP);

CREATE TABLE USER (
iduser INT PRIMARY KEY NOT NULL,
username VARCHAR(45),
password VARCHAR(100),
idrole INT);

CREATE TABLE ROLE (
idrole INT PRIMARY KEY NOT NULL,
nama_role VARCHAR(100));
SELECT * FROM `ROLE`;

CREATE TABLE detail_pengadaan (
iddetail_pengadaan BIGINT PRIMARY KEY NOT NULL,
harga_satuan INT,
jumlah INT,
sub_total INT,
idbarang INT,
idpengadaan INT);


CREATE TABLE detail_penerimaan (
iddetail_penerimaan BIGINT PRIMARY KEY NOT NULL,
idpenerimaan BIGINT,
barang_idbarang INT,
jumlah_terima int,
harga_satuan_terima INT,
sub_total_terima INT );

CREATE TABLE detail_penjualan (
iddetail_penjualan BIGINT PRIMARY KEY NOT NULL,
harga_satuan INT,
jumlah INT,
subtotal INT,
penjualan_idpenjualan INT,
idbarang INT) ;


ALTER TABLE detail_pengadaan
ADD CONSTRAINT fk_detail_pengadaan_barang
FOREIGN KEY(idbarang)
REFERENCES PRODUK(idProduk);

ALTER TABLE detail_pengadaan
ADD CONSTRAINT fk_detail_pengadaan
FOREIGN KEY(idpengadaan)
REFERENCES PENGADAAN(idpengadaan);

SELECT * FROM detail_pengadaan;

ALTER TABLE PENGADAAN
RENAME COLUMN idPengadaan to idpengadaan;

ALTER TABLE detail_pengadaan
modify idpengadaan BIGINT;

ALTER TABLE detail_penerimaan
ADD CONSTRAINT fk_penerimaan
FOREIGN KEY(idpenerimaan)
REFERENCES PENERIMAAN(idpenerimaan);

ALTER table detail_penerimaan
ADD CONSTRAINT fk_barang
FOREIGN KEY(barang_idbarang)
REFERENCES PRODUK(idProduk);
SELECT * FROM detail_penerimaan;


CREATE TABLE KARTU_STOK (
idkartu_stok BIGINT PRIMARY KEY NOT NULL,
jenis_transaksi CHAR(1),
masuk INT,
keluar INT,
stock INT,
created_at TIMESTAMP,
idtransaksi INT,
idproduk int,
CONSTRAINT fk_idproduk_kartustok
FOREIGN KEY(idproduk)
REFERENCES PRODUK(idProduk)
);

SELECT * FROM KARTU_STOK;

CREATE TABLE VENDOR (
idvendor INT PRIMARY KEY NOT NULL,
nama_vendor VARCHAR(100),
badan_hukum CHAR(1),
status CHAR(1)
);

SELECT * FROM VENDOR;


ALTER TABLE PENGADAAN
ADD CONSTRAINT fk_iduser_pengadaan
FOREIGN KEY(user_iduser)
REFERENCES USER(iduser);

ALTER TABLE PENGADAAN
ADD CONSTRAINT fk_vendor_pengadaan
FOREIGN KEY(vendor_idvendor)
REFERENCES vendor(idvendor);
SELECT * FROM PENGADAAN;

ALTER TABLE USER
ADD CONSTRAINT fk_role_user
FOREIGN KEY(idrole)
REFERENCES ROLE(idrole);
SELECT * FROM USER;	CREATE TABLES PRODUK 
(idProduk INT NOT NULL,
jenis CHAR(1),
namaProduk VARCHAR(45) NOT NULL,
idsatuan INT NOT NULL,
Setatus tinyint,
harga INT
);

ALTER TABLE PENERIMAAN
ADD CONSTRAINT fk_pengadaan_penerimaan
FOREIGN KEY(idpengadaan)
REFERENCES PENGADAAN(idpengadaan);

ALTER TABLE PENERIMAAN
ADD CONSTRAINT fk_user_penerimaan
FOREIGN KEY(iduser)
REFERENCES USER(iduser);

SELECT * FROM PENERIMAAN;


INSERT INTO ROLE
VALUES (1, 'General Manager'),
(2, 'Finance Manager'),
(3, 'Store Manager');


SELECT * FROM ROLE;

INSERT INTO USER
VALUES (1, 'brajarh', '12345678', 1 );

SELECT u.username, r.nama_role 
FROM USER u
LEFT JOIN ROLE r
ON u.idrole = r.idrole;

SELECT * FROM USER;


INSERT INTO USER
VALUES (2, 'daffawaw', '12345678', 3 );


INSERT INTO VENDOR
VALUES (1, 'Salon Supplier Sidoarjo', '1', '1'),
(2, 'Kahf', '1', '1');

SELECT * FROM VENDOR;

ALTER TABLE PENJUALAN
add CONSTRAINT fk_user_penjualan
FOREIGN KEY(iduser)
REFERENCES USER(iduser);

ALTER TABLE PENJUALAN
ADD CONSTRAINT fk_margin_penjualan
FOREIGN KEY(idmargin_penjualan)
REFERENCES MARGIN_PENJUALAN(idmargin_penjualan);

SELECT * FROM PENJUALAN;

ALTER TABLE detail_penjualan
ADD CONSTRAINT fk_penjualan_detailpenjualan
FOREIGN KEY(penjualan_idpenjualan)
REFERENCES PENJUALAN(idpenjualan);

ALTER TABLE detail_penjualan
ADD CONSTRAINT fk_barang;


INSERT INTO SATUAN
VALUES (1, 'MiliLiter', 1),
(2, 'pcs', 1),
(3, 'pack', 0);

SELECT * FROM SATUAN; 

INSERT INTO PRODUK
VALUES (1, 's','Kahf Pomade Mate Dapper', 2,1, 40000),
(2, 's','Kahf Pomade Sleek Classy', 2, 1, 40000),
(3, 's','Kahf Hair Powder', 2, 0, 37000);



SELECT * FROM PRODUK;

CREATE TABLE RETUR (
idretur BIGINT PRIMARY KEY NOT NULL,
created_at TIMESTAMP,
idpenerimaan BIGINT,
iduser INT,
CONSTRAINT fk_idpenerimaan_retur
FOREIGN KEY(idpenerimaan)
REFERENCES PENERIMAAN(idpenerimaan),
CONSTRAINT fk_iduser_retur
FOREIGN KEY(iduser)
REFERENCES USER(iduser));

SELECT * FROM retur;

CREATE TABLE detail_retur
(iddetail_retur INT PRIMARY KEY NOT NULL,
jumlah INT,
alasan VARCHAR(200),
idretur BIGINT,
iddetail_penerimaan BIGINT,
CONSTRAINT fk_idretur_detail
FOREIGN KEY(idretur)
REFERENCES retur(idretur),
CONSTRAINT fk_detailpenerimaan_detailretur
FOREIGN KEY (iddetail_penerimaan)
REFERENCES detail_penerimaan(iddetail_penerimaan));

SELECT * FROM detail_retur;


INSERT INTO MARGIN_PENJUALAN
VALUES (1, CURRENT_TIMESTAMP, 10, 0, 1, CURRENT_TIMESTAMP ),
(2, CURRENT_TIMESTAMP, 20, 0, 1, CURRENT_TIMESTAMP ),
(3, CURRENT_TIMESTAMP, 30, 0, 2, CURRENT_TIMESTAMP ),
(4, CURRENT_TIMESTAMP, 40, 1, 2, CURRENT_TIMESTAMP ),
(5, CURRENT_TIMESTAMP, 50, 0, 1, CURRENT_TIMESTAMP );

INSERT INTO MARGIN_PENJUALAN(idmargin_penjualan, iduser)
VALUES (6, 4);

SELECT * FROM MARGIN_PENJUALAN;

SELECT * FROM detail_penjualan;

UPDATE MARGIN_PENJUALAN
set iduser=2
WHERE iduser=4;

ALTER TABLE MARGIN_PENJUALAN
ADD CONSTRAINT fk_iduser_margin
FOREIGN KEY(iduser)
REFERENCES USER(iduser);


SELECT p.namaProduk AS 'Nama Produk',  s.namaSatuan as 'Satuan', p.harga as 'Harga'
FROM PRODUK p
JOIN SATUAN s ON p.idsatuan = s.idsatuan;


CREATE VIEW Product AS
SELECT p.namaProduk AS 'Nama Produk',  s.namaSatuan as 'Satuan', p.harga as 'Harga'
FROM PRODUK p
JOIN SATUAN s ON p.idsatuan = s.idsatuan;


SELECT * FROM product;


CREATE VIEW stokproduk AS SELECT
p.namaProduk as PRODUK, p.harga AS HARGA, ks.stock, s.namaSatuan
FROM PRODUK p 
join SATUAN s on p.idsatuan = s.idsatuan
JOIN KARTU_STOK ks on p.idProduk = ks.idproduk;

SELECT * from stokproduk;




CREATE VIEW pengadaanDetail as SELECT
dtlADA.iddetail_pengadaan as ID , v.nama_vendor as VENDOR, p.namaProduk as PRODUK, dtlADA.jumlah as JUMLAH, dtlADA.harga_satuan as HARGA, dtlADA.sub_total as TOTAL
FROM detail_pengadaan dtlADA
join PENGADAAN ada on dtlADA.idpengadaan = ada.idpengadaan
join PRODUK p on dtlADA.idbarang = p.idProduk
join vendor v on ada.vendor_idvendor = v.idvendor;

SELECT * FROM pengadaanDetail;


CREATE VIEW V_USER as SELECT
u.iduser as 'ID', u.username as 'USERNAME', r.nama_role 'ROLE'
FROM USER u 
join ROLE r on u.iduser=r.idrole;

SELECT * from V_USER;

CREATE VIEW V_VENDOR as SELECT;


CREATE VIEW V_satuan as SELECT namaSatuan as 'SATUAN', Status
from SATUAN;

SELECT * from V_satuan;

SELECT * from P 


SELECT
u.iduser as 'ID', u.username as 'USERNAME', r.nama_role 'ROLE'
FROM USER u 
join ROLE r on u.iduser=r.idrole;





SELECT
dtlADA.iddetail_pengadaan as ID , v.nama_vendor as VENDOR, p.namaProduk as PRODUK, dtlADA.jumlah as JUMLAH, dtlADA.harga_satuan as HARGA, dtlADA.sub_total as TOTAL
FROM detail_pengadaan dtlADA
join PENGADAAN ada on dtlADA.idpengadaan = ada.idpengadaan
join PRODUK p on dtlADA.idbarang = p.idProduk
join vendor v on ada.vendor_idvendor = v.idvendor;





DELIMITER ##
CREATE PROCEDURE inputprodukbaru( 
ada.idpengadaan BIGINT,
ada.ppn int,
ada.status char(1),
ada.subtotal_nilai int,
ada.timestamp timestamp,
ada.total_nilai int,
ada.user_iduser int,
ada.vendor_idvendor,
p.idProduk int,
p.jenis char(1),
p.namaProduk varchar(45),
p.idsatuan int,
p.status tinyint,
p.harga int)

BEGIN
insert into PENGADAAN
VALUES (ada.idpengadaan,
ada.timestamp,
ada.user_iduser,
ada.status,
ada.vendor_idvendor,
ada.subtotal_nilai,
ada.ppn,
ada.total_nilai
);

INSERT INTO PRODUK
VALUES (
p.idProduk,
p.jenis,
p.namaProduk,
p.idsatuan,
p.status, 
p.harga);



INSERT
END


DELIMITER ;


SELECT * FROM PENGADAAN;

select * from PRODUK;


ALTER TABLE PRODUK
RENAME COLUMN Setatus to status;




DELIMITER ##
CREATE PROCEDURE inputprodukbaru( 
idProduk int,
jenis char(1),
namaProduk varchar(45),
idsatuan int,
status tinyint,
harga int)

BEGIN

INSERT INTO PRODUK
VALUES (
idProduk,
jenis,
namaProduk,
idsatuan,
status, 
harga);

SELECT * FROM PRODUK;


END##


DELIMITER ;


CALL inputprodukbaru(
    5,
    'B',
    'Produk Baru lagi',
    1,
    1,
    20000
);

DROP PROCEDURE IF EXISTS inputprodukbaru;




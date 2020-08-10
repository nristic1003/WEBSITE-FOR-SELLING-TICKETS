CREATE TABLE [Dogadjaj]
( 
	[IdD]                int  NOT NULL ,
	[Naziv]              varchar(40)  NOT NULL ,
	[Cena]               integer  NOT NULL ,
	[Datum]              datetime  NOT NULL ,
	[Lokacija]           varchar(20)  NOT NULL ,
	[Slika]              image  NOT NULL 
)
go

ALTER TABLE [Dogadjaj]
	ADD CONSTRAINT [XPKDogadjaj] PRIMARY KEY  CLUSTERED ([IdD] ASC)
go

CREATE TABLE [Ima_Ulogu]
( 
	[IdK]                int  NOT NULL ,
	[IdU]                int  NOT NULL 
)
go

ALTER TABLE [Ima_Ulogu]
	ADD CONSTRAINT [XPKIma_Ulogu] PRIMARY KEY  CLUSTERED ([IdK] ASC,[IdU] ASC)
go

CREATE TABLE [Korisnik]
( 
	[IdK]                int  NOT NULL ,
	[Ime]                varchar(20)  NOT NULL ,
	[Prezime]            varchar(20)  NOT NULL ,
	[KorIme]             varchar(15)  NOT NULL ,
	[Email]              varchar(50)  NOT NULL ,
	[Sifra]              varchar(20)  NOT NULL ,
	[Telefon]            varchar(15)  NOT NULL ,
	[JMBG]               char(13)  NOT NULL ,
	[BRLK]               char(9)  NOT NULL ,
	[Grad]               varchar(15)  NOT NULL ,
	[Adresa]             varchar(30)  NOT NULL 
)
go

ALTER TABLE [Korisnik]
	ADD CONSTRAINT [XPKKorisnik] PRIMARY KEY  CLUSTERED ([IdK] ASC)
go

CREATE TABLE [Manifestacija]
( 
	[IdM]                char(18)  NOT NULL ,
	[Slika]              char(18)  NULL ,
	[Naziv]              char(18)  NULL ,
	[Opis]               char(18)  NULL ,
	[IdD]                int  NOT NULL 
)
go

ALTER TABLE [Manifestacija]
	ADD CONSTRAINT [XPKManifestacija] PRIMARY KEY  CLUSTERED ([IdM] ASC,[IdD] ASC)
go

CREATE TABLE [Manifestacija]
( 
	[IdD]                int  NOT NULL ,
	[Opis]               varchar(150)  NOT NULL 
)
go

ALTER TABLE [Manifestacija]
	ADD CONSTRAINT [XPKManifestacija] PRIMARY KEY  CLUSTERED ([IdD] ASC)
go

CREATE TABLE [Oglas]
( 
	[IdD]                int  NOT NULL ,
	[IdK]                int  NOT NULL ,
	[BrojKarata]         integer  NOT NULL 
)
go

ALTER TABLE [Oglas]
	ADD CONSTRAINT [XPKOglas] PRIMARY KEY  CLUSTERED ([IdD] ASC)
go

CREATE TABLE [Transakcija]
( 
	[IdT]                int  NOT NULL ,
	[IdK]                int  NOT NULL ,
	[IdD]                int  NOT NULL ,
	[Cena]               integer  NOT NULL ,
	[BrojKartice]        varchar(16)  NOT NULL ,
	[Ishod]              bit  NOT NULL 
)
go

ALTER TABLE [Transakcija]
	ADD CONSTRAINT [XPKTransakcija] PRIMARY KEY  CLUSTERED ([IdT] ASC)
go

CREATE TABLE [Uloga]
( 
	[IdU]                int  NOT NULL ,
	[Opis]               varchar(10)  NOT NULL 
)
go

ALTER TABLE [Uloga]
	ADD CONSTRAINT [XPKUloga] PRIMARY KEY  CLUSTERED ([IdU] ASC)
go


ALTER TABLE [Ima_Ulogu]
	ADD CONSTRAINT [R_1] FOREIGN KEY ([IdK]) REFERENCES [Korisnik]([IdK])
		ON DELETE CASCADE
		ON UPDATE NO ACTION
go

ALTER TABLE [Ima_Ulogu]
	ADD CONSTRAINT [R_2] FOREIGN KEY ([IdU]) REFERENCES [Uloga]([IdU])
		ON DELETE CASCADE
		ON UPDATE NO ACTION
go


ALTER TABLE [Manifestacija]
	ADD CONSTRAINT [R_12] FOREIGN KEY ([IdD]) REFERENCES [Dogadjaj]([IdD])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go


ALTER TABLE [Manifestacija]
	ADD CONSTRAINT [R_16] FOREIGN KEY ([IdD]) REFERENCES [Dogadjaj]([IdD])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go


ALTER TABLE [Oglas]
	ADD CONSTRAINT [R_15] FOREIGN KEY ([IdD]) REFERENCES [Dogadjaj]([IdD])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go

ALTER TABLE [Oglas]
	ADD CONSTRAINT [R_17] FOREIGN KEY ([IdK]) REFERENCES [Korisnik]([IdK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Transakcija]
	ADD CONSTRAINT [R_18] FOREIGN KEY ([IdK]) REFERENCES [Korisnik]([IdK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Transakcija]
	ADD CONSTRAINT [R_19] FOREIGN KEY ([IdD]) REFERENCES [Manifestacija]([IdD])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go
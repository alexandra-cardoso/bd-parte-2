drop table if exists ano_estabelecimento ;
drop table if exists produto_estabelecimento ;
drop table if exists transporte_zona ;
drop table if exists listado_por ;
drop table if exists Empresa ;
drop table if exists Aluno ;
drop table if exists Curso ;
drop table if exists Turma ;
drop table if exists Estagio ;
drop table if exists Formador ;
drop table if exists RamoDeAtividade ;
drop table if exists Estabelecimento ;
drop table if exists Produto ;
drop table if exists Responsavel ;
drop table if exists AnoLetivo ;
drop table if exists User ;
drop table if exists Administrativo ;
drop table if exists TipoEstabelecimento ;
drop table if exists zona ;
drop table if exists transporte ;
drop table if exists TipoTransporte ;
 
create table ano_estabelecimento
(
   Estabelecimento_Estabelecimento_ID_   integer   not null,
   AnoLetivo_AnoLetivo_ID_   integer   not null,
 
   constraint PK_ano_estabelecimento primary key (Estabelecimento_Estabelecimento_ID_, AnoLetivo_AnoLetivo_ID_)
);
 
create table produto_estabelecimento
(
   Estabelecimento_Estabelecimento_ID_   integer   not null,
   Produto_Produto_ID_   integer   not null,
 
   constraint PK_produto_estabelecimento primary key (Estabelecimento_Estabelecimento_ID_, Produto_Produto_ID_)
);
 
create table transporte_zona
(
   zona_zona_ID_   integer   not null,
   transporte_transporte_ID_   integer   not null,
 
   constraint PK_transporte_zona primary key (zona_zona_ID_, transporte_transporte_ID_)
);
 
create table listado_por
(
   Estabelecimento_Estabelecimento_ID_   integer   not null,
   zona_zona_ID_   integer   not null,
 
   constraint PK_listado_por primary key (Estabelecimento_Estabelecimento_ID_, zona_zona_ID_)
);
 
create table Empresa
(
   Empresa_ID   integer   not null,
   firma   varchar(100)   null,
   nContribuinte   Integer   null,
   moradaSede   varchar(100)   null,
   localidade   varchar(50)   null,
   codigoPostal   varchar(10)   null,
   telefone   Integer   null,
   email   varchar(50)   null,
   website   varchar(50)   null,
   obs   varchar(500)   null,
   disponibilidade   bit   null,
   nEstagiarios   Integer   null,
 
   constraint PK_Empresa primary key (Empresa_ID)
);
 
create table Aluno
(
   Turma_Curso_Curso_ID   integer   not null,
   Turma_Turma_ID   integer   not null,
   User_User_ID   integer   not null,
   numero   Integer   null,
   obs   varchar(500)   null,
 
   constraint PK_Aluno primary key (User_User_ID)
);
 
create table Curso
(
   Curso_ID   integer   not null,
   designacao   varchar(100)   null,
   codigo   Integer   null,
   anosLetivos   Integer   null,
 
   constraint PK_Curso primary key (Curso_ID)
);
 
create table Turma
(
   Curso_Curso_ID   integer   not null,
   Turma_ID   integer   not null,
   sigla   varchar(3)   null,
   ano   YEAR   null,
   capacidade   Integer   null,
 
   constraint PK_Turma primary key (Curso_Curso_ID, Turma_ID)
);
 
create table Estagio
(
   Aluno_User_User_ID   integer   not null,
   Formador_User_User_ID   integer   not null,
   Estabelecimento_Estabelecimento_ID   integer   not null,
   Responsavel_Responsavel_ID   integer   not null,
   Estagio_ID   integer   not null,
   dataInicio   DATE   null,
   dataFim   DATE   null,
   NotaEmpresa   Integer   null,
   NotaEscola   Integer   null,
   NotaProcura   Integer   null,
   NotaRelatorio   Integer   null,
   NotaFinal   Integer   null,
   classificacao   Integer   null,
 
   constraint PK_Estagio primary key (Estagio_ID)
);
 
create table Formador
(
   User_User_ID   integer   not null,
   numero   Integer   null,
   disciplina   integer   null,
 
   constraint PK_Formador primary key (User_User_ID)
);
 
create table RamoDeAtividade
(
   Empresa_Empresa_ID   integer   not null,
   RamoDeAtividade_ID   integer   not null,
   CAE   Integer   null,
   descricao   varchar(100)   null,
 
   constraint PK_RamoDeAtividade primary key (RamoDeAtividade_ID)
);
 
create table Estabelecimento
(
   Empresa_Empresa_ID   integer   null,
   TipoEstabelecimento_TipoEstabelecimento_ID   integer   not null,
   Estabelecimento_ID   integer   not null,
   nome   varchar(50)   null,
   morada   varchar(100)   null,
   localidade   varchar(50)   null,
   codigoPostal   Integer   null,
   telefone   Integer   null,
   email   varchar(50)   null,
   foto   BLOB   null,
   horario   DATETIME   null,
   dataFundacao   DATE   null,
   aceitouFuncAntes   bit   null,
   obs   varchar(500)   null,
 
   constraint PK_Estabelecimento primary key (Estabelecimento_ID)
);
 
create table Produto
(
   Produto_ID   integer   not null,
   nome   varchar(100)   null,
   marca   varchar(50)   null,
 
   constraint PK_Produto primary key (Produto_ID)
);
 
create table Responsavel
(
   Estabelecimento_Estabelecimento_ID   integer   not null,
   Responsavel_ID   integer   not null,
   nome   varchar(100)   null,
   titulo   varchar(50)   null,
   cargo   varchar(50)   null,
   telefoneDireto   Integer   null,
   telemovel   Integer   null,
   email   varchar(50)   null,
   obs   varchar(500)   null,
 
   constraint PK_Responsavel primary key (Responsavel_ID)
);
 
create table AnoLetivo
(
   AnoLetivo_ID   integer   not null,
   media   Integer   null,
   ano   YEAR   null,
 
   constraint PK_AnoLetivo primary key (AnoLetivo_ID)
);
 
create table User
(
   User_ID   integer   not null,
   nome   varchar(100)   null,
   login   varchar(50)   null,
   password   varchar(50)   null,
 
   constraint PK_User primary key (User_ID)
);
 
create table Administrativo
(
   User_User_ID   integer   not null,
 
   constraint PK_Administrativo primary key (User_User_ID)
);
 
create table TipoEstabelecimento
(
   TipoEstabelecimento_ID   integer   not null,
   tipo   varchar(50)   null,
 
   constraint PK_TipoEstabelecimento primary key (TipoEstabelecimento_ID)
);
 
create table zona
(
   zona_ID   integer   not null,
   designacao   varchar(100)   null,
   localidade   varchar(50)   null,
   mapa   JSON   null,
 
   constraint PK_zona primary key (zona_ID)
);
 
create table transporte
(
   TipoTransporte_TipoTransporte_ID   integer   not null,
   transporte_ID   integer   not null,
   linha   varchar(10)   null,
   observacoes   varchar(500)   null,
 
   constraint PK_transporte primary key (transporte_ID)
);
 
create table TipoTransporte
(
   TipoTransporte_ID   integer   not null,
   tipo   varchar(100)   null,
 
   constraint PK_TipoTransporte primary key (TipoTransporte_ID)
);
 
alter table ano_estabelecimento
   add constraint FK_Estabelecimento_ano_estabelecimento_AnoLetivo_ foreign key (Estabelecimento_Estabelecimento_ID_)
   references Estabelecimento(Estabelecimento_ID)
   on delete cascade
   on update cascade
; 
alter table ano_estabelecimento
   add constraint FK_AnoLetivo_ano_estabelecimento_Estabelecimento_ foreign key (AnoLetivo_AnoLetivo_ID_)
   references AnoLetivo(AnoLetivo_ID)
   on delete cascade
   on update cascade
;
 
alter table produto_estabelecimento
   add constraint FK_Estabelecimento_produto_estabelecimento_Produto_ foreign key (Estabelecimento_Estabelecimento_ID_)
   references Estabelecimento(Estabelecimento_ID)
   on delete cascade
   on update cascade
; 
alter table produto_estabelecimento
   add constraint FK_Produto_produto_estabelecimento_Estabelecimento_ foreign key (Produto_Produto_ID_)
   references Produto(Produto_ID)
   on delete cascade
   on update cascade
;
 
alter table transporte_zona
   add constraint FK_zona_transporte_zona_transporte_ foreign key (zona_zona_ID_)
   references zona(zona_ID)
   on delete cascade
   on update cascade
; 
alter table transporte_zona
   add constraint FK_transporte_transporte_zona_zona_ foreign key (transporte_transporte_ID_)
   references transporte(transporte_ID)
   on delete cascade
   on update cascade
;
 
alter table listado_por
   add constraint FK_Estabelecimento_listado_por_zona_ foreign key (Estabelecimento_Estabelecimento_ID_)
   references Estabelecimento(Estabelecimento_ID)
   on delete cascade
   on update cascade
; 
alter table listado_por
   add constraint FK_zona_listado_por_Estabelecimento_ foreign key (zona_zona_ID_)
   references zona(zona_ID)
   on delete cascade
   on update cascade
;
 
 
alter table Aluno
   add constraint FK_Aluno_aluno_turma_Turma foreign key (Turma_Curso_Curso_ID, Turma_Turma_ID)
   references Turma(Curso_Curso_ID, Turma_ID)
   on delete restrict
   on update cascade
; 
alter table Aluno
   add constraint FK_Aluno_User foreign key (User_User_ID)
   references User(User_ID)
   on delete cascade
   on update cascade
;
 
 
alter table Turma
   add constraint FK_Turma_turma_curso_Curso foreign key (Curso_Curso_ID)
   references Curso(Curso_ID)
   on delete cascade
   on update cascade
;
 
alter table Estagio
   add constraint FK_Estagio_estagio_aluno_Aluno foreign key (Aluno_User_User_ID)
   references Aluno(User_User_ID)
   on delete restrict
   on update cascade
; 
alter table Estagio
   add constraint FK_Estagio_estagio_formador_Formador foreign key (Formador_User_User_ID)
   references Formador(User_User_ID)
   on delete restrict
   on update cascade
; 
alter table Estagio
   add constraint FK_Estagio_estagio_estabelecimento_Estabelecimento foreign key (Estabelecimento_Estabelecimento_ID)
   references Estabelecimento(Estabelecimento_ID)
   on delete restrict
   on update cascade
; 
alter table Estagio
   add constraint FK_Estagio_estagio_responsavel_Responsavel foreign key (Responsavel_Responsavel_ID)
   references Responsavel(Responsavel_ID)
   on delete restrict
   on update cascade
;
 
alter table Formador
   add constraint FK_Formador_User foreign key (User_User_ID)
   references User(User_ID)
   on delete cascade
   on update cascade
;
 
alter table RamoDeAtividade
   add constraint FK_RamoDeAtividade_ramo_atividade_empresa_Empresa foreign key (Empresa_Empresa_ID)
   references Empresa(Empresa_ID)
   on delete restrict
   on update cascade
;
 
alter table Estabelecimento
   add constraint FK_Estabelecimento_empresa_estabelecimento_Empresa foreign key (Empresa_Empresa_ID)
   references Empresa(Empresa_ID)
   on delete set null
   on update cascade
; 
alter table Estabelecimento
   add constraint FK_Estabelecimento_tipo_estabelecimento_TipoEstabelecimento foreign key (TipoEstabelecimento_TipoEstabelecimento_ID)
   references TipoEstabelecimento(TipoEstabelecimento_ID)
   on delete restrict
   on update cascade
;
 
 
alter table Responsavel
   add constraint FK_Responsavel_responsavel_estabelecimento_Estabelecimento foreign key (Estabelecimento_Estabelecimento_ID)
   references Estabelecimento(Estabelecimento_ID)
   on delete restrict
   on update cascade
;
 
 
 
alter table Administrativo
   add constraint FK_Administrativo_User foreign key (User_User_ID)
   references User(User_ID)
   on delete cascade
   on update cascade
;
 
 
 
alter table transporte
   add constraint FK_transporte_tipo_transporte_TipoTransporte foreign key (TipoTransporte_TipoTransporte_ID)
   references TipoTransporte(TipoTransporte_ID)
   on delete restrict
   on update cascade
;
 
 

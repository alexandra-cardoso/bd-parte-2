create database estagios;
use estagios;
CREATE TABLE administrativo (
  utilizador_id integer NOT NULL PRIMARY KEY,
  funcao varchar(150) DEFAULT NULL
);

CREATE TABLE aluno (
  turma_id integer NOT NULL FOREIGN KEY,
  utilizador_id integer NOT NULL PRIMARY KEY,
  numero integer DEFAULT NULL,
  observacoes varchar(150) DEFAULT NULL
);

CREATE TABLE classificacao (
  estabelecimento_empresa_id integer NOT NULL FOREIGN KEY,
  estabelecimento_id integer NOT NULL FOREIGN KEY,
  classificacao_id integer NOT NULL PRIMARY KEY,
  ano_letivo varchar(150) DEFAULT NULL,
  media double NOT NULL
);

CREATE TABLE comercializa (
  estabelecimento_empresa_id integer NOT NULL PRIMARY KEY,
  estabelecimento_id integer NOT NULL PRIMARY KEY,
  produto_id integer NOT NULL PRIMARY KEY FOREIGN KEY --chave primária e foreign
);

CREATE TABLE curso (
  curso_id integer NOT NULL PRIMARY KEY,
  codigo varchar(150) DEFAULT NULL,
  designacao varchar(150) DEFAULT NULL
);

CREATE TABLE disponibilidade (
  empresa_id integer NOT NULL FOREIGN KEY,
  disponibilidade_id integer NOT NULL PRIMARY KEY,
  ano integer DEFAULT NULL,
  num_estagios integer DEFAULT NULL
);

CREATE TABLE empresa (
  responsavel_id integer DEFAULT NULL FOREIGN KEY,
  empresa_id integer NOT NULL PRIMARY KEY,
  num_contribuinte char(9) DEFAULT NULL,
  firma varchar(150) DEFAULT NULL,
  morada_sede varchar(150) DEFAULT NULL,
  localidade varchar(150) DEFAULT NULL,
  codigo_postal char(8) DEFAULT NULL,
  telefone varchar(150) DEFAULT NULL,
  email varchar(150) DEFAULT NULL,
  website varchar(150) DEFAULT NULL,
  tipo_organizacao varchar(150) DEFAULT NULL,
  observacoes varchar(150) DEFAULT NULL
);


CREATE TABLE estabelecimento (
  empresa_id integer NOT NULL PRIMARY KEY,
  responsavel_id integer NOT NULL FOREIGN KEY,
  zona_id integer NOT NULL FOREIGN KEY,
  estabelecimento_id integer NOT NULL PRIMARY KEY,
  nome_comercial varchar(150) DEFAULT NULL,
  morada varchar(150) DEFAULT NULL,
  localidade varchar(150) DEFAULT NULL,
  codigo_postal varchar(150) DEFAULT NULL,
  telefone varchar(150) DEFAULT NULL,
  email varchar(150) DEFAULT NULL,
  foto integer DEFAULT NULL,
  horario_funcionamento varchar(150) DEFAULT NULL,
  data_surgimento date DEFAULT NULL,
  aceitou_estagiarios varchar(150) DEFAULT NULL,
  observacoes varchar(150) DEFAULT NULL
);

CREATE TABLE estagio (
  estabelecimento_empresa_id integer NOT NULL PRIMARY KEY,
  estabelecimento_id integer NOT NULL PRIMARY KEY,
  aluno_id integer NOT NULL PRIMARY KEY FOREIGN KEY,
  formador_id integer NOT NULL FOREIGN KEY,
  data_inicio date DEFAULT NULL,
  data_fim date DEFAULT NULL,
  nota_empresa double DEFAULT NULL,
  nota_escola double NOT NULL,
  nota_relatorio double NOT NULL,
  nota_procura double NOT NULL,
  nota_final double DEFAULT NULL,
  classificacao tinyint(1) DEFAULT NULL
);

CREATE TABLE formador (
  utilizador_id integer NOT NULL PRIMARY KEY,
  num_formador integer DEFAULT NULL,
  disciplina varchar(150) DEFAULT NULL
);

CREATE TABLE produto (
  produto_id integer NOT NULL PRIMARY KEY,
  nome_produto varchar(150) DEFAULT NULL,
  marca varchar(150) DEFAULT NULL
);

CREATE TABLE ramo_atividade (
  ramo_atividade_id integer NOT NULL PRIMARY KEY,
  codigo_cae varchar(150) DEFAULT NULL,
  descricao varchar(150) DEFAULT NULL
);

CREATE TABLE responsavel (
  responsavel_id integer NOT NULL PRIMARY KEY,
  nome varchar(150) DEFAULT NULL,
  titulo varchar(150) DEFAULT NULL,
  cargo varchar(150) DEFAULT NULL,
  telefone_direto varchar(150) DEFAULT NULL,
  telemovel varchar(150) DEFAULT NULL,
  email varchar(150) DEFAULT NULL,
  observacoes varchar(150) DEFAULT NULL
);

CREATE TABLE serve (
  transporte_id integer NOT NULL PRIMARY KEY,
  zona_id integer NOT NULL PRIMARY KEY FOREIGN KEY
);

CREATE TABLE servido (
  estabelecimento_empresa_id integer NOT NULL PRIMARY KEY,
  estabelecimento_id integer NOT NULL PRIMARY KEY,
  transporte_id integer NOT NULL PRIMARY KEY FOREIGN KEY
);

CREATE TABLE trabalha (
  empresa_id integer NOT NULL PRIMARY KEY,
  ramo_atividade_id integer NOT NULL PRIMARY KEY FOREIGN KEY
);

CREATE TABLE transporte (
  transporte_id integer NOT NULL PRIMARY KEY,
  meio_transporte varchar(150) DEFAULT NULL,
  linha varchar(150) DEFAULT NULL,
  observacoes varchar(150) DEFAULT NULL
);

CREATE TABLE turma (
  curso_id integer NOT NULL FOREIGN KEY,
  turma_id integer NOT NULL PRIMARY KEY,
  sigla varchar(150) DEFAULT NULL,
  ano integer DEFAULT NULL
);

CREATE TABLE utilizador (
  utilizador_id integer NOT NULL PRIMARY KEY,
  login varchar(150) DEFAULT NULL,
  password varchar(150) DEFAULT NULL,
  nome varchar(150) DEFAULT NULL,
  tipo enum('aluno','formador','administrativo','') NOT NULL
);

CREATE TABLE zona (
  zona_id integer NOT NULL PRIMARY KEY,
  designacao varchar(150) DEFAULT NULL,
  localidade varchar(150) DEFAULT NULL,
  mapa integer DEFAULT NULL
);

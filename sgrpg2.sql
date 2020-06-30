/*---------------------------*/
/* データベースを新規作成         */
/*---------------------------*/
CREATE DATABASE IF NOT EXISTS sgrpg;
USE sgrpg;

/*---------------------------*/
/* テーブルを作成               */
/*---------------------------*/
-- キャラクター マスター
CREATE TABLE Chara(
    id integer AUTO_INCREMENT,
    name verchar(64),
    PRIMARY KEY(id)
);

-- ユーザーが所持しているキャラクター
CREATE TABLE UserChara(
    id integer AUTO_INCREMENT,
    user_id integer,
    chara_id integer,

    PRIMARY KEY(id)
);
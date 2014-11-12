CREATE TABLE IF NOT EXISTS cds (
  id int(11) NOT NULL AUTO_INCREMENT,
  titel varchar(255) NOT NULL,
  interpret varchar(255) NOT NULL,
  jahr varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

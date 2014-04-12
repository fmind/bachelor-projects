SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `coupe_du_monde` ;
CREATE SCHEMA IF NOT EXISTS `coupe_du_monde` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `coupe_du_monde` ;

-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Pays`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Pays` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Pays` (
  `idPays` INT NOT NULL ,
  `nom` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`idPays`, `nom`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`CoupeDuMonde`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`CoupeDuMonde` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`CoupeDuMonde` (
  `idCoupeDuMonde` INT NOT NULL ,
  `annee` YEAR NOT NULL ,
  `pays` INT NOT NULL ,
  PRIMARY KEY (`idCoupeDuMonde`) ,
  CONSTRAINT `pays_CoupeDuMonde_fk`
    FOREIGN KEY (`pays` )
    REFERENCES `coupe_du_monde`.`Pays` (`idPays` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Élimination`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Élimination` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Élimination` (
  `idPhaseElimination` INT NOT NULL ,
  `nom` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`idPhaseElimination`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`PhaseElimination`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`PhaseElimination` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`PhaseElimination` (
  `idPhaseElimination` INT NOT NULL AUTO_INCREMENT ,
  `coupe` INT NOT NULL ,
  `epreuve` INT NOT NULL ,
  PRIMARY KEY (`idPhaseElimination`) ,
  CONSTRAINT `coupe_PhaseElimination_fk`
    FOREIGN KEY (`coupe` )
    REFERENCES `coupe_du_monde`.`CoupeDuMonde` (`idCoupeDuMonde` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `epreuve_PhaseElimination_fk`
    FOREIGN KEY (`epreuve` )
    REFERENCES `coupe_du_monde`.`Élimination` (`idPhaseElimination` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Poule`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Poule` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Poule` (
  `idPoule` INT NOT NULL ,
  `lettre` CHAR NOT NULL ,
  PRIMARY KEY (`idPoule`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`TourPoule`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`TourPoule` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`TourPoule` (
  `idTourPoule` INT NOT NULL AUTO_INCREMENT ,
  `coupe` INT NOT NULL ,
  `poule` INT NOT NULL ,
  PRIMARY KEY (`idTourPoule`) ,
  CONSTRAINT `poule_TourPoule_fk`
    FOREIGN KEY (`poule` )
    REFERENCES `coupe_du_monde`.`Poule` (`idPoule` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `coupe_TourPoule_fk`
    FOREIGN KEY (`coupe` )
    REFERENCES `coupe_du_monde`.`CoupeDuMonde` (`idCoupeDuMonde` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Ville`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Ville` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Ville` (
  `idVille` INT NOT NULL ,
  `nom` VARCHAR(255) NOT NULL ,
  `pays` INT NOT NULL ,
  PRIMARY KEY (`idVille`) ,
  CONSTRAINT `nom_Ville_fk`
    FOREIGN KEY (`pays` )
    REFERENCES `coupe_du_monde`.`Pays` (`idPays` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Stade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Stade` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Stade` (
  `idStade` INT NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(255) NOT NULL ,
  `capacite` INT NOT NULL ,
  `ville` INT NOT NULL ,
  PRIMARY KEY (`idStade`) ,
  CONSTRAINT `ville_Stade_fk`
    FOREIGN KEY (`ville` )
    REFERENCES `coupe_du_monde`.`Ville` (`idVille` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Match`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Match` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Match` (
  `idMatch` INT NOT NULL AUTO_INCREMENT ,
  `heure_debut` DATETIME NOT NULL ,
  `heure_fin` DATETIME NULL ,
  `nombre_spectateur` INT NOT NULL ,
  `epreuve` INT NULL ,
  `poule` INT NULL ,
  `stade` INT NOT NULL ,
  PRIMARY KEY (`idMatch`) ,
  CONSTRAINT `epreuve_Match_fk`
    FOREIGN KEY (`epreuve` )
    REFERENCES `coupe_du_monde`.`PhaseElimination` (`idPhaseElimination` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `poule_Match_fk`
    FOREIGN KEY (`poule` )
    REFERENCES `coupe_du_monde`.`TourPoule` (`idTourPoule` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `stade_Match_fk`
    FOREIGN KEY (`stade` )
    REFERENCES `coupe_du_monde`.`Stade` (`idStade` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Arbitre`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Arbitre` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Arbitre` (
  `idArbitre` INT NOT NULL ,
  `numero` INT NOT NULL ,
  `nom` VARCHAR(100) NOT NULL ,
  `prenom` VARCHAR(100) NOT NULL ,
  `pays` INT NOT NULL ,
  PRIMARY KEY (`idArbitre`) ,
  CONSTRAINT `pays_Arbitre_fk`
    FOREIGN KEY (`pays` )
    REFERENCES `coupe_du_monde`.`Pays` (`idPays` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Suit`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Suit` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Suit` (
  `idSuit` INT NOT NULL AUTO_INCREMENT ,
  `role` VARCHAR(100) NOT NULL ,
  `match` INT NOT NULL ,
  `arbitre` INT NOT NULL ,
  PRIMARY KEY (`idSuit`) ,
  CONSTRAINT `arbitre_Suit_fk`
    FOREIGN KEY (`arbitre` )
    REFERENCES `coupe_du_monde`.`Arbitre` (`idArbitre` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `match_Suit_fk`
    FOREIGN KEY (`match` )
    REFERENCES `coupe_du_monde`.`Match` (`idMatch` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Équipe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Équipe` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Équipe` (
  `idEquipe` INT NOT NULL ,
  `code` INT NOT NULL ,
  `maillot` VARCHAR(100) NOT NULL ,
  `entraineur` VARCHAR(255) NOT NULL ,
  `logo` BLOB NOT NULL ,
  PRIMARY KEY (`idEquipe`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Poste`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Poste` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Poste` (
  `idPoste` INT NOT NULL ,
  `libelle` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`idPoste`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Joueur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Joueur` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Joueur` (
  `idJoueur` INT NOT NULL ,
  `numero` INT NOT NULL ,
  `nom` VARCHAR(100) NOT NULL ,
  `prenom` VARCHAR(100) NOT NULL ,
  `date_de_naissance` DATE NOT NULL ,
  `lieu_de_naissance` VARCHAR(100) NOT NULL ,
  `poids` INT NOT NULL ,
  `taille` INT NOT NULL ,
  `photo` BLOB NOT NULL ,
  `numero_poste` INT NOT NULL ,
  `equipe` INT NOT NULL ,
  `poste` INT NOT NULL ,
  PRIMARY KEY (`idJoueur`) ,
  CONSTRAINT `poste_Joueur_fk`
    FOREIGN KEY (`poste` )
    REFERENCES `coupe_du_monde`.`Poste` (`idPoste` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `equipe_Joueur_fk`
    FOREIGN KEY (`equipe` )
    REFERENCES `coupe_du_monde`.`Équipe` (`idEquipe` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Couleur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Couleur` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Couleur` (
  `idCouleur` INT NOT NULL ,
  `couleur` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`idCouleur`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Participation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Participation` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Participation` (
  `idParticipation` INT NOT NULL AUTO_INCREMENT ,
  `titulaire` TINYINT(1) NOT NULL ,
  `heure_debut` DATETIME NOT NULL ,
  `heure_fin` DATETIME NULL ,
  `joueur` INT NOT NULL ,
  `match` INT NOT NULL ,
  PRIMARY KEY (`idParticipation`) ,
  CONSTRAINT `joueur_Participation_fk`
    FOREIGN KEY (`joueur` )
    REFERENCES `coupe_du_monde`.`Joueur` (`idJoueur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `match_Participation_fk`
    FOREIGN KEY (`match` )
    REFERENCES `coupe_du_monde`.`Match` (`idMatch` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Carton`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Carton` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Carton` (
  `idCarton` INT NOT NULL AUTO_INCREMENT ,
  `couleur` INT NOT NULL ,
  `participation` INT NOT NULL ,
  PRIMARY KEY (`idCarton`) ,
  CONSTRAINT `couleur_Carton_fk`
    FOREIGN KEY (`couleur` )
    REFERENCES `coupe_du_monde`.`Couleur` (`idCouleur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `participation_Carton_fk`
    FOREIGN KEY (`participation` )
    REFERENCES `coupe_du_monde`.`Participation` (`idParticipation` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Action`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Action` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Action` (
  `idAction` INT NOT NULL ,
  `nom` VARCHAR(100) NOT NULL ,
  `points` INT NOT NULL ,
  PRIMARY KEY (`idAction`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`PointMarque`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`PointMarque` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`PointMarque` (
  `idPointMarque` INT NOT NULL AUTO_INCREMENT ,
  `action` INT NOT NULL ,
  `participation` INT NOT NULL ,
  PRIMARY KEY (`idPointMarque`) ,
  CONSTRAINT `action_PointMarque_fk`
    FOREIGN KEY (`action` )
    REFERENCES `coupe_du_monde`.`Action` (`idAction` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `participation_PointMarque_fk`
    FOREIGN KEY (`participation` )
    REFERENCES `coupe_du_monde`.`Participation` (`idParticipation` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `coupe_du_monde`.`Oppose`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `coupe_du_monde`.`Oppose` ;

CREATE  TABLE IF NOT EXISTS `coupe_du_monde`.`Oppose` (
  `idOppose` INT NOT NULL AUTO_INCREMENT ,
  `receveur` TINYINT(1) NOT NULL ,
  `score` INT NULL ,
  `equipe` INT NOT NULL ,
  `match` INT NOT NULL ,
  PRIMARY KEY (`idOppose`) ,
  CONSTRAINT `equipe_Oppose_fk`
    FOREIGN KEY (`equipe` )
    REFERENCES `coupe_du_monde`.`Équipe` (`idEquipe` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `match_Oppose_fk`
    FOREIGN KEY (`match` )
    REFERENCES `coupe_du_monde`.`Match` (`idMatch` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

<?php
namespace Services;

/**
 * Created by PhpStorm.
 * User: ralphy
 * Date: 15/05/17
 * Time: 12:43
 */

class SQLite3Service
{
    /**
     * ressource de connexion à la base de données
     *
     * @var \SQLite3
     */
    protected $oCnx;
    /**
     * configuration de la base de données
     * @param $aConf {array} contient les paramètre de connexion
     * actuellement seule la clé "file" est nécessaire pour sqlite3
     * @return SQLite3Service
     */
    public function config(Array $aConf) {
        $this->oCnx = new \SQLite3 ( $aConf ['file'] );
        return $this;
    }

    /**
     * Envoie d'une requête SQL
     * @param string $sQuery requête
     * @param array $aBindings paramètres de la requête
     * @return \SQLite3Result|array succès ou résultat de l'opération
     */
    public function query($sQuery, $aBindings = array()) {
        if (is_array($sQuery)) {
            return array_map(function($q) use ($aBindings) {
                return $this->query($q, $aBindings);
            }, $sQuery);
        }
        $oStatement = $this->oCnx->prepare($sQuery);
        foreach ($aBindings as $var => $val) {
            if (substr($var, 0, 1) !== ':') {
                $var = ':' . $var;
            }
            $oStatement->bindValue($var, $val);
        }
        $oResult = $oStatement->execute();
        if (preg_match ( '/^\\s*select/i', $sQuery )) {
            $aData = array ();
            while ( $aLine = $oResult->fetchArray ( SQLITE3_ASSOC ) ) {
                $aData [] = $aLine;
            }
            $oResult->finalize ();
            return $aData;
        } else {
            return $oResult;
        }
    }

    /**
     * Renvoie le dernier identifiant auto incremental généré par un INSERT
     * @return integer
     */
    public function getLastInsertId() {
        return $this->oCnx->lastInsertRowID ();
    }
}
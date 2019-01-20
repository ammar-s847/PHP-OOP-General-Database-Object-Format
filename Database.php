<?php
    class Database {
        protected $DBname, $DBpass, $DBuser, $DBhost, $DBoptions, $Object, $DSN;
        public $PDO, $MYSQLI;

        public function __construct($DBname, $DBuser, $DBpass, $DBhost, $Object, $DBoptions = null, $DBchar = null) {
            if (empty($DBname) || empty($DBuser) || empty($DBpass) || empty($DBhost) || empty($Object)) {
                return 'empty';
                $this->$PDO = null;
                $this->$MYSQLI = null;
            } else {
                if (!empty($DBchar) || $DBchar != null) {
                    $this->$DBchar = $DBchar;
                } else {
                    $this->$DBchar = null;
                }
                if (!empty($DBoptions) || $DBoptions != null) {
                    $this->$DBoptions = $DBoptions;
                } else {
                    $this->$DBoptions = null;
                }
                if ($Object == 'pdo') {
                    $this->$MYSQLI = null;
                    if ($this->$DBchar) {
                        $DSN = "mysql:host=$DBhost;DBname=$DBname;charset=$DBchar";
                    } else {
                        $DSN = "mysql:host=$DBhost;DBname=$DBname";
                    }
                    try {
                        if ($this->$DBoptions) {
                            $this->$PDO = new PDO($this->$DSN, $this->$DBuser, $this->$DBpass, $this->$DBoptions);
                        } else {
                            $this->$PDO = new PDO($this->$DSN, $this->$DBuser, $this->$DBpass);
                        }
                    } catch (PDOException $e) {
                        return 'PDO';
                        $this->$PDO = null;
                    }
                } else if ($Object == 'mysqli') {
                    $this->$PDO = null;
                    $this->$MYSQLI = new mysqli($this->$DBhost, $this->$DBuser, $this->$DBpass, $this->$DBname);
                    if ($this->$MYSQLI->connect_errno) {
                        $this->$MYSQLI = null;
                    }
                }
            }
        }

        public function status() {
            if (isset($this->$PDO)) {
                return '[DB status] PDO is connected';
            } else if (isset($this->$MYSQLI)) {
                return '[DB status] MYSQLI is connected';
            } else {
                return '[DB status] no connections';
            }
        }

        public function PDO() {
            if ($this->$PDO) {
                return $this->$PDO;
            } else {
                return null;
            }
        }

        public function MYSQLI() {
            if ($this->$MYSQLI) {
                return $this->$MYSQLI;
            } else {
                return null;
            }
        }
    }
?>
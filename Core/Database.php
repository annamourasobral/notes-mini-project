<?php
class Database {
    public $connection;
    public $statement;

    public function __construct($config, $username='root', $password='Alms2803') {
        $dsn='mysql:' . http_build_query($config, '', ';');
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE  => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query,$params=[]) {
        $this->statement = $this->connection-> prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function get() {
        return $this->statement->fetchAll();
    }


    //though the following function, fetch will no longer be a PDO statement object, but a personalized function.
    public function find() {
        return $this->statement->fetch();
    }

    public function findOrFail() {
        $result = $this-> find();
        if (! $result) {
            abort();
        }

        return $result;
    }
}
<?php
 
 
class Booking
{
 
    private $dbh;
    private $bookingsTableName = 'bookings';

    private$server = 'localhost:8889';
    private $username = 'root';
    private $password = 'root';
    private $database = 'tarea';


    public function __construct($database, $hoserverst, $username, $password)
    {
        try {
 
            $this->dbh =
                new PDO("mysql:host=$server;dbname=$database",
                    $username,
                    $password
                );
 
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
 
    public function index()
    {
        $statement = $this->dbh->query('SELECT * FROM ' . $this->bookingsTableName);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
 
    public function add(DateTimeImmutable $bookingDate)
    {
        $statement = $this->dbh->prepare(
            'INSERT INTO ' . $this->bookingsTableName . ' (booking_date) VALUES (:bookingDate)'
        );
 
        if (false === $statement) {
            throw new Exception('Invalid prepare statement');
        }
 
        if (false === $statement->execute([
                ':bookingDate' => $bookingDate->format('Y-m-d'),
            ])) {
            throw new Exception(implode(' ', $statement->errorInfo()));
        }
    }
 
    public function delete($id)
    {
        $statement = $this->dbh->prepare(
            'DELETE from ' . $this->bookingsTableName . ' WHERE id = :id'
        );
        if (false === $statement) {
            throw new Exception('Invalid prepare statement');
        }
        if (false === $statement->execute([':id' => $id])) {
            throw new Exception(implode(' ', $statement->errorInfo()));
        }
    }
 
}
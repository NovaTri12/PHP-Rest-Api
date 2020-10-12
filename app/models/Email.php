<?php
//  Database Stuff
 class Email
 {
     private $conn;
     private $table = 'email_history';


    //Email Property
    public $uuid;
    public $sender;
    public $recipient;
    public $body;

    //Constructor
    public function __construct($db)
    {
        $this->conn = $db;
        
    }

    // function get query 
    public function read()
    {
        //Create Query
        $query = 'SELECT * FROM '.$this->table.' email';

        //Prepare Statement
        $statement = $this->conn->prepare($query);
        

        // Execute Query 
        $statement->execute();

        return $statement;
    }

    // Create api for data after send email

    public function create()
    {
        $query = 'INSERT INTO ' .
                $this->table .'
                (uuid, sender, recipient, body)
                values (:uuid, :sender, :recipient, :body);
                ';

        // Prepare Statement 
        $statement = $this->conn->prepare($query);

        // Clean Data 
        $this->uuid = htmlspecialchars(strip_tags($this->uuid));
        $this->sender = htmlspecialchars(strip_tags($this->sender));
        $this->recipient = htmlspecialchars(strip_tags($this->recipient));
        $this->body = htmlspecialchars(strip_tags($this->body));

        //Bind Data
        $statement->bindParam(':uuid', $this->uuid);
        $statement->bindParam(':sender', $this->sender);
        $statement->bindParam(':recipient', $this->recipient);
        $statement->bindParam(':body', $this->body);

        if ($statement->execute()) {
            return true;
        }

        // Print error 
        printf("Error: %s. \n", $statement->error);

        return false;
    }
 }
 
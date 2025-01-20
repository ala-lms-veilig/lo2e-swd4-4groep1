<?php

class EnqueteCRUD {
    private $db;
    private $jsonFile = 'survey_questions.json';

    public function __construct() {
      
        $this->db = new mysqli("localhost", "root", "", "enquete_database");

        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    public function getQuestionsFromDB() {
        $sql = "SELECT * FROM survey_questions";
        $result = $this->db->query($sql);

        $questions = [];
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }

        return $questions;
    }

    public function updateJsonFile() {
        
        $questions = $this->getQuestionsFromDB();

        
        $jsonData = json_encode($questions, JSON_PRETTY_PRINT);

        file_put_contents($this->jsonFile, $jsonData);
    }

   
    public function getQuestionsFromJson() {
        if (file_exists($this->jsonFile)) {
            $jsonData = file_get_contents($this->jsonFile);
            return json_decode($jsonData, true);
        }
        return [];
    }

    
    public function addQuestion($vraag, $type, $opties) {
        $sql = "INSERT INTO survey_questions (vraag, type, opties) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $vraag, $type, $opties);
        $stmt->execute();

        $this->updateJsonFile();
    }

    
    public function delete($id) {
        $sql = "DELETE FROM survey_questions WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $this->updateJsonFile();
    }
}

?>

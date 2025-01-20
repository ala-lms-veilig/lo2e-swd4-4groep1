<?php

class EnqueteCRUD {
    private $db;
    private $jsonFile = 'survey_questions.json'; // Path to the JSON file

    public function __construct() {
        // Database connection (adjust credentials as needed)
        $this->db = new mysqli("localhost", "root", "", "enquete_database");

        if ($this->db->connect_error) {
            die("Database connection failed: " . $this->db->connect_error);
        }
    }

    // Fetch questions from the database
    public function getQuestionsFromDB() {
        $sql = "SELECT * FROM survey_questions";
        $result = $this->db->query($sql);

        $questions = [];
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }

        return $questions;
    }

    // Update the JSON file with the latest data from the database
    public function updateJsonFile() {
        // Fetch all questions from the database
        $questions = $this->getQuestionsFromDB();

        // Convert the array of questions to JSON format
        $jsonData = json_encode($questions, JSON_PRETTY_PRINT);

        // Save the JSON data to a file
        file_put_contents($this->jsonFile, $jsonData);
    }

    // Convert JSON data to an array of questions
    public function getQuestionsFromJson() {
        if (file_exists($this->jsonFile)) {
            $jsonData = file_get_contents($this->jsonFile);
            return json_decode($jsonData, true);
        }
        return [];
    }

    // Add a new question to the database
    public function addQuestion($vraag, $type, $opties) {
        $sql = "INSERT INTO survey_questions (vraag, type, opties) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $vraag, $type, $opties);
        $stmt->execute();

        // After adding the question, update the JSON file
        $this->updateJsonFile();
    }

    // Delete a question by ID
    public function delete($id) {
        $sql = "DELETE FROM survey_questions WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // After deleting the question, update the JSON file
        $this->updateJsonFile();
    }
}

?>

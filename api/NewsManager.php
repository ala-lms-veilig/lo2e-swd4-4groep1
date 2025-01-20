<?php

require_once "BaseManager.php";

class NewsManager extends BaseManager 
{
    protected function setTable() 
    {
        $this->table = 'news'; 
    }
    
    public function newsCreate($title, $content, $imageUrl)
    {
    
        $this->setTable();
        $sql = "INSERT INTO $this->table (title, content, image_path) VALUES (:title, :content, :image_path)";

        try 
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':image_path', $imageUrl);
            $stmt->execute();

            $this->updateJsonFile();
            return ['status' => 'success', 'message' => 'News created successfully.'];
        } 
        catch (PDOException $e) 
        {
            return ['status' => 'error', 'message' => 'Failed to create news: ' . $e->getMessage()];
        }
    }

    public function newsUpdate($id, $title, $content, $imageUrl)
    {
    
        $this->setTable();
        $sql = "UPDATE $this->table SET title = :title, content = :content, image_path = :image_path WHERE id = :id";

        try 
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':image_path', $imageUrl);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->updateJsonFile();
            return ['status' => 'success', 'message' => 'News updated successfully.'];
        } 
        catch (PDOException $e) 
        {
            return ['status' => 'error', 'message' => 'Failed to update news: ' . $e->getMessage()];
        }
    }
}

?>

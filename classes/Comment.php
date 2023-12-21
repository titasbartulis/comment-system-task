<?php

class Comment
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function addComment($parentCommentId, $comment, $commentSenderName, $commentSenderEmail)
    {
        try {
            $sql = "INSERT INTO tbl_comment (parent_comment_id, comment, comment_sender_name, comment_sender_email) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$parentCommentId, $comment, $commentSenderName, $commentSenderEmail]);
            return true;
        } catch (Exception $e) {
            throw new Exception('Error adding comment: ' . $e->getMessage());
        }
    }

    public function fetchComments($parentId = 0)
    {
        try {
            $sql = "SELECT * FROM tbl_comment WHERE parent_comment_id = ? ORDER BY comment_id DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$parentId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception('Error fetching comments: ' . $e->getMessage());
        }
    }
}

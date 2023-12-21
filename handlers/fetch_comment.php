<?php

require '../autoloader.php';

$database = new Database();
$dbConnection = $database->connect();
$comment = new Comment($dbConnection);

$output = '';

function getReplyComment($comment, $parentId = 0, $marginLeft = 0)
{
    $result = $comment->fetchComments($parentId);
    $output = '';
    foreach ($result as $row) {
        $output .= '
      <div class="card my-3" style="margin-left:' . $marginLeft . 'px">
        <div class="card-header">By <b>' . htmlspecialchars($row["comment_sender_name"]) . '</b> on <i>' . $row["date"] . '</i></div>
        <div class="card-body">' . htmlspecialchars($row["comment"]) . '</div>';

        if ($parentId == 0) {
            $output .= '<div class="card-footer text-end">
                    <button type="button" class="btn btn-secondary reply" data-comment-id="' . $row["comment_id"] . '">Reply</button>
                  </div>';
        }

        $output .= '</div>';

        if ($parentId == 0) { // Fetch and display second-level comments (replies) if any
            $output .= getReplyComment($comment, $row["comment_id"], $marginLeft + 30);
        }
    }
    return $output;
}

echo getReplyComment($comment);

<?php

require '../autoloader.php';

$database = new Database();
$dbConnection = $database->connect();
$comment = new Comment($dbConnection);

$error = '';
$commentName = '';
$commentEmail = '';
$commentContent = '';

// Validate name input
if (empty($_POST["comment_name"])) {
    $error .= '<p class="text-danger">Name is required</p>';
} else {
    $commentName = $_POST["comment_name"];
}

// Validate email input
if (empty($_POST["comment_email"])) {
    $error .= '<p class="text-danger">Email is required</p>';
} elseif (!filter_var($_POST["comment_email"], FILTER_VALIDATE_EMAIL)) {
    $error .= '<p class="text-danger">Invalid email format</p>';
} else {
    $commentEmail = $_POST["comment_email"];
}

// Validate content input
if (empty($_POST["comment_content"])) {
    $error .= '<p class="text-danger">Comment is required</p>';
} else {
    $commentContent = $_POST["comment_content"];
}

if ($error == '') {
    if ($comment->addComment($_POST["comment_id"], $commentContent, $commentName, $commentEmail)) {
        $error = '<label class="text-success">Comment Added</label>';
    } else {
        $error = '<label class="text-danger">Failed to add comment</label>';
    }
}

$data = array(
  'error' => $error
);

echo json_encode($data);

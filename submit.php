<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $author = strip_tags($_POST['author']);
    $message = strip_tags($_POST['message']);
    
    $newPost = ['author' => $author, 'message' => $message, 'timestamp' => time()];
    
    $currentData = json_decode(file_get_contents('posts.json'), true);
    $currentData[] = $newPost;
    
    file_put_contents('posts.json', json_encode($currentData, JSON_PRETTY_PRINT));
    
    header('Location: index.php');
    exit;
}
?>

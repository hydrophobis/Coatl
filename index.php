<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Social Media</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1>Mini Social Media</h1>
</header>

<main>
    <section>
        <h2>Create Post</h2>
        <form action="submit.php" method="post">
            <label for="author">Name:</label><br>
            <input type="text" id="author" name="author" required><br><br>
            
            <label for="message">Post:</label><br>
            <textarea id="message" name="message" rows="4" required></textarea><br><br>
            
            <input type="submit" value="Post">
        </form>
    </section>
    
    <section>
        <h2>Recent Posts</h2>
        <?php
        $posts = json_decode(file_get_contents('posts.json'), true);
        if (!empty($posts)) {
            foreach (array_reverse($posts) as $post) {
                echo "<div class='post'>";
                echo "<h3>".htmlspecialchars($post['author'])."</h3>";
                echo "<p>".nl2br(htmlspecialchars($post['message']))."</p>";

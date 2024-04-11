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
                echo "</div>";
            }
        } else {
            echo "<p>No posts yet.</p>";
        }
        ?>
    </section>
</main>
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyAu5eH-8OEAunh1jjIzoqd9-CDtHULMqyY",
    authDomain: "coatl-cc1f4.firebaseapp.com",
    projectId: "coatl-cc1f4",
    storageBucket: "coatl-cc1f4.appspot.com",
    messagingSenderId: "290464623435",
    appId: "1:290464623435:web:c5808d95e1b45593ae96ce",
    measurementId: "G-K94X7NB3P5"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Mini Social Media</p>
</footer>
</body>
</html>

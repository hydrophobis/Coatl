<?php
// GitHub repository details
$username = 'yourusername';
$repository = 'yourrepository';
$token = 'your_personal_access_token';

// Form data
$title = $_POST['title'];
$author = $_POST['author'];
$content = $_POST['content'];

// Existing write-ups JSON file URL
$fileUrl = "https://raw.githubusercontent.com/$username/$repository/main/writeups.json";

// Fetch existing write-ups JSON
$existingWriteups = json_decode(file_get_contents($fileUrl), true);

// Add new write-up
$newWriteup = array('title' => $title, 'author' => $author, 'content' => $content);
$existingWriteups[] = $newWriteup;

// Encode updated write-ups array to JSON
$updatedWriteupsJson = json_encode($existingWriteups, JSON_PRETTY_PRINT);

// Prepare data for GitHub API
$data = array(
    'message' => 'Add new write-up',
    'content' => base64_encode($updatedWriteupsJson),
    'sha' => file_exists('writeups.json') ? sha1_file('writeups.json') : null
);

// Send request to GitHub API to update write-ups JSON file
$url = "https://api.github.com/repos/$username/$repository/contents/writeups.json";
$options = array(
    'http' => array(
        'header' => "Content-type: application/json\r\n",
        'method' => 'PUT',
        'content' => json_encode($data),
        'header' => "Authorization: token $token\r\n" . "User-Agent: php\r\n",
    ),
);
$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result) {
    echo "Write-up submitted successfully!";
} else {
    echo "Error submitting write-up.";
}
?>

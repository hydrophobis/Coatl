const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');
const path = require('path');

const app = express();
const PORT = 8000;

app.use(bodyParser.json());
app.use(express.static('public')); // Serve static files from 'public' directory

// Route to handle POST requests
app.post('/post', (req, res) => {
    const data = req.body;
    const filePath = path.join(__dirname, 'post/posts.json');

    // Read the existing posts
    fs.readFile(filePath, (err, content) => {
        if (err) {
            console.error('Error reading posts:', err);
            res.status(500).send('Error reading posts');
            return;
        }

        try {
            const posts = JSON.parse(content);
            posts.push({
                postId: Math.random().toString(36).substr(2, 9), // Random ID
                author: data.author,
                message: data.message
            });

            // Write updated posts back to file
            fs.writeFile(filePath, JSON.stringify(posts, null, 2), err => {
                if (err) {
                    console.error('Error saving post:', err);
                    res.status(500).send('Error saving post');
                    return;
                }
                res.status(200).send('Post saved');
            });
        } catch (parseError) {
            console.error('Error parsing JSON:', parseError);
            res.status(500).send('Error parsing JSON');
        }
    });
});

app.get('/post', (req, res) => {
    const filePath = path.join(__dirname, 'post/posts.json');
    fs.readFile(filePath, (err, content) => {
        if (err) {
            console.error('Error reading posts:', err);
            res.status(500).send('Error reading posts');
            return;
        }
        try {
            const posts = JSON.parse(content);
            res.json(posts);
        } catch (parseError) {
            console.error('Error parsing JSON:', parseError);
            res.status(500).send('Error parsing JSON');
        }
    });
});

app.listen(PORT, () => {
    console.log(`Server running on http://localhost:${PORT}`);
});

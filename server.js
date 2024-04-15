const express = require('express');
const bodyParser = require('body-parser');
const fs = require('fs');
const path = require('path');
const cors = require('cors');

const app = express();
const PORT = 8000;

app.use(bodyParser.json());
app.use(express.static('public')); // Serve static files from 'public' directory
app.use(cors());

// Allow requests only from a specific origin
app.use(cors({
    origin: 'https://curly-space-orbit-r4gw4v9vrv5g3pg77.github.dev/'
}));


//app.listen(PORT () => {
//    console.log(`Server is running on port ${PORT}`);
//});

// Route to handle POST requests
app.post('/post/:postId/comment', (req, res) => {
    const postId = req.params.postId;
    const commentData = req.body;

    // Read the existing posts
    fs.readFile(postsFilePath, (err, content) => {
        if (err) {
            console.error('Error reading posts:', err);
            res.status(500).send('Error reading posts');
            return;
        }

        try {
            let posts = JSON.parse(content);

            // Find the post with the specified postId
            const postIndex = posts.findIndex(post => post.postId === postId);

            if (postIndex === -1) {
                res.status(404).send('Post not found');
                return;
            }

            // Add the comment to the post's comments array
            if (!posts[postIndex].comments) {
                posts[postIndex].comments = [];
            }
            posts[postIndex].comments.push(commentData);

            // Write updated posts back to file
            fs.writeFile(postsFilePath, JSON.stringify(posts, null, 2), err => {
                if (err) {
                    console.error('Error saving posts:', err);
                    res.status(500).send('Error saving posts');
                    return;
                }
                res.status(200).json(posts[postIndex]);
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

<?php

// // Function to fetch posts from JSONPlaceholder API
// function fetchPosts() {
//     // API endpoint
//     $url = "https://jsonplaceholder.typicode.com/posts";

//     // Initialize cURL
//     $ch = curl_init();

//     // Set cURL options
//     curl_setopt($ch, CURLOPT_URL, $url); // API endpoint
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as a string

//     // Execute cURL request and get the response
//     $response = curl_exec($ch);

//     // Check for errors
//     if (curl_errno($ch)) {
//         echo "cURL Error: " . curl_error($ch);
//         curl_close($ch);
//         return null;
//     }

//     // Close cURL session
//     curl_close($ch);

//     // Decode JSON response into an associative array
//     return json_decode($response, true);
// }

// // Main execution flow
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     header('Content-Type: application/json'); // Set response type as JSON
//     $posts = fetchPosts();

//     if ($posts) {
//         echo json_encode([
//             'status' => 'success',
//             'data' => $posts
//         ]);
//     } else {
//         echo json_encode([
//             'status' => 'error',
//             'message' => 'Failed to fetch posts'
//         ]);
//     }
// } 
// else {
//     // Handle unsupported HTTP methods
//     header('Content-Type: application/json');
//     echo json_encode([
//         'status' => 'error',
//         'message' => 'Invalid request method'
//     ]);
// }












// new

// api.php


// Main execution flow
header('Content-Type: application/json');

// print_r($_SERVER);
// exit;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $posts = fetchPosts();
    echo json_encode([
        'status' => 'success',
        'data' => $posts
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true); // Read POST body
    $newPost = createPost($inputData);
    echo json_encode([
        'status' => $newPost ? 'success' : 'error',
        'data' => $newPost
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    // echo 'Hello';
    // exit;

    $inputData = json_decode(file_get_contents('php://input'), true); // Read PUT body
    // print_r($inputData);
    // exit;
    $id = $_GET['id'] ?? null; // Expect `id` in query parameters

    // print_r($inputData);
    // exit;
    if ($id) {
        // print_r($id);
        // print_r($inputData);
        
        // exit;

        $updatedPost = updatePost($id, $inputData);
        echo json_encode([
            'status' => $updatedPost ? 'success' : 'error',
            'data' => $updatedPost
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing ID for update'
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'] ?? null; // Expect `id` in query parameters
    if ($id) {
        $deletedPost = deletePost($id);
        echo json_encode([
            'status' => $deletedPost ? 'success' : 'error',
            'data' => $deletedPost
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing ID for deletion'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}


function fetchPosts() {


    // echo("Hello");
    // exit;
    $url = "https://jsonplaceholder.typicode.com/posts";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return null;
    }
    curl_close($ch);
    return json_decode($response, true);
}

// Function to create a post
function createPost($data) {

    // echo("Hello");
    // exit;
    $url = "https://jsonplaceholder.typicode.com/posts";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true); // Set HTTP method to POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Add POST data
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); // Set content type
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return null;
    }
    curl_close($ch);
    return json_decode($response, true);
}

// Function to update a post
function updatePost($id, $data) {

    echo 'Hello';
    exit;

    $url = "https://jsonplaceholder.typicode.com/posts/$id";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Set HTTP method to PUT
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return null;
    }
    curl_close($ch);
    return json_decode($response, true);
}

// Function to delete a post
function deletePost($id) {
    $url = "https://jsonplaceholder.typicode.com/posts/$id";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Set HTTP method to DELETE
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        curl_close($ch);
        return null;
    }
    curl_close($ch);
    return json_decode($response, true);
}

// Main execution flow
header('Content-Type: application/json');

// print_r($_SERVER['REQUEST_METHOD']);
// exit;


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $posts = fetchPosts();
    echo json_encode([
        'status' => 'success',
        'data' => $posts
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true); // Read POST body
    $newPost = createPost($inputData);
    echo json_encode([
        'status' => $newPost ? 'success' : 'error',
        'data' => $newPost
    ]);
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {

    echo 'Hello';
    exit;

    $inputData = json_decode(file_get_contents('php://input'), true); // Read PUT body
    // print_r($inputData);
    // exit;
    $id = $_GET['id'] ?? null; // Expect `id` in query parameters

    // print_r($inputData);
    // exit;
    if ($id) {
        // print_r($id);
        // print_r($inputData);
        
        exit;

        $updatedPost = updatePost($id, $inputData);
        echo json_encode([
            'status' => $updatedPost ? 'success' : 'error',
            'data' => $updatedPost
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing ID for update'
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'] ?? null; // Expect `id` in query parameters
    if ($id) {
        $deletedPost = deletePost($id);
        echo json_encode([
            'status' => $deletedPost ? 'success' : 'error',
            'data' => $deletedPost
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing ID for deletion'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}



?>

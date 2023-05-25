<?php
$heading = 'Create note';

$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (strlen($_POST['body']) === 0) {
        $errors['body'] = 'A body is required.';
    }

    if (strlen($_POST['body']) === 1000) {
        $errors['body'] = 'The body can not be more than 1,000 characters.';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);
    }
}

view("notes/create.view.php", [
    'heading' => 'Create a note',
    'errors' => $errors
]);
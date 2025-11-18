<?php
$errors = [];
$name = '';
$phone = '';
$email = '';
$editingIndex = null;

if (isset($_GET['edit'])) {
    $requestedIndex = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
    if ($requestedIndex !== false && isset($_SESSION['contacts'][$requestedIndex])) {
        $editingIndex = $requestedIndex;
        $contact = $_SESSION['contacts'][$requestedIndex];
        $name = $contact['name'];
        $phone = $contact['phone'];
        $email = $contact['email'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'save';

    if ($action === 'delete') {
        $deleteIndex = filter_input(INPUT_POST, 'index', FILTER_VALIDATE_INT);
        if ($deleteIndex !== false && isset($_SESSION['contacts'][$deleteIndex])) {
            array_splice($_SESSION['contacts'], $deleteIndex, 1);
        }
        header('Location: index.php');
        exit;
    }

    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $editingIndex = isset($_POST['editing_index']) ? (int) $_POST['editing_index'] : null;

    if ($name === '') {
        $errors['name'] = 'Nama wajib diisi.';
    }

    if ($phone === '') {
        $errors['phone'] = 'Telepon wajib diisi.';
    } elseif (strlen(preg_replace('/\D+/', '', $phone)) < 6) {
        $errors['phone'] = 'Minimal 6 angka.';
    }

    if ($email === '') {
        $errors['email'] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email tidak valid.';
    }

    if (!$errors) {
        $contactData = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
        ];

        if ($editingIndex !== null && isset($_SESSION['contacts'][$editingIndex])) {
            $_SESSION['contacts'][$editingIndex] = $contactData;
        } else {
            $_SESSION['contacts'][] = $contactData;
        }

        header('Location: index.php');
        exit;
    }
}

$contacts = $_SESSION['contacts'];


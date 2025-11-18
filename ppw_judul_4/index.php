<?php
require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/handlers/contact_handler.php';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Manajemen Kontak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="h3 mb-1">Manajemen Kontak</h1>
        <p class="text-muted mb-0">Catat nama, telepon, dan email.</p>
    </div>
    <div class="row g-4">
        <div class="col-lg-5 mb-4 mb-lg-0">
            <h5 class="mb-3"><?= $editingIndex === null ? 'Tambah Kontak' : 'Edit Kontak'; ?></h5>
            <form method="post" class="border rounded p-3 bg-white">
                <input type="hidden" name="action" value="save">
                <?php if ($editingIndex !== null): ?>
                    <input type="hidden" name="editing_index" value="<?= $editingIndex; ?>">
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label" for="name">Nama</label>
                    <input
                        type="text"
                        class="form-control <?= isset($errors['name']) ? 'is-invalid' : ''; ?>"
                        id="name"
                        name="name"
                        value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"
                        required
                    >
                    <?php if (isset($errors['name'])): ?>
                        <div class="invalid-feedback"><?= $errors['name']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone">Nomor Telepon</label>
                    <input
                        type="text"
                        class="form-control <?= isset($errors['phone']) ? 'is-invalid' : ''; ?>"
                        id="phone"
                        name="phone"
                        value="<?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>"
                        required
                    >
                    <?php if (isset($errors['phone'])): ?>
                        <div class="invalid-feedback"><?= $errors['phone']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input
                        type="email"
                        class="form-control <?= isset($errors['email']) ? 'is-invalid' : ''; ?>"
                        id="email"
                        name="email"
                        value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"
                        required
                    >
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?= $errors['email']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <?= $editingIndex === null ? 'Simpan' : 'Perbarui'; ?>
                    </button>
                    <?php if ($editingIndex !== null): ?>
                        <a href="index.php" class="btn btn-outline-secondary">Batal</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="col-lg-7">
            <h5 class="mb-3">Daftar Kontak</h5>
            <?php if (!$contacts): ?>
                <div class="alert alert-secondary mb-0">Belum ada data. Tambahkan kontak pertama Anda!</div>
            <?php else: ?>
                <div class="table-responsive bg-white border rounded">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($contacts as $index => $contact): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($contact['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?= htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="index.php?edit=<?= $index; ?>" class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>
                                        <form method="post">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="index" value="<?= $index; ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>


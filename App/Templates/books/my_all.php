<?php /** @var \App\Data\BookDTO[] $data */ ?>

<h1>My Books</h1>

<a href="add_book.php"> Add new book </a> |
<a href="profile.php"> My Profile </a> |
<a href="logout.php"> Logout </a> <br /> <br />

<table border="1">
    <thead>
    <tr>
        <td>Title</td>
        <td>Author</td>
        <td>Genre</td>
        <td>Added By User</td>
        <td>Edit</td>
        <td>Delete</td>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($data as $book): ?>
        <tr>
            <td><?= $book->getTitle(); ?></td>
            <td><?= $book->getAuthor(); ?></td>
            <td><?= $book->getGenre()->getName(); ?></td>
            <td><?= $book->getUser()->getFullName(); ?></td>
            <td><a href="edit_book.php?id=<?= $book->getId(); ?>">Edit</a></td>
            <td><a href="delete_book.php?id=<?= $book->getId(); ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
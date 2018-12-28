<?php /** @var \App\Data\BookDTO[] $data */ ?>

<h1>All Books</h1>

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
        <td>Details</td>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($data as $book): ?>
        <tr>
            <td><?= $book->getTitle(); ?></td>
            <td><?= $book->getAuthor(); ?></td>
            <td><?= $book->getGenre()->getName(); ?></td>
            <td><?= $book->getUser()->getUsername(); ?></td>
            <td><a href="details.php?id=<?= $book->getId(); ?>">details</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
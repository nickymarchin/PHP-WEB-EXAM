<?php /** @var \App\Data\EditDTO $data */ ?>

<h1>ADD NEW BOOK</h1>

<a href="profile.php"> My Profile </a> <br /> <br />

<form method="post">

    Book Title: <input type="text" name="title" minlength="3" maxlength="50"/><br />

    Book Author: <input type="text" name="author" minlength="3" maxlength="50"/><br />


    Description: <input type="text" name="description" minlength="10" maxlength="10000"/><br />

    Image URL: <input type="text" name="image"><br/>

    Genre: <select name="genre_id">
        <?php foreach ($data->getGenres() as $genre): ?>
            <option value="<?= $genre->getId(); ?>"> <?= $genre->getName(); ?></option>
        <?php endforeach; ?>
            </select><br />

    <input type="submit" name="save" value="Save"/>

</form>



<?php /** @var \App\Data\EditDTO $data */ ?>

<h1>EDIT BOOK "<?= $data->getBook()->getTitle(); ?>"</h1> <br/><br/>

<a href="profile.php">My Profile</a><br/><br/>

<form method="post">
    Book Title: <input value="<?= $data->getBook()->getTitle(); ?>" type="text" name="title" minlength="3"
                  maxlength="50"/><br/>

    Book Author: <input value="<?= $data->getBook()->getAuthor(); ?>" type="text" name="author" minlength="3"
                        maxlength="50"/><br/>

    Description: <input value="<?= $data->getBook()->getDescription(); ?>" type="text" name="description"/><br/>

    Image URL: <input value="<?= $data->getBook()->getImage(); ?>" type="text" name="image"/><br/>


    Genre: <select name="genre_id">
        <?php foreach ($data->getGenres() as $genre): ?>
            <?php if ($data->getBook()->getGenre()->getId() === $genre->getId()) : ?>
                <option selected="selected" value="<?= $genre->getId(); ?>"><?= $genre->getName(); ?></option>
            <?php else: ?>
                <option value="<?= $genre->getId(); ?>"><?= $genre->getName(); ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select><br/>

    <input type="submit" name="save" value="Edit"/><br/>

    <img src=" <?= $data->getBook()->getImage()?>">

</form>

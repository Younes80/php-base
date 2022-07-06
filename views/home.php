<div class="content">
    <h2>Listes de produit</h2>
    <form action="./index.php?page=back/create-fruit" method="POST">
        <input type="text" name="name" id="name" placeholder="Nouveau fruit">
        <button type="submit">Envoyer</button>
        <?php if ($error) : ?>
            <span><?= $error ?></span>
        <?php endif; ?>
    </form>
    <ul>
        <?php foreach ($products as $product) : ?>
            <li><?= $product->name ?></li>
            <a href="./index.php?page=back/edit-fruit&id=<?= $product->id ?>">Modifier</a>
            <a href="./index.php?page=back/delete-fruit&id=<?= $product->id ?>">Supprimer</a>
        <?php endforeach; ?>
    </ul>
</div>
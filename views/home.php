<div class="content">
    <h2>Listes de produit</h2>
    <form action="create-product" method="POST">
        <input type="text" name="name" id="name" placeholder="Nouveau fruit">
        <button type="submit">Envoyer</button>
        <?php if ($error) : ?>
            <span><?= $error ?></span>
        <?php endif; ?>
    </form>
    <ul>
        <?php foreach ($products as $product) : ?>
            <?php if ((int) $id === $product->id) : ?>
                <form action="update-product" method="POST">
                    <input type="hidden" name="id" id="id" value="<?= $product->id ?>">
                    <input type="text" name="name" id="name" value="<?= $product->name ?>">
                    <button>Confirmer</button>
                </form>
            <?php else : ?>
                <li><?= $product->name ?></li>
                <a href="home&id=<?= $product->id ?>">Modifier</a>
                <a href="delete-product&id=<?= $product->id ?>">Supprimer</a>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
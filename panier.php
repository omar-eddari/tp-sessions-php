<?php
// TODO 1: Inclure le header
include "includes/header.php";
session_start();
// TODO 2: Initialiser une variable $total à 0
$total = 0;
?>

<div class="container my-4">
    <h1 class="mb-4">Mon Panier</h1>
    
    <!-- TODO 3: Vérifier si le panier est vide avec empty() -->
    <!-- Si vide : afficher une alerte Bootstrap info avec un lien vers index.php -->
    <!-- Si non vide : afficher le tableau du panier -->
    
    <?php if (empty($_SESSION['panier'])): ?>
        <div class="alert alert-info">
            Votre panier est vide. <a href="index.php" class="alert-link">Retourner aux produits</a>.
        </div>
    <?php else: ?>
        
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
                <!--TODO 4: Boucler sur $_SESSION['panier']
                Pour chaque article :
                - Calculer le sous-total (prix × quantité)
                - Ajouter le sous-total au total général
                - Afficher une ligne avec :
                  * Image miniature (50x50px) + nom du produit
                  * Prix unitaire
                  * Quantité
                  * Sous-total formaté avec number_format($sous_total, 2)-->
                <?php foreach ($_SESSION['panier'] as $item): 
                    $sous_total = $item['price'] * $item['quantite'];
                    $total += $sous_total;
                ?>
                <tr>
                    <td>
                        <img src="<?php echo htmlspecialchars($item['thumbnail']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                        <?php echo htmlspecialchars($item['title']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($item['price']); ?> €</td>
                    <td><?php echo htmlspecialchars($item['quantite']); ?></td>
                    <td><?php echo number_format($sous_total, 2); ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total :</th>
                    <th><!--TODO: Afficher le total formaté-->
                        <?php echo number_format($total, 2); ?> €
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>

    <!-- TODO 5: Ajouter les boutons d'action -->
    <div class="d-flex justify-content-between mt-4">
        <!--- Bouton "Continuer les achats" (lien vers index.php)
        - Formulaire pour vider le panier (POST vers actions/vider_panier.php)
          avec un bouton "Vider le panier" (classe btn-danger)-->
        <a href="index.php" class="btn btn-secondary">Continuer les achats</a>
        <form method="POST" action="actions/vider_panier.php">
            <button type="submit" class="btn btn-danger">Vider le panier</button>
        </form>
    </div>
</div>

<!-- TODO 6: Inclure Bootstrap JS -->
</body>
</html>
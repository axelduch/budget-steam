<?php
namespace View;
use Core;

class BudgetManager extends AbstractView {
    
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
    </head>
<?php
if (isset($_POST['purchase']) && $_POST['purchase']) {
    if (isset($_POST['game']) && !empty($_POST['game'])
        && isset($_POST['price']) && !empty($_POST['price'])) {
        $budgetManager->addPurchase($_POST['game'], str_replace(',', '.', $_POST['price']));
        if ($budgetManager->save()) {
            echo 'Jeu ajouté à la liste d\'achat avec succès !<br />';
        }
    }
}

foreach (($budgetManager->getPurchasedItems()) as $item) {
    echo $item->game . ' ' . $item->price . '€ ' . $item->date . '<br />';
}

echo "Budget disponible: " . $budgetManager->getAvailableBudget() . "€";
echo $budgetManager->getPurchaseForm();
?>
</html>
}
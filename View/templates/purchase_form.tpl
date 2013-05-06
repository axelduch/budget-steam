<pre>
    Ajouter un achat
</pre>
<form method="POST" action="/history/create">
    <lable>Nom du jeu</label><br />
    <input type="text" name="game" /><br />
    <label>Prix du jeu</label><br />
    <input type="text" name="price" /><label>€</label>
    <input type="hidden" name="purchase" value="1"/>
    <input type="submit" value="ajouter" />
</form>
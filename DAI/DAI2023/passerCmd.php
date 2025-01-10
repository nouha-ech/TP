<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript">
        function tester() {
            tab=document.getElementsByName('cb[]');
            let long=tab.length;
            for(let i = 0; i < long; i++) {
                if(tab[i].checked) return true;
            }
            return false;
        }
    </script>
</head>
<body>
    <h3> Passer une commande</h3>
    <form method="post" action="addCmd.php">
        <table>
            <tr><td><label>Numéro Client</label></td>
                <td><input type="text" name="numCl"></td></tr>
            <tr><td><label>Numéro Commande</label></td>
                <td><input type="text" name="numCmd"></td></tr>
        </table>
        <h3>Liste des articles</h3>
        <table border='2'>
            <thead>
                <tr><th>code</th><th>Libellé</th><th>Prix</th><th>Quantité</th>
                <th></th></tr>
            </thead>
            <tbody>
                <?php
                include "listing.php";
                ?>
            </tbody>
        </table>
        <input type="submit" value="Passer Commande" onclick="return tester();">
    </form>
</body>
</html>
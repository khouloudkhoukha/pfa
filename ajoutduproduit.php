<!--
$servername="localhost";
$username="root";
$password="";
$dbname="wasteless";
try{
$conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password );
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
}
catch (PDOException $e){

echo "la connexion a echoué:".$e->getMessage();
}
if(isset($_POST['buttonadd']))
{
    $name = $_POST['productName'] ;
    $category = $_POST['productCategory'] ;
    $price = $_POST['productPrice'] ;
    $quantity =$_POST['productQuantity'] ;
    $location = $_POST['productLocation'];
    $description = $_POST['productDescription'] ;
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . $_FILES['productImage']['name'];
        move_uploaded_file($_FILES['productImage']['tmp_name'], $imagePath);
    } else {
        $imagePath = null; // Set to null if no image is uploaded
    }
    

    $sql = ("INSERT INTO products(name, category, price, quantity, location, description, image) VALUES (:name, :category, :price, :quantity, :location, :description, :image)");
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':name',$name);
    $stmt->bindParam(':category',$category);
    $stmt->bindParam(':price',$price);
    $stmt->bindParam(':quantity',$quantity);
    $stmt->bindParam(':location',$location);
    $stmt->bindParam(':description',$description);
    $stmt->bindParam(':image',$imagePath);
    $stmt->execute();
    header("Location: dashboard.html");
exit();


} -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit - WASTELESS</title>
    <link rel="stylesheet" href="style_ajoutprod.css">
</head>
<body>

    <div class="dashboard-container">
        <aside class="sidebar">
            <a href="dashboard.html"> 
                <img src="images/wasteless.png" class="waste-img">
            </a>
            
            <nav class="menu">
                <ul>
                    <li>
                        <a href="#gerer-produits" class="toggle-submenu">Gérer Produits</a>
                        <ul class="submenu">
                            <li><a href="ajout.html">Ajouter un Produit</a></li>
                            <li><a href="modif-produit.html">Modifier un Produit</a></li>
                            <li><a href="supprim-produit.html">Supprimer un Produit</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#gerer-commandes" class="toggle-submenu">Gérer Commandes</a>
                        <ul class="submenu">
                            <li><a href="consult-cmd.html">Consulter les Commandes</a></li>
                            <li><a href="suiv-expd.html">Suivre l'Expédition</a></li>
                            <li><a href="det-cmd.html">Détails de la Commande</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#gerer-stock" class="toggle-submenu">Gérer Stock</a>
                        <ul class="submenu">
                            <li><a href="mise-jour-stock.html">Mise à Jour du Stock</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <h1>Ajouter un Produit</h1>
            <form id="addProductForm" method="post" action="ajoutcontroller.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productName">Nom du Produit :</label>
                    <input type="text" id="productName" name="productName" required>
                </div>
                <div class="form-group">
                    <label for="productCategory">Catégorie :</label>
                    <input type="text" id="productCategory" name="productCategory" required>
                </div>
                <div class="form-group">
                    <label for="productPrice">Prix :</label>
                    <input type="number" id="productPrice" name="productPrice" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="productQuantity">Quantité (Stock) :</label>
                    <input type="number" id="productQuantity" name="productQuantity" required>
                </div>
                <div class="form-group">
                    <label for="productLocation">Localisation :</label>
                    <input type="text" id="productLocation" name="productLocation" required>
                </div>
                <div class="form-group">
                    <label for="productDescription">Description :</label>
                    <textarea id="productDescription" name="productDescription" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="productImage">Image du Produit :</label>
                    <input type="file" id="productImage" name="productImage" accept="image/*">
                </div>
                <button type="submit" name="buttonadd" >Ajouter Produit</button>
               
                
            </form>
        </main>

        <a href=""> 
            <img src="images/profile.png" class="profile-img">
        </a>
    </div>

    <script> 
        // Gestion du menu déroulant
        const submenuToggles = document.querySelectorAll('.toggle-submenu');

        submenuToggles.forEach(toggle => {
            toggle.addEventListener('click', function (event) {
               // event.preventDefault();
                const submenu = this.nextElementSibling;
                submenu.classList.toggle('active');
            });
        });

        // Gestion de l'envoi du formulaire
        document.getElementById('addProductForm').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Produit ajouté avec succès !');
            this.reset(); // Réinitialise le formulaire
        });
    </script>
</body>
</html>

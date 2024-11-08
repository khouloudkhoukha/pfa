<?php 
require_once 'connexion.php';
require_once 'parametres.php';
$db=connect($config);
if($db ==null)
{
    echo"Revenez dans quelques instants";
}
else 
{
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
        

        $insert = $db->prepare("INSERT INTO products(name, category, price, quantity, location, description, image) VALUES (:name, :category, :price, :quantity, :location, :description, :image)");

        $insert->bindValue('name',$name,PDO::PARAM_STR);
        $insert->bindValue('category',$category,PDO::PARAM_STR);
        $insert->bindValue('price',$price,PDO::PARAM_STR);
        $insert->bindValue('quantity',$quantity,PDO::PARAM_STR);
        $insert->bindValue('location',$location,PDO::PARAM_STR);
        $insert->bindValue('description',$description,PDO::PARAM_STR);
        $insert->bindValue('image',$imagePath,PDO::PARAM_STR);
        if (empty($name) || empty($category) || empty($price) || empty($quantity) || empty($location) || empty($description)) {
            echo "Tous les champs doivent être remplis.";
        } else {
        if ($insert->execute()) {
            echo "Produit ajouté avec succès !";
        } else {
            echo "Échec de l'ajout du produit";
        }
    }
    }
}
?>
<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
         <div>
            
            <h2>Barre de recherche utilisant PHP</h2>
            <form method="post">
              <label>Search</label>
              <input type="text" name="search">
              <input type="submit" name="submit"> 
            </form>
            <?php
$con = new PDO("mysql:host=localhost;dbname=inventory_system",'root','');

if (isset($_POST["submit"])){
    $str = $_POST["search"];
    $sth = $con->prepare("SELECT * FROM `products` WHERE name ='$str'");
    $sth->setFetchMode(PDO:: FETCH_OBJ);
    $sth ->execute();

    if($row = $sth->fetch())
    {
        ?>
        <br><br><br>
        <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">Nom</th>
                <th class="text-center" style="width: 10%;"> quantité</th>
                <th class="text-center" style="width: 10%;"> prix d’achat </th>
                <th class="text-center" style="width: 10%;"> sale price </th>
                <th class="text-center" style="width: 10%;"> Catégories </th>
                <th class="text-center" style="width: 10%;"> ID du support </th>
                <th class="text-center" style="width: 10%;"> Date </th>
              </tr>
            </thead>
     
         <td><?php echo $row->name; ?></td>
         <br>
         <td><?php echo $row->quantity; ?></td>
         <br>
         <td><?php echo $row->buy_price; ?></td>
         <br>
         <td><?php echo $row->sale_price; ?></td>
         <br>
         <td><?php echo $row->categorie_id; ?></td>
         <br>
         <td><?php echo $row->media_id; ?></td>
         <br>
         <td><?php echo $row->date; ?></td>
     </tr>
        </table>
        <?php
    }
    
    else{
        echo  "Le nom n’existe pas";
    }
}
?>
          </div>
           <a href="add_product.php" class="btn btn-primary">Ajouter un nouveau</a>
         </div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Photo</th>
                <th> Titre du produit </th>
                <th class="text-center" style="width: 10%;"> Categories </th>
                <th class="text-center" style="width: 10%;"> En stock </th>
                <th class="text-center" style="width: 10%;"> Buying Price </th>
                <th class="text-center" style="width: 10%;"> Prix de vente </th>
                <th class="text-center" style="width: 10%;"> Produit ajouté </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('layouts/footer.php');?>
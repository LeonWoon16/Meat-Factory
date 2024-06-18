<?php
  include_once 'products_crud.php';
  if (!isset($_SESSION['isLogin']))
  header("Location: logout.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Meat Factory : Products</title>
<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">
    

    <script>$(document).ready(function () {
    $('[id*="detailbtn"]').on('click', function(){
      var dataURL=$(this).attr('data-href');
          $('.modal-body').load(dataURL, function(){
            $('#productDetailModal').modal({show:true});
          });   
      });
     $('#productlist').DataTable({
      lengthMenu: [
        [5, 10, 20, 30, -1],
        [5, 10, 20, 30, 'All'],
        ],
    });
  });
  </script>
</head>


<body>
  <?php include_once 'nav_bar.php'; ?>
  <?php
  if($_SESSION['userInfo']['fld_staff_role'] == "Admin" || $_SESSION['userInfo']['fld_staff_role'] == "Supervisor"){?>  

<div class="container-fluid">
 <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Product</h2>
      </div>
     <form action="products.php" method="post" class="form-horizontal">
       <div class="form-group">
          <label for="productid" class="col-sm-3 control-label">ID</label>
          <div class="col-sm-9">
          <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required>
        </div>
        </div>
      <div class="form-group">
          <label for="productname" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
          <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
        </div>
        </div>
        <div class="form-group">
          <label for="productprice" class="col-sm-3 control-label">Price</label>
          <div class="col-sm-9">
          <input name="price" type="number" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" min="0.0" step="0.01" required>
        </div>
        </div>
      <div class="form-group">
          <label for="producttype" class="col-sm-3 control-label">Type</label>
          <div class="col-sm-9">
          <select name="type" class="form-control" id="producttype" required>
            <option value="">Please select</option>
            <option value="Poultry" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Poultry") echo "selected"; ?>>Poultry</option>
            <option value="Meat" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Meat") echo "selected"; ?>>Meat</option>
            <option value="Fish" <?php if(isset($_GET['edit'])) if($editrow['fld_product_type']=="Fish") echo "selected"; ?>>Fish</option>
          </select>
        </div>
        </div>  

        <div class="form-group">
          <label for="productorg" class="col-sm-3 control-label">Organic</label>
          <div class="col-sm-9">
          <div class="radio">
              <label>
              <input name="organic" type="radio" id="productorg" value="Yes" <?php if(isset($_GET['edit'])) if($editrow['fld_product_organic']=="Yes") echo "checked"; ?> required> Yes
            </label>
          </div>
          <div class="radio">
              <label>
                <input name="organic" type="radio" id="productorg" value="No" <?php if(isset($_GET['edit'])) if($editrow['fld_product_organic']=="No") echo "checked"; ?>> No
            </label>
            </div>
          </div>
      </div>

        <div class="form-group">
          <label for="productmanufacturer" class="col-sm-3 control-label">Manufacturer</label>
          <div class="col-sm-9">
          <select name="manufacturer" class="form-control" id="productmanufacturer" required>
            <option value="">Please select</option>
            <option value="CL Fresh PLT" <?php if(isset($_GET['edit'])) if($editrow['fld_product_manufacturer']=="CL Fresh PLT") echo "selected"; ?>>CL Fresh PLT</option>
            <option value="TPL Fresh Meats" <?php if(isset($_GET['edit'])) if($editrow['fld_product_manufacturer']=="TPL Fresh Meats") echo "selected"; ?>>TPL Fresh Meats</option>
            <option value="Tulus Raya Global Sdn Bhd" <?php if(isset($_GET['edit'])) if($editrow['fld_product_manufacturer']=="Tulus Raya Global Sdn Bhd") echo "selected"; ?>>Tulus Raya Global Sdn Bhd</option>
          </select>
        </div>
        </div>   

      <div class="form-group">
          <label for="productq" class="col-sm-3 control-label">Quantity</label>
          <div class="col-sm-9">
          <input name="quantity" type="number" class="form-control" id="productq" placeholder="Product Quantity" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_quantity']; ?>"  min="0" required>
        </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
          <?php if (isset($_GET['edit'])) { ?>
          <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
          <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update</button>
          <?php } else { ?>
          <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create</button>
          <?php } ?>
          <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
        </div>
      </div>
    </form>
    </div>
  </div>

  <?php } ?>

  <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
        <div class="page-header">
          <h2>Products List</h2>
        </div>
        <table id="productlist" class="table table-striped table-bordered" style="width:100%">
          <thead>
        <tr>
          <th>Product ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Type</th>
          <th>Quality</th>
          <th></th>
      </tr>
        </thead>
    <tbody>

      <?php
      // Read  
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $stmt = $conn->prepare("select * from tbl_products_a179904_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>  
      <tr>
        <td><?php echo $readrow['fld_product_num']; ?></td>
        <td><?php echo $readrow['fld_product_name']; ?></td>
        <td><?php echo $readrow['fld_product_price']; ?></td>
        <td><?php echo $readrow['fld_product_type']; ?></td>
        <td><?php echo $readrow['fld_product_quantity']; ?></td>
        <td>
          <a id="detailbtn" data-href="products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>

         <?php if($_SESSION['userInfo']['fld_staff_role'] == "Admin" || $_SESSION['userInfo']['fld_staff_role'] == "Supervisor"){?>           

          <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>" class="btn btn-success btn-xs" role="button"> Edit </a>
          <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>

          <?php } ?>
        </td>
      </tr>
       <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
  <div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Product Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
  </div>

</body>
</html>
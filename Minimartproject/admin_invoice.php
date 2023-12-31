<?php

@include 'config.php';


session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};



   
      
   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Supplier Invoice</title>
    <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/adminStyle.css">
   <link rel="stylesheet" href="css/userstyle.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <link rel='stylesheet' href='https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css'>
    <script src="https://code.jquery.com/ui/1.13.0-rc.3/jquery-ui.min.js" integrity="sha256-R6eRO29lbCyPGfninb/kjIXeRjMOqY3VWPVk6gMhREk=" crossorigin="anonymous"></script>
    
  </head>
<body>

<?php @include 'admin_header.php'; ?>
    <div class='container pt-5 bg-light'>
    


      <h1 class='text-center text-primary text-dark bg-secondary'>Supplier Invoice</h1><hr>
      <?php
          $conn = mysqli_connect('localhost','root','','grocery_db') or die('connection failed');
     
        if(isset($_POST["submit"])){
          $invoice_no=$_POST["invoice_no"];
          $invoice_date=date("Y-m-d",strtotime($_POST["invoice_date"]));
          $sname=mysqli_real_escape_string($conn,$_POST["sname"]);
          $saddress=mysqli_real_escape_string($conn,$_POST["saddress"]);
          $scontact=mysqli_real_escape_string($conn,$_POST["scontact"]);
          $grand_total=mysqli_real_escape_string($conn,$_POST["grand_total"]);


      
          
          $sql="insert into invoice (INVOICE_NO,INVOICE_DATE,SNAME,SADDRESS,SCONTACT,GRAND_TOTAL) values ('{$invoice_no}','{$invoice_date}','{$sname}','{$saddress}','{$scontact}','{$grand_total}') ";
          if($conn->query($sql)){
            $sid=$conn->insert_id;
            
            $sql2="insert into invoice_products (SID,PNAME,PRICE,QTY,TOTAL) values ";
            $rows=[];
            for($i=0;$i<count($_POST["pname"]);$i++)
            {
              $pname=mysqli_real_escape_string($conn,$_POST["pname"][$i]);
              $price=mysqli_real_escape_string($conn,$_POST["price"][$i]);
              $qty=mysqli_real_escape_string($conn,$_POST["qty"][$i]);
              $total=mysqli_real_escape_string($conn,$_POST["total"][$i]);
              $rows[]="('{$sid}','{$pname}','{$price}','{$qty}','{$total}')";
            }
            $sql2.=implode(",",$rows);
            if($conn->query($sql2)){
              echo "<div class='alert alert-success'>Invoice Added Successfully. <a href='print.php?id={$sid}' target='_BLANK'>Click </a> here to Print Invoice </div> ";
            }else{
              echo "<div class='alert alert-danger'>Invoice Added Failed.</div>";
            }
          }else{
            echo "<div class='alert alert-danger'>Invoice Added Failed.</div>";
          }
        }
        
      ?>
      <form method='post' action='invoice.php' autocomplete='off'>
        <div class='row'>
          <div class='col-md-4'>
            <h5 class='text-success'>Invoice Details</h5>
            <div class='form-group'>
              <label>Invoice No</label>
              <input type='text' name='invoice_no' required class='form-control'>
            </div>
            <div class='form-group'>
              <label>Invoice Date</label>
              <input type='text' name='invoice_date' id='date' required class='form-control'>
            </div>
          </div>
          <div class='col-md-8'>
            <h5 class='text-success'>Supplier Details</h5>
            <div class='form-group'>
              <label>Name</label>
              <input type='text' name='sname' required class='form-control'>
            </div>
            <div class='form-group'>
              <label>Address</label>
              <input type='text' name='saddress' required class='form-control'>
            </div>
            <div class='form-group'>
              <label>Contact</label>
              <input type='text' name='scontact' required class='form-control'>
            </div>
          </div>
        </div>
        <div class='row'>
          <div class='col-md-12'>
            <h5 class='text-success'>Product Details</h5>
            <table class='table table-bordered'>
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id='product_tbody'>
                <tr>
                  <td><input type='text' required name='pname[]' class='form-control'></td>
                  <td><input type='text' required name='price[]' class='form-control price'></td>
                  <td><input type='text' required name='qty[]' class='form-control qty'></td>
                  <td><input type='text' required name='total[]' class='form-control total'></td>
                  <td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'> </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td><input type='button' value='+ Add Row' class='btn btn-success btn-sm' id='btn-add-row'></td>
                  <td colspan='2' class='text-right'>Total</td>
                  <td><input type='text' name='grand_total' id='grand_total' class='form-control' required></td>
                </tr>
              </tfoot>
            </table>
            <input type='submit' name='submit' value='Save Invoice' class='btn btn-success float-right'>
          </div>
        </div>
      </form>
    </div>
    <script>
      $(document).ready(function(){
        $("#date").datepicker({
          dateFormat:"dd-mm-yy"
        });
        
        $("#btn-add-row").click(function(){
          var row="<tr> <td><input type='text' required name='pname[]' class='form-control'></td> <td><input type='text' required name='price[]' class='form-control price'></td> <td><input type='text' required name='qty[]' class='form-control qty'></td> <td><input type='text' required name='total[]' class='form-control total'></td> <td><input type='button' value='x' class='btn btn-danger btn-sm btn-row-remove'> </td> </tr>";
          $("#product_tbody").append(row);
        });
        
        $("body").on("click",".btn-row-remove",function(){
          if(confirm("Are You Sure?")){
            $(this).closest("tr").remove();
            grand_total();
          }
        });

        $("body").on("keyup",".price",function(){
          var price=Number($(this).val());
          var qty=Number($(this).closest("tr").find(".qty").val());
          $(this).closest("tr").find(".total").val(price*qty);
          grand_total();
        });
        
        $("body").on("keyup",".qty",function(){
          var qty=Number($(this).val());
          var price=Number($(this).closest("tr").find(".price").val());
          $(this).closest("tr").find(".total").val(price*qty);
          grand_total();
        });      
        
        function grand_total(){
          var tot=0;
          $(".total").each(function(){
            tot+=Number($(this).val());
          });
          $("#grand_total").val(tot);
        }
      });
    </script>
  </body>
</html>
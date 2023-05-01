<?php
session_start();
// Include configuration file 
include_once 'config.php';

// Include database connection file 
include_once 'dbConnect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-10 col-xl-8">
        <div class="card">
          <div class="card-body p-md-5">

            <div class="px-3 py-4 border border-primary border-2 rounded mt-4 d-flex justify-content-between">
              <div class="d-flex flex-row align-items-center">
                <img src="https://i.imgur.com/S17BrTx.webp" class="rounded" width="60" />
                <div class="d-flex flex-column ms-4">
                  <span class="h5 mb-1">Total</span>
                
                </div>
              </div>
              <div class="d-flex flex-row align-items-center">
                <sup class="dollar font-weight-bold text-muted">$</sup>
                <span class="h2 mx-1 mb-0"><?php echo $_SESSION['tot']; ?></span>
                <span class="text-muted font-weight-bold mt-2">/ year</span>
              </div>
            </div>

            <h4 class="mt-5">Payment details</h4>

            
            <form action="<?php echo PAYPAL_URL; ?>" method="post" id="paypal_form">
            <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                    
                    <!-- Important For PayPal Checkout -->
                    
                    <input type="hidden" name="item_name" value="<?php echo $_SESSION['desc']; ?>" id="item" required><br><br>
                    <input type="hidden" required="" value="<?php echo $_SESSION['tot']; ?>" name="amount" id="amount">
                    <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
                    
                    <!-- Specify a Buy Now button. -->
                    <input type="hidden" name="cmd" value="_xclick">
                    <!-- Specify URLs -->
                    <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                    <br><br>
            <div class="mt-3">
              <button type="submti" name="submit" class="btn btn-primary btn-block btn-lg">
                Proceed to payment <i class="fas fa-long-arrow-alt-right"></i>
              </button>
            </div>
</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>

              
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("#paypal_form").submit(function(){
            setData(jQuery("#amount").val(), jQuery("#item").val());
        });
        function setData(amount, item) {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            
          };
          xhttp.open("GET", "insertData.php?amount="+amount+"&item="+item, true);
          xhttp.send();
        }
    });
</script>
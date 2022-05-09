<?php
$pId = (isset($_GET['hidProductId'])) ? (int) htmlspecialchars($_GET['hidProductId']) : 0;
$price = (isset($_GET['hidPrice'])) ? (int) htmlspecialchars($_GET['hidPrice']) : 0;
$itemName = (isset($_GET['hidItemName'])) ? (int) htmlspecialchars($_GET['hidItemName']) : 0;
?>
<!-- 
    DISCLAIMER!!! This is taken completely from w3 schools and the css is as well i will cite it at the botom of the page in proper mla format:)
-->
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="handleStuff.php" method="POST">

        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="NY">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="10001">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">

            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
              <input type="hidden" name="hidProductId" value="<?php print $pId;?>">
            </div>
          </div>
        </div>
        <input type="submit" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>

  <div class="col-25">
    <div class="container">
      <h4>Cart
        <span class="price" style="color:black">
          <i class="fa fa-shopping-cart"></i>
        </span>
      </h4>
      <p><a href="productListing.php?pId=<?php print $pId?>"></a> <span class="price"><?php print $price;?></span></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b><?php print $price;?></b></span></p>
    </div>
  </div>
</div>

<!-- 
Citations: 
“How to - Checkout Form.” How To Create a Checkout Form with CSS, https://www.w3schools.com/howto/howto_css_checkout_form.asp. 
No author info :(
-->
<?php
$url = 'https://instilla-sales-tax-problem.s3.eu-central-1.amazonaws.com/sales-tax-problem-test.json';
$JSON = file_get_contents($url);
// You can decode it to process it in PHP
$data = json_decode($JSON, true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body style="background-color: #f6f7fc">
  <div style="background-color:white; position: fixed; top: 0; width: 100%; z-index: 2000; max-height: 50%">
    <div class="container px-4" style="background-color:white">
      <header class="d-flex flex-wrap justify-content-center py-3 ">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
          <span class="fs-4">Instilla</span>
        </a>
      </header>
    </div>
  </div>

  <div class="container px-4 py-5" id="custom-cards" style="margin-top:5rem !important">
    <h2 class="pb-2 font-weight-bold">Products catalogue</h2>
    <div class="row row-cols-1 row-cols-lg-4 align-items-stretch g-4 py-5">
      <?php
      foreach ($data as $product) {
        echo '
        <div class="row">
        <div class="col" style="height: 300px">
        <div class="card h-100 overflow-hidden"  style="background-image: url(' . $product['image'] . ');
        background-repeat: no-repeat;
        background-size:contain;
background-position:center;
      ">
          <div class="d-flex flex-column h-100 px-2 text-white text-shadow-1">
            <ul class="d-flex list-unstyled mt-auto">
              <li class="px-2 rounded" style="background-color: black">
                <small id="'.$product['name'].'-category" class="text-uppercase"><i class="bi bi-tag-fill text-white" style="margin-right: 0.2rem"></i>' . $product['category'] . '</small>
              </li>
            </ul>
          </div>
        </div>
      </div>
        <div class="py-3">
          <h5 id="'.$product['name'].'-name" class="font-weight-bold" style="margin-bottom: 0">' . $product['name'] . '</h5>
          <small id="'.$product['name'].'-price">$ ' . $product['price'] . '</small>
          <div class="input-group mb-3 mt-2">
          <div class="input-group-prepend">
            <div >
              <input id="'.$product['name'].'-checkbox" type="checkbox" style="accent-color: lightblue;outline:1px solid lightblue;
              outline-offset: -2px;"> Apply import duty
            </div>
          </div>
        </div>
        <button onClick=btnClick(event) id="'.$product['name'].'-btn" type="button" style="width:100%" class="btn btn-info text-white font-weight-bold">ADD TO CART</button>
        </div>
      </div>
        ';
      }
      ?>
    </div>

    <h2 class="pb-2 pt-5 font-weight-bold">Selected products</h2>
    <table class="table table-borderless">
      <thead>
        <tr class="border-bottom">
          <th scope="col">Product</th>
          <th scope="col">Imported</th>
          <th scope="col">Price</th>
          <th scope="col">Tax</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>
    <div style="display: flex;
  justify-content: flex-end;">
      <!-- reCAPTCHA_site_key to be added -->
      <button data-action='submit' data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit' onclick="generateReceipt()" type="button" style="width: 25%" class="g-recaptcha btn btn-info text-white">GENERATE RECEIPT</button>
    </div>

    <div style="display: flex;
  justify-content: flex-end;" >
      <div class="mt-5" style="background-color: white;">
        <div class="row row-cols-3 row-cols-lg-3 align-items-stretch g-4 py-1">
          <div class="col">
            <h3 style="margin-top: -0.25rem !important; padding: 3rem 0rem 0rem 0rem; margin-left: 2rem">Receipt</h3>
          </div>
          <div class="col">
            <h4 style="padding: 3rem 0rem 0rem 0rem">Total amount</h4>
          </div>
          <div class="col">
            <p id="receipt-total-amount" style="padding: 3rem 0rem 0rem 0rem">$ 0</p>
          </div>
          <div class="col"></div>
          <div class="col" style="margin-top:0 !important">
            <h6>Including taxes</h6>
          </div>
          <div class="col" style="margin-top:0 !important; padding-left: 1.3rem">
            <h6 id="receipt-totaltax-amount">$ 0</h6>
          </div>
        </div>
      </div>
    </div>

  </div>


</body>

<script>
   function onSubmit(token) {
      generateReceipt();
   }
 </script>

<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</html>
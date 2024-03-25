<?php
$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "ifsc_finder";
$con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);

 ?>

 
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  </head>
  <body>
  <h1><span style="color: #e74c3c;">I</span>FSC <span style="color: #e74c3c;">CODE</span> FINDE<span style="color: #e74c3c;">R</span></h1>

  <!-- //first selecte bank name -> -->
  <div class="container">
  <label>SELECT<span style="color: #e74c3c;"> BANK</span> NAME</label>
  <select id="bank_name" onchange="find_state()">
    <option value="">SELECT BANK NAME</option>
    <?php
    $query=mysqli_query($con,"SELECT * FROM `available_bank_names`");
    while ($b=mysqli_fetch_array($query)) {
      ?>
      <option value="<?php echo $b['name'] ?>"><?php echo $b['name'] ?></option>
      <?php
    }
    ?>
  </select>


  <!-- 2 selecte the state  -->
  <label>SELECT <span style="color: #e74c3c;">STATE</span></label>
  <select id="bank_state" onchange="find_city()">
    <option>SELECT STATE</option>
  </select>

  <!-- 3 selecte the city -->
  <label>SELECT <span style="color: #e74c3c;">CITY</span></label>
  <select id="bank_city" onchange="find_branch()">
    <option>SELECT CITY</option>
  </select>


  <!-- 4 selected the branch -->
  <label>SELECT <span style="color: #e74c3c;">Branch</span></label>
  <select id="bank_branch" onchange="find_ifsc()">
    <option>SELECT<span style="color: #e74c3c;"> BRANCH</span></option>
  </select>

  <!-- 5 display ifsc code -->
  <h1 id="printifsc"></h1>
</div>

<div class="second">
  <h2 id="or">OR</h2>

  <h1 id="ornextline">Find bank details by Using IFSC code > <button id="btn"><a href="ifsctobank.php">click here</a></button></h1>
</div>

  </body>


  <script>
    function find_state(){
      var bank_name = $("#bank_name :selected").text();  //selected name used for the whitch bank name is selected by user there TEXTS
      $("#bank_state").find('option').remove();
      $.ajax({
        url:"ajax.php",
        type:"POST",
        data:{find_state: bank_name}, //key value pairs is this
        success: function(e){
          $("#bank_state").append(e);
          console.log(e);
        }
      })
    }




    function find_city(){
      var bank_name = $("#bank_name :selected").text();
      var bank_state = $("#bank_state :selected").text();
      $("#bank_city").find('option').remove();
      $.ajax({
        url:"ajax.php",
        type:"POST",
        data:{find_city: bank_name,bank_state: bank_state},//key value pairs is this
        success: function(e){
          $("#bank_city").append(e);
        }
      })
    }




    function find_branch(){
      var bank_name = $("#bank_name :selected").text();
      var bank_state = $("#bank_state :selected").text();
      var bank_city = $("#bank_city :selected").text();
      $("#bank_branch").find('option').remove();
      $.ajax({
        url:"ajax.php",
        type:"POST",
        data:{find_branch: bank_name,bank_state: bank_state,bank_city:bank_city},
        success: function(e){
          $("#bank_branch").append(e);
        }
      })
    }




    function find_ifsc(){
      var bank_name = $("#bank_name :selected").text();
      var bank_state = $("#bank_state :selected").text();
      var bank_city = $("#bank_city :selected").text();
      var bank_branch = $("#bank_branch :selected").text();

      $.ajax({
        url:"ajax.php",
        type:"POST",
        data:{find_ifsc: bank_name,bank_state: bank_state,bank_city:bank_city,bank_branch:bank_branch},
        success: function(e){
          $("#printifsc").text(`IFSC CODE :- ${ e.toUpperCase()}`);


        }
      })
    }


  </script>
</html>
<?php
include("login.php"); 
if($_SESSION['name']==''){
	header("location: signin.php");
}
// include("login.php"); 
$emailid= $_SESSION['email'];
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,'demo');
if(isset($_POST['submit']))
{
    $foodname=mysqli_real_escape_string($connection, $_POST['foodname']);
    $meal=mysqli_real_escape_string($connection, $_POST['meal']);
    $category=$_POST['image-choice'];
    $quantity=mysqli_real_escape_string($connection, $_POST['quantity']);
    // $email=$_POST['email'];
    $phoneno=mysqli_real_escape_string($connection, $_POST['phoneno']);
    $district=mysqli_real_escape_string($connection, $_POST['district']);
    $address=mysqli_real_escape_string($connection, $_POST['address']);
    $name=mysqli_real_escape_string($connection, $_POST['name']);
  

 



    $query="insert into food_donations(email,food,type,category,phoneno,location,address,name,quantity) values('$emailid','$foodname','$meal','$category','$phoneno','$district','$address','$name','$quantity')";
    $query_run= mysqli_query($connection, $query);
    if($query_run)
    {

        echo '<script type="text/javascript">alert("data saved")</script>';
        header("location:delivery.html");
    }
    else{
        echo '<script type="text/javascript">alert("data not saved")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Donate</title>
    <link rel="stylesheet" href="loginstyle.css">
</head> 
<body style="    background-color: #06C167;">
<img src="fooddonate.jpg" alt="" style="width: 100vw; height: 100vh; object-fit: cover; position: absolute; top: 0; left: 0; z-index: -1;">

    <div class="container">
        <div class="regformf" >
    <form action="" method="post">
        <p class="logo">Food <b style="color: #06C167; ">Donate</b></p>
        
       <div class="input">
        <label for="foodname"  > Food Name:</label>
        <input type="text" id="foodname" name="foodname" required/>
        </div>
      
      
        <div class="radio">
        <label for="meal" >Meal type :</label> 
        <br><br>

        <input type="radio" name="meal" id="veg" value="veg" required/>
        <label for="veg" style="padding-right: 40px;">Veg</label>
        <input type="radio" name="meal" id="Non-veg" value="Non-veg" >
        <label for="Non-veg">Non-veg</label>
    
        </div>
        <br>
        <div class="input">
        <label for="food">Select the Category:</label>
        <br><br>
        <div class="image-radio-group">
            <input type="radio" id="raw-food" name="image-choice" value="raw-food">
            <label for="raw-food">
              <img src="img/raw-food.png" alt="raw-food" >
            </label>
            <input type="radio" id="cooked-food" name="image-choice" value="cooked-food"checked>
            <label for="cooked-food">
              <img src="img/cooked-food.png" alt="cooked-food" >
            </label>
            <input type="radio" id="packed-food" name="image-choice" value="packed-food">
            <label for="packed-food">
              <img src="img/packed-food.png" alt="packed-food" >
            </label>
          </div>
          <br>
        <!-- <input type="text" id="food" name="food"> -->
        </div>
        <div class="input">
        <label for="quantity">Quantity:(number of person /kg)</label>
        <input type="text" id="quantity" name="quantity" required/>
        </div>
       <b><p style="text-align: center;">Contact Details</p></b>
        <div class="input">
          <!-- <div>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email">
          </div> -->
      <div>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name"value="<?php echo"". $_SESSION['name'] ;?>" required/>
      </div>
      <div>
        <label for="phoneno" >PhoneNo:</label>
      <input type="text" id="phoneno" name="phoneno" maxlength="10" pattern="[0-9]{10}" required />
        
      </div>
      </div>
        <div class="input">
        <label for="location"></label>
        <label for="district">District:</label>
<select id="district" name="district" style="padding:10px;">
  <!-- Bihar -->
  <option value="araria">Araria</option>
  <option value="arwal">Arwal</option>
  <option value="aurangabad">Aurangabad</option>
  <option value="banka">Banka</option>
  <option value="begusarai">Begusarai</option>
  <option value="bhagalpur">Bhagalpur</option>
  <option value="bhojpur">Bhojpur</option>
  <option value="buxar">Buxar</option>
  <option value="darbhanga">Darbhanga</option>
  <option value="east_champaran">East Champaran</option>
  <option value="gaya">Gaya</option>
  <option value="gopalganj">Gopalganj</option>
  <option value="jamui">Jamui</option>
  <option value="jehanabad">Jehanabad</option>
  <option value="kaimur">Kaimur</option>
  <option value="katihar">Katihar</option>
  <option value="khagaria">Khagaria</option>
  <option value="kishanganj">Kishanganj</option>
  <option value="lakhisarai">Lakhisarai</option>
  <option value="madhepura">Madhepura</option>
  <option value="madhubani">Madhubani</option>
  <option value="munger">Munger</option>
  <option value="muzaffarpur">Muzaffarpur</option>
  <option value="nalanda">Nalanda</option>
  <option value="nawada">Nawada</option>
  <option value="patna">Patna</option>
  <option value="purnia">Purnia</option>
  <option value="rohtas">Rohtas</option>
  <option value="saharsa">Saharsa</option>
  <option value="samastipur">Samastipur</option>
  <option value="saran">Saran</option>
  <option value="sheikhpura">Sheikhpura</option>
  <option value="sheohar">Sheohar</option>
  <option value="sitamarhi">Sitamarhi</option>
  <option value="siwan">Siwan</option>
  <option value="supaul">Supaul</option>
  <option value="vaishali">Vaishali</option>
  <option value="west_champaran">West Champaran</option>

  <!-- Delhi -->
  <option value="central_delhi">Central Delhi</option>
  <option value="east_delhi">East Delhi</option>
  <option value="new_delhi">New Delhi</option>
  <option value="north_delhi">North Delhi</option>
  <option value="north_east_delhi">North East Delhi</option>
  <option value="north_west_delhi">North West Delhi</option>
  <option value="shahdara">Shahdara</option>
  <option value="south_delhi">South Delhi</option>
  <option value="south_east_delhi">South East Delhi</option>
  <option value="south_west_delhi">South West Delhi</option>
  <option value="west_delhi">West Delhi</option>

  <!-- Chandigarh -->
  <option value="chandigarh">Chandigarh</option>
</select> 

        <label for="address" style="padding-left: 10px;">Address:</label>
        <input type="text" id="address" name="address" required/><br>
        
      
       
       
        </div>
        <div class="btn">
            <button type="submit" name="submit"> submit</button>
     
        </div>
     </form>
     </div>
   </div>
     
    
</body>
</html>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="favicon.png">
  <meta name="description" content="" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">

  <title>Register</title>
</head>
<style>


.registrationcontainer {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}


form {
    display: flex;
    flex-direction: column;
}

input[type="text"],
input[type="date"],
select,
input[type="password"],
input[type="submit"] {
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

input[type="submit"] {
    background-color: #2a793e;
    color: #fff;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #155724;
}

.signup-link {
    text-align: center;
    margin-top: 10px;
}

.signup-link a {
    color: #2a793e;
    text-decoration: none;
}

.signup-link a:hover {
    text-decoration: underline;
}
h2 {
            text-align: center;
        }

</style>

<body>

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>



  
  <nav class="site-nav mb-5">
    <div class="pb-2 top-bar mb-3">
      <div class="container">
        <div class="row align-items-center">

         <div class="col-6 col-lg-9">
            <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> <span class="d-none d-lg-inline-block">Do you have any questions?</span></a> 
            <a href="#" class="small mr-3"><span class="icon-phone mr-2"></span> <span class="d-none d-lg-inline-block">+233 549 675 706</span></a> 
            <a href="#" class="small mr-3"><span class="icon-envelope mr-2"></span> <span class="d-none d-lg-inline-block">steve.nsabimana@ashesi.edu.gh</span></a> 
          </div>

          <div class="col-6 col-lg-3 text-right">
            <a href="login.php" class="small mr-3">
              <span class="icon-lock"></span>
              Log In
            </a>
            <a href="register.php" class="small">
              <span class="icon-person"></span>
              Register
            </a>
          </div>

        </div>
      </div>
    </div>
    <div class="sticky-nav js-sticky-header">
      <div class="container position-relative">
        <div class="site-navigation text-center">
          <a href="index.html" class="logo menu-absolute m-0">MentorBridge<span class="text-primary"></span></a>

          <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
            <li class="active"><a href="index.php">Home</a></li>
          
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>

          <a href="#" class="btn-book btn btn-secondary btn-sm menu-absolute">Register Now</a>

          <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
            <span></span>
          </a>

        </div>
      </div>
    </div>
  </nav>
  

  <div class="untree_co-hero inner-page overlay" style="background-image: url('images/ashesi_admission.jpg');">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-12">
          <div class="row justify-content-center ">
            <div class="col-lg-6 text-center ">


            </div>
          </div>
        </div>
      </div> 
    </div> 

  </div> 

    <div class="registrationcontainer">
    <h2>Create an Account</h2>

          
          <form  class="registerForm" id = "registrationForm">
    
              <input id="firstName" type="text" name="firstname" pattern="[a-zA-Z]+" title="Your name should not have number " placeholder="First name" required>
              <input id = "lastName"  type="text" name="lastname"  pattern="[a-zA-Z]+" title="Your name should not have number "  placeholder="Last Name" required>
              <label  id ="emailnotification"></label>
              <input id = "email" type="text" name="email" placeholder="Email" onchange= "isValidEmail()"  required>
              <select  name="major" required>
                  <option  disabled selected>Select your major</option>
                  <option >Computer Science</option>
                  <option >Computer Engineering</option>
                  <option > Management and Information Systems</option>
                  <option > Mechanical Engineering</option>
                  <option > Electriconics and Electric Engineering</option>
                  <option > Economics</option>
                  <option > Mechatranics</option>
              </select>
              <label  id ="dobnotification"> </label>
              <input type="date" id="dob" name="dob" placeholder="Date Of Birth" onchange="validateAge()" required>
      

              <label  id ="passwordnotification"> </label>
              <input id = "password"type="password" name="password" placeholder="Password" onchange="isStrongPassword()" required>
              <label  id ="confirmnotification">  </label>
              <input id = "confirmpassword" type="password" name="confirmPassword" placeholder="Confirm Password" onchange="checkSimilarity()" required>
              <input type="submit" value="Sign Up">
              <div class="signup-link">
                  Do you have account? <a href="login.php">Log In</a>
              </div>
              <div id ="message">
            
              </div>   
              
          </form>
    </div>
  <div class="site-footer">


    <div class="container">

      <div class="row">
        <div class="col-lg-3 mr-auto">
          <div class="widget">
            <h3>About Us<span class="text-primary">.</span> </h3>
            <p>Mentorship is the bridge that connects dreams to reality, transforming potential into purpose. Together, we ignite futures and shape tomorrow's leaders.</p>
          </div> 
          <div class="widget">
            <h3>Connect</h3>
            <ul class="list-unstyled social">
              <li><a href="#"><span class="icon-instagram"></span></a></li>
              <li><a href="#"><span class="icon-twitter"></span></a></li>
              <li><a href="#"><span class="icon-facebook"></span></a></li>
              <li><a href="#"><span class="icon-linkedin"></span></a></li>
              <li><a href="#"><span class="icon-pinterest"></span></a></li>
              <li><a href="#"><span class="icon-dribbble"></span></a></li>
            </ul>
          </div> 
        </div> 

      

        <div class="col-lg-3">
          <div class="widget">
            <h3>Contact</h3>
            <address>University Avenue, Ashesi University</address>
            <ul class="list-unstyled links mb-4">
              <li><a href="tel://233599346549">+233 549 675 706</a></li>
              <li><a href="mailto:info@mydomain.com">steve.nsabimana@ashesi.edu.gh</a></li>
            </ul>
          </div> 
        </div> 

      </div> 

      <div class="row mt-5">
        <div class="col-12 text-center">
          <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved.
        </div>
      </div> 
    </div> 


    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/custom.js"></script>

  </body>

  <script>


    $("#registrationForm").submit(function(event) {
        event.preventDefault();

        console.log(isStrongPassword(),isValidEmail(), checkSimilarity())
        
        if(isStrongPassword() && isValidEmail() && checkSimilarity())
        {
            var formData = new FormData(this);
            
    
            $.ajax({
                url: "../action/register_action.php", 
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    var messageElement = $("#message");
                    if (response.status === "success") {
                        messageElement.html("<p>You have successfully created an account!</p>").css("color", "red");
                        $("#registrationForm")[0].reset();
                    } else {
                        messageElement.html("<p>" + response.message + "</p>").css("color", "red");
                    }
                },
                error: function(xhr, status, error) 
                {
                    console.log("Error details: ", error);
                    var errorSection = $("#error-section");
                    errorSection.html("<p>An error occurred: " + error + "</p>").css("color", "red");
                }
            });
        }
    });

   

function isValidAge(dateOfBirth) 
{
   
    const dob = new Date(dateOfBirth);
    const currentDate = new Date();
    const ageDifferenceMs = currentDate - dob;

    const age = Math.floor(ageDifferenceMs / (1000 * 60 * 60 * 24 * 365.25));
  
    return age >= 15;
}





function validateAge() {
        var dobInput = document.getElementById('dob');
        var dobValue = new Date(dobInput.value);
        var now = new Date();
        var age = now.getFullYear() - dobValue.getFullYear();
        
        if (now.getMonth() < dobValue.getMonth() || (now.getMonth() === dobValue.getMonth() && now.getDate() < dobValue.getDate())) {
            age--;
        }

        if (age < 15) {
            dobInput.setCustomValidity('You must be 15 or older to join.');
        } else {
            dobInput.setCustomValidity('');
        }
    }






function checkSimilarity()
{


var password = document.getElementById("password")

var confirmPassword = document.getElementById("confirmpassword")

var label = document.getElementById("confirmnotification")

var p = password.value
var c = confirmPassword.value

if(p===c){

   var form = document.getElementById("passwordform")
   confirmPassword.style.color = "black"
   label.innerHTML = "<p></p>"
   label.style.color = "black"

   return true

   

} else{
    label.innerHTML = "<p> The password do not match</p>"
    label.style.color = "red"
    confirmPassword.style.color = "red"

    return false;
}

}


function isValidEmail() {
    const regex = /^[a-zA-Z.!#$%&'*+/=?^_`{|}~-]+@ashesi.edu.gh$/;
    var emailInput = document.getElementById("email");
    var label = document.getElementById("emailnotification");
    email = emailInput.value.trim()

    if (regex.test(email)) {
        emailInput.style.color = "black";
        label.innerHTML = "<p></p>";
        label.style.color = "black";
        return true;
    } else {
        console.log("I am still here !");
        emailInput.style.color = "red";
        label.innerHTML = "<p>Use a valid Ashesi University email !</p>";
        label.style.color = "red";

        return false;
    }
}



function isStrongPassword() {

var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
var password = document.getElementById("password")

var notification = document.getElementById("passwordnotification")

if (regex.test(password.value)){

password.style.color = "black"
notification.innerHTML  = "<p></p>"
notification.style.color = "black"

return true




}

else{
notification.innerHTML  = "<p> Your password is weak. do a 8 combination A-Z, @ ...</p>"
password.style.color = "red"
notification.style.color = "red"

return false


}
    }


var form = document.getElementById("registrationForm");

form.addEventListener("submit", function(event) {
  var emailInput = document.getElementById("email");
  var password = document.getElementById("password")

  if (isValidEmail()&& isStrongPassword()) {

    return true
  
  }

  else{

    event.preventDefault(); 
    return false
  }
});



</script>

  </html>

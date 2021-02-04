<div class="register-box">
  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
     <form action="" method="post">
      <?php 
        if (isset($_POST["btn_register"]))
        {
          $reg_fullname = $_POST["reg_fullname"];
          $reg_bday = $_POST["reg_bday"];
          $reg_address = $_POST["reg_address"];
          $reg_card = $_POST["reg_card"];
          $reg_PhotoString = $_POST["reg_PhotoString"];
          $valCard = $c_insert->func_ValidateCard($conn, $reg_card);  //fn_email_Validate
        
          if ($valCard == "")
          {
             // echo($reg_bday);
             $reg_ret = $c_insert->func_Resgistration($conn, $reg_fullname, $reg_bday, $reg_address, $reg_card, $reg_PhotoString);
             if ($reg_ret == "success")
             {
              echo '<button type="button" class="col-12 btn btn-success" style="margin-bottom: 15px;">Sucess</button><br>';
             }
             else
             {
                echo '<button type="button" class="col-12 btn btn-warning" style="margin-bottom: 15px;">'.$reg_ret.'</button><br>';
             }
          }
          else
          {  
             echo '<button type="button" class="col-12 btn btn-warning" style="margin-bottom: 15px;">Card is already exist!</button><br>';
          }
        }
      ?>  
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="reg_fullname" required  name="reg_fullname" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">

          <input type="date" class="form-control" id="reg_bday" required name="reg_bday" placeholder="Birth Day">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="reg_address" required name="reg_address" placeholder="Address">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-map"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" id="reg_card" pattern="[0-9\s]{13,19}" onchange="func_cardValid()" maxlength="16" required name="reg_card" placeholder="Card">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas  fa-credit-card"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="file" class="form-control" id="reg_Image" onchange="img_base64(this)" name="reg_Image" placeholder="Upload Profile">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <textarea id="string_photo" name="reg_PhotoString" hidden></textarea>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="agreeTerms2" required value="valid">
              <label for="agreeTerms">
               I agree to the <a href="">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" name="btn_register" class="btn btn-primary btn-block">
          </div>
          <!-- /.col -->
        </div>
     </form>

    </div>
    <form  action="" method="post">       
       <button type="submit" class="btn btn-link" name="btn_viewlistofregistered">View List of registered </button>       
     </form>

  </div><!-- /.card -->
      <!-- /.form-box --> 
</div>
<div class="col-6">
  <style type="text/css">
    #picID{
      height: 100px;
      width: 100px;      
    }
  </style>
    <?php

        if (isset($_POST["btn_viewlistofregistered"]))
        {
            echo '<table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">userid</th>
                            <th scope="col">Profile</th>
                            <th scope="col">Name</th>
                            <th scope="col">Bday</th>
                            <th scope="col">Card</th>
                            <th scope="col">Address</th>
                            <th scope="col">TDT</th>
                          </tr>
                        </thead>
                        <tbody>';
                                        $s_all = $c_select->func_select($conn);
                                        $count = 1;
                                        while ($row = $s_all->fetch())
                                        {
                                           echo '<tr>
                                                  <th scope="row">'.$count.'</th>
                                                  <td>'.$row['userid'].'</td>
                                                  <td> <img src="'.$row['profilepic'].'" id="picID"> </td>
                                                  <td>'.$row['name'].'</td>
                                                  <td>'.$row['bday'].'</td>
                                                  <td>'.$row['card'].'</td>
                                                  <td>'.$row['address'].'</td>
                                                  <td>'.$row['tdt'].'</td>
                                                </tr>       ';   
                                                 $count =  $count + 1;
                                        }
                                   

                    echo ' </tbody></table>';
        }

      ?>
</div>
   


<script type="text/javascript">
  function img_base64(element) 
  {
    debugger;
    var file = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
        console.log('RESULT', reader.result)
            //$('#stringtypeImage').HTML(reader.result) // = reader.result;
        document.getElementById('string_photo').innerText = reader.result;
    }

    //reader.readAsText(file);
    reader.readAsDataURL(file);
    document.getElementById('string_photo').innerText = reader.result;

   //reader.readAsText(file);
   //base64_displayImage(reader.result);
}

function func_cardValid()
{
  var res = document.getElementById('string_photo').value;

}

</script>
<?php
require_once 'db.connection.php';
require_once 'views.php';
require_once 'report.controller.php';
require_once 'sessions.php';

$user = $_SESSION["superUser"];
$checkConnection = check_superUser_login($connector);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Udate Crime</title>
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" defer href="static/bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" defer href="static/bootstrap-icons/bootstrap-icons.css">

    <style type="text/css" media="all" defer>

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font: 17px "Century Gothic", "Times Roman", sans-serif;
    
}

.heading{
    background: rgb(5, 69, 93);
}
.btn-submit{
    
    background: rgb(5, 69, 93);
}

.form-group, .form-control, textarea {
    width: 95.4%;
    padding: 10px 10px 10px 10px;
    font-weight: normal;
    /* border: none; */
	/* background: rgba(235, 235, 235, 0.20); */
    /* outline: none; */
    margin: 6px 0 17px 0px;
    transition: 0.5s all;
     -webkit-transition: 0.5s all;
    -o-transition: 0.5s all;
    -ms-transition: 0.5s all;
    -moz-transition: 0.5s all; 
     
 
}
.form-bg{
    border-radius: 50px;
}
</style>
</head>
<body>
    <br>
<!-- <a href="sup.dashboard.php" class="p-2 text-dark bi bi-arrow-left-circle fs-2"></a> -->

    <br>
        <div class="container  alert alert-secondary form-bg">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                
            <div class="form-group">

            <h3 class="p-3 text-light heading text-center fw-bold">
                
                   Update Crime Record
                  
            </h3>

                <form action="pm.update_report.php"  method="post" class=" shadow p-5 rounded-2 bg-light" autocomplete="off" enctype="multipart/form-data">
                <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $update_id = $_POST["updateId"];
                    $sql = $connector ->query("SELECT * FROM `crimes` WHERE `crimeId` = '$update_id'; ");
                    if($sql->num_rows > 0){

                    $row = $sql->fetch_assoc();
                    $fullname = $row["OffendersName"];
                    $age = $row["age"];
                    $progress = $row["progressNumber"];
                    $image = $row["offendersImage"];
                    $settlement = $row["settlement"];
                    $address = $row["houseAddress"];
                    $case = $row["crimeCase"];
                    $description = $row["crimeDescription"];
                    $crimeDate = $row["crimeDate"];
                    $status = $row["approvalStatus"];
                    $category = $row["crimeCategory"];
                    $placement = $row["crimePlacement"];
                    $reporter = $row["reporter"];
                    $reported_date = $row["date"];
                    $approval_status = $row["approvalStatus"];
                    $id =  $row["crimeId"];

                    }
                }
                ?>
                <!-- <label for="name" class="text-light">Offender's full name</label> -->
                <input type="text" name="fullname"  class="form-control form-control-lg border-2 placeholder-glow placeholder-wave" placeholder="Offender's full name..." value="<?php echo $fullname ?>">
                <br>
                <!-- <label for="progress" class="text-light">Registration number</label> -->
                <input type="text" name="progress" class="form-control-lg form-control placeholder-wave placeholder-glow" placeholder="Progress number(registration number)" value="<?php echo $progress ?>">
                <br>
                <input type="number" name="age" class="form-control-lg form-control placeholder-wave placeholder-glow" placeholder="Age" value="<?php echo $age ?>">
                <br>

                <label for="settlement" class="text-dark">Select settlement</label>
                <select name="settlement" class="form-control form-control-lg form-select placeholder-wave placeholder-glow" value="<?php echo $settlement ?>">
                <option value="<?php echo $settlement ?>" class="fw-bold"><?php echo $settlement ?></option>
                    <optgroup>
                        <br>
                        <option value="Adagom1 settlement">Adagom1 settlement</option>
                        <option value="Adagom3 settlement">Adagom3 settlement</option>
                        <option value="Okende settlement">Okende settlement</option>
                      
                    </optgroup>
                </select>
                <br>
                <!-- <label for="address" class="text-light">House address</label> -->
                <input type="text" name="address" class="form-control-lg form-control form-check-input-placeholder placeholder-light placeholder-glow placeholder-wave placeholder-xs" placeholder="House address..." value="<?php echo $address ?>">
                <br>
                <label for="crime" class="text-dark">Select crime case <b class="text-danger fs-5">*</b></label>
                
                <select name="crime" class="form-control form-control-lg placeholder-wave placeholder-glow placeholder-lg form-select" id="">
                    <option value="<?php echo $case ?>" class="fw-bold"><?php echo $case ?></option>
                    <optgroup>
                        <option value="" disabled class="fw-bold fs-4">FELONY CATEGORY</option>
                        <option value="" disabled class="text-danger">Selected crimes under this <br> category are 3 years and above punishable</option>
                    
                        <option value="" disabled class="fw-bold text-black">Violent Crimes</option>
                        <option value="Murder">Murder</option>
                        <option value="Manslaughter">Manslaughter</option>
                        <option value="Kidnapping">Kidnapping</option>
                        <option value="Assault">Assault</option>
                        <option value="Robbery">Robbery</option>
                        </optgroup>
                        <optgroup>
                        <option value="" disabled class="fw-bold text-black">Drug Crimes</option>
                        
                        <option value="Traficking">Traficking</option>
                        <option value="Possesion with intent to distribute">Possesion with intent to distribute</option>
                        <option value="Manufactiring">Manufacturing</option>
                        <option value="Cultivation">Cultivation</option>
                        <option value="Sale">Sale</option>
                        
                        
                     
                    </optgroup>

                        <optgroup>
                        <option value="" disabled class="fw-bold text-black">Property Crimes</option>
                        
                        <option value="Burglary">Burglary</option>
                        <option value="Larceny">Larceny</option>
                        <option value="Arson">Arson</option>
                        <option value="Grand theft">Grand theft</option>
                        <option value="Identity theft">Identify theft</option>
                        
                        </optgroup>

                        <optgroup>
                        <option value="" disabled class="fw-bold text-black">Financial Crimes</option>
                        
                        <option value="Fraud">Fraud</option>
                        <option value="Embezzlement">Embezzlement</option>
                        <option value="Money laundering">Money laundering</option>
                        <option value="Tax evasion">Tax evasion</option>
                       
                        </optgroup>

                        <optgroup>
                        <option value="" disabled class="fw-bold text-black">Public Order Crimes</option>
                        
                        <option value="Inciting a riot">Inciting a riot</option>
                        <option value="Disturbing the peace">Disturbing the peace</option>
                        
                        </optgroup>

                        <optgroup>
                        <option value="" disabled class="fw-bold text-black">Sex Crimes</option>
                        
                        <option value="Rape">Rape</option>
                        <option value="Sexual harassment">Sexual harassment</option>
                        <option value="Child molestation">Child molestation</option>
                        <option value="Human traficking">Human traficking</option>
                       
                        </optgroup>

                        <optgroup>
                        <option value="" disabled class="fw-bold text-black">Terrorism</option>
                        
                        <option value="Acts of terrorism">Acts of terrorism</option>
                        <option value="Conspiracy to commit terrorism">Conspiracy to commit terrorism</option>
                        <option  value="Providing material support to terrorists">Providing material support to terrorists</option>
                       
                        </optgroup>

                    <optgroup>
                        
                        <option value="" disabled class="fw-bold fs-4">MISDEMEANOR CATEGORY</option>
                        <option value="" disabled class="text-danger">Selected crimes under this category are below 3 years and above 6 months punishable</option>
                    
                        
                        <option value="Disorderly conduct">Disorderly conduct</option>
                        <option value="Petty theft">Petty theft</option>
                        
                        <option value="Fraud">Shoplifting</option>
                        <option value="Vandalism">Vandalism</option>
                        <option value="Assault and battery">Assault and battery</option>
                        <option value="Possesion of a controlled substace">Possesion of a controlled substace</option>
                        
                        <option value="Trespassing">Trespassing</option>
                        <option value="Harassment">Harassment</option>
                        <option value="Public intoxication">Public intoxication</option>
                        
                        </optgroup>

                    <optgroup>

                        <option value="" disabled class="fw-bold fs-4">SIMPLE OFFENSES</option>
                        <option value="" disabled class="text-danger">Selected crimes under this category are below 6 punishable</option>
                    
                        
                        <option value="Littering">Littering</option>
                        <option value="Jaywalking">Jaywalking</option>
                        <option value="Dog-walking">Dog-walking</option>
                        <option value="Minor in possesion of alcohol">Minor in possesion of alcohol</option>
                        <option value="Curfew violation">Curfew violation</option>
                        
                        <option value="Public urination">Public urination</option>
                        <option value="Open container violation">Open container violation</option>
                        
                        
                        </optgroup>
                        

                </select>
                <br>
                <!-- <label for="description" class="text-light">Detailed description</label> -->
                <textarea name="description" id="" cols="20" rows="8" placeholder="Detailed description (Maximum of 250 words)" class="form-control placeholder-wave form-control-lg"><?php echo $description ?></textarea>
                
                    <br>
                    <!-- <label for="date" class="text-light">Date of occurence</label> -->
                    <input type="date" class="form-control form-control-lg placeholder-wave" name="crimeDate" value="<?php echo $crimeDate ?>">
                <br>
                <!-- <input type="hidden" name="reporter" value=""> -->
                
                <input type="submit" name="submit" class="btn btn w-100 text-light btn-submit p-3">

                
            </form>


</div>
            
                </div>
                <div class="col-md-3"></div>
            </div>
           
        </div>

    
</body>
</html>
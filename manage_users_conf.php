<?php  
//Connect to database
require'connectDB.php';

// select passenger 
if (isset($_GET['select'])) {

    $Finger_id = $_GET['Finger_id'];

    $sql = "SELECT fingerprint_select FROM users WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            $sql="UPDATE users SET fingerprint_select=0";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error_Select";
                exit();
            }
            else{
                mysqli_stmt_execute($result);

                $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_select_Fingerprint";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $Finger_id);
                    mysqli_stmt_execute($result);

                    echo "Empreinte selectionée";
                    exit();
                }
            }
        }
        else{
            $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error_select_Fingerprint";
                exit();
            }
            else{
                mysqli_stmt_bind_param($result, "s", $Finger_id);
                mysqli_stmt_execute($result);

                echo "Empreinte séléctionnée";
                exit();
            }
        }
    } 
}
if (isset($_POST['Add'])) {
     
    $Uname = $_POST['name'];
    $Number = $_POST['number'];
    $Email= $_POST['email'];

    //optional
    $Timein = $_POST['timein'];
    $Gender= $_POST['gender'];

    //check if there any selected user
    $sql = "SELECT username FROM users WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
      echo "SQL_Error";
      exit();
    }
    else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            if ($row['username']=="Name") {

                if (!empty($Uname) && !empty($Number) && !empty($Email)) {
                    //check if there any user had already the Serial Number
                    $sql = "SELECT serialnumber FROM users WHERE serialnumber=?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "d", $Number);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {
                            $sql="UPDATE users SET username=?, serialnumber=?, gender=?, email=?, user_date=CURDATE(), time_in=? WHERE fingerprint_select=1";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_select_Fingerprint";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "sdsss", $Uname, $Number, $Gender, $Email, $Timein );
                                mysqli_stmt_execute($result);

                                echo "Vous avez ajouter un nouveau utilisateur!";
                                exit();
                            }
                        }
                        else {
                            echo "Le numéro de série est déja pris!";
                            exit();
                        }
                    }
                }
                else{
                    echo "Champs vide";
                    exit();
                }
            }
            else{
                echo "L'empreinte est déja ajoutée";
                exit();
            }    
        }
        else {
            echo "Veuillez séléctionner un numéro d'empreinte!";
            exit();
        }
    }
}
//Add user Fingerprint
if (isset($_POST['Add_fingerID'])) {

    $fingerid = $_POST['fingerid'];

    $Uname = "Name";
    $Number = "000000";
    $Email= "Email";

    //optional
    $Timein = "00:00:00";
    $Gender= "Gender";

    if ($fingerid == 0) {
        echo "Donner un numéro d'empreinte!";
        exit();
    }
    else{
        if ($fingerid > 0 && $fingerid < 128) {
            $sql = "SELECT fingerprint_id FROM users WHERE fingerprint_id=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
              echo "SQL_Error";
              exit();
            }
            else{
                mysqli_stmt_bind_param($result, "i", $fingerid );
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
                if (!$row = mysqli_fetch_assoc($resultl)) {

                    $sql = "SELECT add_fingerid FROM users WHERE add_fingerid=1";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                      echo "SQL_Error";
                      exit();
                    }
                    else{
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {
                            //check if there any selected user
                            $sql="UPDATE users SET fingerprint_select=0 WHERE fingerprint_select=1";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                              echo "SQL_Error";
                              exit();
                            }
                            else{
                                mysqli_stmt_execute($result);
                                $sql = "INSERT INTO users ( username, serialnumber, gender, email, fingerprint_id, fingerprint_select, user_date, time_in, del_fingerid , add_fingerid) VALUES (?, ?, ?, ?, ?, 1, CURDATE(), ?, 0, 1)";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                  echo "SQL_Error";
                                  exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "sdssis", $Uname, $Number, $Gender, $Email, $fingerid, $Timein );
                                    mysqli_stmt_execute($result);
                                    echo "Vous pouvez associer ce numéro à une empreinte";
                                    exit();
                                }
                            }
                        }
                        else{
                            echo "Vous ne pouvez pas ajouter deux numéros à la fois";
                        }
                    }   
                }
                else{
                    echo "Ce numero existe déja ! Supprimer le d'abord";
                    exit();
                }
            }
        }
        else{
            echo "Veuillez choisir un bon numéro";
            exit();
        }
    }
}
// Update an existance user 
if (isset($_POST['Update'])) {

    $Uname = $_POST['name'];
    $Number = $_POST['number'];
    $Email= $_POST['email'];

    //optional
    $Timein = $_POST['timein'];
    $Gender= $_POST['gender'];

    if ($Number == 0) {
        $Number = -1;
    }
    //check if there any selected user
    $sql = "SELECT * FROM users WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
      echo "SQL_Error";
      exit();
    }
    else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            if (empty($row['username'])) {
                echo "Ajouter d'abord le Username!";
                exit();
            }
            else{
                if (empty($Uname) && empty($Number) && empty($Email) && empty($Timein)) {
                    echo "Veuillez remplir les champs c'est obligatoires";
                    exit();
                }
                else{
                    //check if there any user had already the Serial Number
                    $sql = "SELECT serialnumber FROM users WHERE serialnumber=?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "d", $Number);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {

                            if (!empty($Uname) && !empty($Email) && !empty($Timein)) {

                                $sql="UPDATE users SET username=?, serialnumber=?, gender=?, email=?, time_in=? WHERE fingerprint_select=1";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_select_Fingerprint";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "sdsss", $Uname, $Number, $Gender, $Email, $Timein );
                                    mysqli_stmt_execute($result);

                                    echo "Vous avez modifier les informations de l'utilisateur!";
                                    exit();
                                }
                            }
                            else{
                                if (!empty($Timein)) {
                                    $sql="UPDATE users SET gender=?, time_in=? WHERE fingerprint_select=1";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_select_Fingerprint";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "ss", $Gender, $Timein );
                                        mysqli_stmt_execute($result);

                                        echo "Vous avez modifier les informations de l'utilisateur!";
                                        exit();
                                    }
                                }
                                else{
                                    echo "The User Time-In est vide!";
                                    exit();
                                }    
                            }  
                        }
                        else {
                            echo "Le numéro de série existe déja!";
                            exit();
                        }
                    }
                }
            }    
        }
        else {
            echo "sélectionner l'utilisateur pour modifier ses informations!";
            exit();
        }
    }
}
// delete user 
if (isset($_POST['delete'])) {

    $sql = "SELECT fingerprint_select FROM users WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {
            $sql="UPDATE users SET del_fingerid=1 WHERE fingerprint_select=1";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error_delete";
                exit();
            }
            else{
                mysqli_stmt_execute($result);
                echo "L'empreinte est supprimée avec succés";
                exit();
            }
        }
        else{
            echo "Veuillez selectionner un utilisateur à supprimer";
            exit();
        }
    }
}
mysqli_stmt_close($result);
mysqli_close($conn);
?>

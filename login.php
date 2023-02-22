<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    print "ok";
    exit;
}

$json=isset($_POST["kirjautuminen"]) ? $_POST["kirjautuminen"] : "";

if (!($kirjautuminen=tarkistaJson($json))){
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys=mysqli_connect("localhost", "trtkp22a3", "trtkp22816", "trtkp22a3");
}
catch(Exception $e){ 
    print "Connection error";
    exit;
}
    // Prepare a select statement
    $sql = "select id, password from team1_kayttajat where username = ?";
    
    $stmt = mysqli_prepare($yhteys, $sql);
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $kirjautuminen->username);
    //Suoritetaan sql-lause
    mysqli_stmt_execute($stmt);
    // Store the result so we can check if the account exists in the database.
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if ($kirjautuminen->password === $password) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $kirjautuminen->username;
            $_SESSION['id'] = $id;
            // header("location:welcome.php");
            // echo 'Welcome ' . $_SESSION['name'] . '!';
        } else {
            // Incorrect password
            echo 'Incorrect password!';
            exit;
        }
    } else {
        // Incorrect username
        echo 'Incorrect username!';
        exit;
    }

    // Close connection
    mysqli_close($yhteys);
    print "ok";
    exit;
?>

<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }
    $kirjautuminen=json_decode($json, false);
    if (empty($kirjautuminen->username) || empty($kirjautuminen->password)){
        print"Fill in all fields";
        return false;
    }
   
    return $kirjautuminen;
}
?>
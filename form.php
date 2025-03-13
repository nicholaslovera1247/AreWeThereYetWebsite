<?php
include 'top.php';



$dataIsGood = false;
$errorMessage = '';
$message = '';

$firstName = '';
$lastName = '';
$email = '';
$forestPark = 1;
$oceanPark = 0;
$desertPark = 0;
$natOpinion = '';



function getData($field){
    if (!isset($_POST[$field])){
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data);
    }
    return $data;

}

function verifyAlphaNum($testString){
    return (preg_match ("/^([[:alnum:]]|-|\.| |\'|&|;|#)+$/", $testString));
}


if($_SERVER["REQUEST_METHOD"] == 'POST'){

    print PHP_EOL . '<!-- Starting Sanitization-->'. PHP_EOL;

}

$firstName = getData('txtFirstName');
$lastName = getData('txtLastName');
$email = getData('txtEmail');
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$forestPark = (int) getData('chkForest');
$oceanPark = (int) getData ('chkOcean');
$desertPark = (int) getData ('chkDesert');
$natOpinion = getData('radOpinion');

print PHP_EOL . '<!-- Starting Validation -->'. PHP_EOL;
$dataIsGood = true;

if ($firstName == ''){
    $errorMessage .= '<p class="mistake">Please enter first name</p>';
    $dataIsGood = false;
} elseif(!verifyAlphaNum ($firstName)) {
    $errorMessage .= '<p class="mistake"> Invalid Characters, please only use letters</p>';
    $dataIsGood = false;
}

if ($lastName == ''){
    $errorMessage .= '<p class="mistake">Please enter last name</p>';
    $dataIsGood = false;
} elseif(!verifyAlphaNum ($lastName)) {
    $errorMessage .= '<p class="mistake"> Invalid Characters, please only use letters</p>';
    $dataIsGood = false;
}

if ($email == ''){
    $errorMessage .= '<p class="mistake">Please enter your email</p>';
    $dataIsGood = false;
} elseif(!filter_var ($email, FILTER_VALIDATE_EMAIL)) {
    $errorMessage .= '<p class="mistake"> Invalid Characters detected. Please enter email</p>';
    $dataIsGood = false;
}

$totalChecked = 0;
if($forestPark != 1) $forestPark = 0;
$totalChecked += $forestPark;

if($oceanPark != 1) $oceanPark = 0;
$totalChecked += $oceanPark;

if($desertPark != 1) $desertPark = 0;
$totalChecked += $desertPark;

if($totalChecked == 0){
    $errorMessage .= '<p class="mistake"> Please choose one national park terrain</p>';
    $dataIsGood = false;
}
if ($natOpinion != "Awesome" AND $natOpinion != "NTA" AND $natOpinion != "Dislike"){
    $errorMessage .= '<p class="mistake"> Please tell us your opinion on National Parks.</p>';
    $dataIsGood = false;
}

print '<!-- Starting Saving -->';

if ($dataIsGood){
    $sql = 'INSERT INTO tblNationalParkSurvey (fldFirstName,fldLastName,fldEmail,fldForest,fldOcean,fldDesert,fldOpinion)';
    $sql .= ' VALUES (?, ?, ?, ?, ?, ?, ?) ';
    $data = array($firstName, $lastName, $email, $forestPark, $oceanPark, $desertPark, $natOpinion);


    try{
        $statement = $pdo->prepare($sql);
        if ($statement->execute($data)){
            $message .='<p> Your survey was successfully saved! </p>';

            $to = $email;
            $from = 'CS1080 <nlovera@uvm.edu>';
            $subject = 'Are We There Yet? Survey';

            $mailMessage = '<p style = "font: 12pt serif;">Thank you for taking our survery!</p>';
            $mailMessage .= '<p> Happy Hiking!</p>';

            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type:text/html; charset=utf-8\r\n";
            $headers .= "From: " . $from . "\r\n";

            $mailSent = mail($to, $subject, $mailMessage, $headers);


        } else {
            $message .= '<p> Your survey was NOT saved. Please try again. </p>';
            $dataIsGood = false;
        }
    } catch (PDOException $e){
        $message .= '<p>Unknown error, could not save entry please contact someone</p>';
    }

}

?>


<!--     ###########################################  -->
    <main>
        <section class = "form-picture">
            <h2>Where Do You Want To Go?</h2>
            <figure>
                <img alt="Survey" src="https://media.tenor.com/mOjDrii-5ccAAAAC/road-trip.gif">
                <figcaption> <a href="https://tenor.com/view/road-trip-car-drive-gif-10060643"><cite>Roadtrip! : Tenor</cite></a></figcaption>
            </figure>
        </section>
        <section class = "form">
            <figure>
                <h2>Thank you!</h2>
                <?php
                print $message;
                print $errorMessage;
                if ($mailSent){
                    print "<p>An email has been sent to</p>" . $email . "<p>for submission confirmation</p>";
                    print $mailMessage;
                }
                ?>
            </figure>
            <form action="#" method="POST">
                <fieldset>
                    <legend>Contact Information</legend>
                    <p>
                        <label for="txtFirstName">First Name</label>
                        <input type="text" name="txtFirstName" id="txtFirstName" placeholder="Enter your first name"
                        value = "<?php if (isset($_POST['txtFirstName'])) {echo $_POST['txtFirstName'];}?>" required>
                    </p>
                    <p>
                        <label for="txtLastName">Last Name</label>
                        <input type="text" name="txtLastName" id="txtLastName" placeholder="Enter your last name"
                        value = "<?php if (isset($_POST['txtLastName'])) {echo $_POST['txtLastName'];}?>" required>
                    </p>
                    <p>
                        <label for="txtEmail">Email</label>
                        <input type="text" name="txtEmail" id="txtEmail" placeholder="your-email@gmail.com"
                        value = "<?php if (isset($_POST['txtEmail'])) {echo $_POST['txtEmail'];}?>" required>
                    </p>
                </fieldset>
                <fieldset>
                    <legend>What Type Of National Parks Do You Want To See?</legend>
                    <p>
                        <label for="chkForest">Forest</label>
                        <input type="checkbox" name="chkForest" id="chkForest" value="1"
                        <?php if (isset($_POST['chkForest'])) {echo "input type='checkbox' name='chkForest' id='chkForest' value='1' checked = 'checked'";}?> 
                        >
                    </p>
                        
                    <p>
                        <label for="chkOcean">Ocean</label>
                        <input type="checkbox" name="chkOcean" id="chkOcean" value="1"
                        <?php if (isset($_POST['chkOcean'])) {echo "input type='checkbox' name='chkOcean' id='chkOcean' value='1' checked = 'checked'";}?>>
                    </p>

                    <p>
                        <label for="chkDesert">Desert</label>
                        <input type="checkbox" name="chkDesert" id="chkDesert" value="1"
                        <?php if (isset($_POST['chkDesert'])) {echo "input type='checkbox' name='chkDesert' id='chkDesert' value='1' checked = 'checked'";}?>>
                    </p>
                </fieldset>

                <fieldset>
                    <legend>What Do You Think Of National Parks?</legend>
                    <p>
                        <label for="radAwesome">They're Awesome</label>
                        <input type="radio" name="radOpinion" id="radAwesome" value="Awesome"
                        <?php if (isset($_POST['radOpinion']) && $_POST['radOpinion'] == "Awesome") {echo "<input type='radio' name='radOpinion' id='radAwesome' value='Awesome'checked = 'checked'";}?> required>
                    </p>

                    <p>
                        <label for="radNTA">Never Thought About</label>
                        <input type="radio" name="radOpinion" id="radNTA" value="NTA"
                        <?php if (isset($_POST['radOpinion']) && $_POST['radOpinion'] == "NTA") {echo "<input type='radio' name='radOpinion' id='radNTA' value='NTA'checked = 'checked'";}?> required>
                    </p>

                    <p>
                        <label for="radDislike">Dislike</label>
                        <input type="radio" name="radOpinion" id="radDislike" value="Dislike"
                        <?php if (isset($_POST['radOpinion'])&& $_POST['radOpinion'] == "Dislike") {echo "<input type='radio' name='radOpinion' id='radDislike' value='Dislike'checked = 'checked'";}?> required>
                    </p>
                </fieldset>

                <fieldset class = "button">
                    <p>
                        <input type="submit" value="Submit">
                    </p>
                </fieldset>
            </form>
        </section>
    </main>
    <?php include 'footer.php'; ?>
</html>
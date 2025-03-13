<?php
include 'top.php';
?>
<main>
<pre>
CREATE TABLE tblNationalParks(
    pmkNationalParksId INT AUTO_INCREMENT PRIMARY KEY,
    fldPark VARCHAR(40),
    fldState VARCHAR(200),
    fldAcres VARCHAR(200),
    fldTerrain VARCHAR(200),
    fldFee VARCHAR(200)
)
</pre>

<pre>
INSERT INTO tblNationalParks(fldPark,fldYear,fldState,fldAcres,fldTerrain) 
VALUES ('Acadia','1919','Maine','50,000','Forest:Ocean'),
('Zion','1919','Utah','148,733','Desert'),
('Glacier','1910','Montana','1.033M','Forest'),
('Gates Of The Arctic', '1980','Alaska','8.5M','Forest:Snow'),
('Rocky Mountains','1915','Colorado','265,807','Forest')
</pre>

<pre>
$sql = 'SELECT fldPark, fldYear, fldState, fldAcres, fldTerrain FROM tblNationalParks';
$statement = $pdo->prepare($sql);
$statement->execute();
</pre>

<pre>
CREATE TABLE tblNationalParkSurvey(
    pmkNationalParkSurvey int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fldFirstName VARCHAR(30) DEFAULT NULL,
    fldLastName VARCHAR(30) DEFAULT NULL,
    fldEmail VARCHAR(50) DEFAULT NULL,
    fldForest TINYINT(1) DEFAULT 0,
    fldOcean TINYINT(1) DEFAULT 0,
    fldDesert TINYINT(1) DEFAULT 0,
    fldOpinion VARCHAR(24) DEFAULT NULL
)
</pre>

<pre>
$sql = 'INSERT INTO tblNationalParkSurvey (fldFirstName,fldLastName,fldEmail,fldForest,fldOcean,fldDesert,fldOpinion)';
$sql .= ' VALUES (?, ?, ?, ?, ?, ?, ?) ';
$data = array($firstName, $lastName, $email, $forestPark, $oceanPark, $desertPark, $natOpinion);
</pre>

</main>
<?php include 'footer.php'; ?>
</body>
</html>
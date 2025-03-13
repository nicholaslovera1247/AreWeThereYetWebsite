<?php
include 'top.php';
?>
<!--     ###########################################  -->
<main>
    <section class = "Index-One">
        <h2>Our National Park Journey</h2>
        <figure class = "Photos">
            <figure class = "POne">
                <img alt = "Bar-Harbor" src = "images/barharbor.png" height="300" width="300">
                <figcaption>Bar Harbor</figcaption>
            </figure>
            <figure class = "PTwo">
                <img src="images/mainecliff.png" alt="Maine-Cliff" height="300" width="300">
                <figcaption>Maine Cliff</figcaption>
            </figure>
            <figure class = "PThree">
                <img src="images/maineshore.png" alt="Maine-Shore" height="300" width="300">
                <figcaption>Maine Shore</figcaption>
            </figure>
        </figure>
    </section>

    <section class = "IndexTwo">
        <figure class = "IndexTwoText">
            <h3>How We Started</h3>
            <p>
                Me and my girlfriend of 3 years have always mentioned going to<br>
                a National Park for a summer trip for a while, and this past<br>
                summer we finally did it. We went to Acadia National Park<br>
                in Maine. It was beautiful, breathtaking, and overall just a<br>
                great trip. Besides the untouched natural beauty that the park<br>
                presents, the area was also beautiful, with a cute little<br>
                classic New England town, Bar Harbour, right outside the park.<br>
                This trip made me and her make visiting every National Park,<br>
                taking pictures, and buying memorabilia to check it off our list.<br>
            </p>
        </figure>
        <figure>
            <img src="https://morethanjustparks.com/wp-content/uploads/2021/10/national-parks-map-corrected2.jpg" alt="National Park Map" height = "300" width = "500">
            <figcaption><a href = "https://morethanjustparks.com/list-of-national-parks-by-state/"><cite>More Than Just Parks</cite></a></figcaption>
        </figure>
    </section>

    <section class = "IndexThree">
        <figure class = "IndexThreeText">
            <h3>What Is This Website?</h3>
            <p>
                This website serves as sort of a photo gallery of sorts<br>
                for our trips. Every new park we visit, I will update this<br>
                website with photos, information, and things to do outside<br>
                of the park itself (you can only hike for so long). This is<br>
                not only a personal website for my trips, but also a guide for<br>
                those who want to join in on this adventure with us. On our<br>
                trip info page, we will constantly update it with surronding<br>
                entertainment, hotels, places to eat, and of course the price<br>
                of the trip itself, which may vary depending on where you live,<br>
                for example someone who lives in Bar Harbour, Maine, a trip to<br>
                Acadia would cost maximum $30 because of the non-need for a<br>
                hotel, food, etc. We hope you enjoy our pictues and in-awe<br>
                speeches on how the world is beautiful and how everyone needs<br>
                to see a National Park. On the other pages of this website there<br>
                is some information on the most popular National Parks, our<br>
                gallery, a survey you can take and tell us where you want to<br>
                go (or have been) Below you will find a table detailing 5 of <br>
                my personal favorite National, along with their year founded,<br>
                and the total size they are in acres. Enjoy!
            </p>
        </figure>
        <figure>
            <img src="https://i.pinimg.com/originals/74/1f/9b/741f9b93a2758dcbd6d609136565f9f0.gif" alt="Mountain Clouds GIF">
            <figure><a href="https://www.pinterest.com/pin/parque-nacional-yellowstone--847873067320980855/"><cite>Pinterest: Yellowstone</cite></a></figure>
        </figure>
    </section>

    <section class = "table">
        <h2>My Favorite National Parks (Where I Want To Go)</h2>
        <table class = "actualTable">
            <tr>
                <th>Park</th>
                <th>Year Found</th>
                <th>State Located In</th>
                <th>Size In Acres</th>
                <th>Terrain Of Park</th>
            </tr>
<?php
$sql = 'SELECT fldPark, fldYear, fldState, fldAcres, fldTerrain FROM tblNationalParks';
$statement = $pdo->prepare($sql);
$statement->execute();

$records = $statement->fetchAll();
foreach($records as $record){
    print '<tr>';
    print '<td>' . $record['fldPark'] . '</td>';
    print '<td>' . $record['fldYear'] . '</td>';
    print '<td>' . $record['fldState'] . '</td>';
    print '<td>' . $record['fldAcres'] . '</td>';
    print '<td>' . $record['fldTerrain'] . '</td>';
    print '</tr>' . PHP_EOL;
}
?>
            <tr>
                <td colspan="5">Source Cited: <a href="https://www.nps.gov/index.htm">National Park Service</a></td>
            </tr>
        </table>
    </section>
</main>
<?php include 'footer.php'; ?>
</html>
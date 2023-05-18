<footer>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-2 col-6 col-sm-6 mt-4">
                <span><u>Know Us</u></span><br>
                <a href="about.php">About Us</></a><br>
                <a href="contact.php">Contact Us</a><br>
                <span><u>Our Policies</u></span><br>
                <a href="TAC.php">Terms and Conditions</a><br>
                <a href="return.php">Return Policy</a><br>
                <a href="privacy.php">Privacy Policy</a><br>
            </div>

            <div class="col-md-4 col-6 col-sm-6 mt-4">
                <?php $specialities = speciality_select_all(); ?>

                <span><u>Our Services</u></span><br>
                <a href="consult.php">Online Doctor Consultation</a><br>
                <?php while ($speciality = mysqli_fetch_assoc($specialities)) { ?>
                    <a href="list_of_doctors.php?id=<?php echo $speciality['id']; ?>">Consult <?php echo $speciality['name']; ?></a><br>

                <?php } ?>
            </div>

            <div class="col-md-4 col-6 col-sm-6 mt-4">
                <?php $tests = labtest_select_all(); ?>
                <span><u>Book Lab Tests At Home</u></span><br>
                <?php while ($test = mysqli_fetch_assoc($tests)) { ?>
                    <a href="labtest-details.php?id=<?php echo $test['id']; ?>"><?php echo $test['name']; ?></a><br>

                <?php } ?>
            </div>

            <div class="col-md-2 col-6 col-sm-6 mt-4">
                <?php $categories = find_all_category(); ?>
                <span><u>Product Categories</u></span><br>
                <?php while ($category = mysqli_fetch_assoc($categories)) { ?>
                    <a href="index.php?cat_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a><br>

                <?php } ?>
            </div>



        </div>
        <hr>
        <div class="row">
            <div class=" col-sm-4 mx-auto">
                <div class="row">
                    <div class="col-sm-2 col-2">
                        <span class="fs-1 pt-2"><i class="fas fa-clipboard-check"></i></span>
                    </div>
                    <div class="col-sm-10 col-10">
                        <span class="fs-5">Reliable</span><br>
                        <p style="text-align:justify;font-size:13px;">All products displayed on TRUST CARE are procured from verified and licensed pharmacies. All lab tests listed on the platform are accredited.</p>
                    </div>
                </div>
            </div>

            <div class=" col-sm-4 mx-auto">
                <div class="row">
                    <div class="col-sm-2 col-2">
                        <span class="fs-1 pt-2 "><i class="fas fa-user-shield"></i></span>
                    </div>
                    <div class=" col-sm-10 col-10">
                        <span class="fs-5">Secure</span><br>
                        <p style="text-align:justify;font-size:13px;">TRUST CARE uses Secure Sockets Layer (SSL) 128-bit encryption.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4  mx-auto">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-2">
                        <span class="fs-1 pt-2 "><i class="fas fa-wallet"></i></span>
                    </div>
                    <div class="col-md-10 col-sm-10 col-10">
                        <span class="fs-5">Affordable</span><br>
                        <p style="text-align:justify;font-size:13px;">Find affordable medicine substitutes, save up to 10%-15% on health products, up to 20% off on lab tests and doctor consultations.</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p style="text-align:center;">© 2023 TRUST CARE. All rights reserved. All medicines are dispensed in compliance with the Drugs and Cosmetics Act, 1940 and Drugs and Cosmetics Rules, 1945. We do not process requests for Schedule X and habit forming drugs.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/custom.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#search").keyup(function() {
            var input = $(this).val();
            //alert(input);
            if (input != "") {
                $.ajax({
                    type: 'POST',
                    url: 'ajax.php',
                    data: {input:input},
                    success: function(html) {
                        $("#searchresult").html(html);

                    }
                });
            }else
            {
                $("searchresult").css("display","none");
            }
        })
    })
</script>
</body>

</html>
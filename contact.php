<?php require_once("header.php"); ?>
<div class="container px-4 mt-2" >
<div class="row">
        <div class="col-md-8 col-sm-8 col-12 px-5" style="box-sizing:border-box;background-color:#f5f5f5;">
            <p class="mt-3 " style="font-size:18px;">CONTACT US</p>
            <p >Have a Query ? No worry just send message from the below form and we will reply to your question within 24 hours</p>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="contact-exec.php" method="post">
                        <div class="row mt-2">
                            <div class="col-md-7 col-7">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Name">
                                    <label for="floatingInput">Name</label>
                                </div>
                            </div>
                            <div class="col-md-5 col-5 mb-3">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="floatingPassword" name="phone" placeholder="Phone Number">
                                    <label for="floatingPassword">Phone Number</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" name="email" placeholder="Enter your email">
                                    <label for="floatingInput">Email</label>
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave your Query here" name="query" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2"> &nbsp;&nbsp;&nbsp;Query</label>
                            </div>
                        </div>
                        <div class="row mt-2">
                        <div class="mx-auto col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-success " name="submit" style="padding-left:50px;padding-right:50px;"><strong>Submit</strong></button>
                        </div>
                      </div>
                       
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="row d-flex mt-5">
            <img src="assets/images/contactus1.png" class="card-img-top mx-auto d-block w-100" alt="..." style="height:300px;">
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                    <i class="fas fa-pencil-alt"></i> <span><b>Mail us at:</b>&nbsp;&nbsp;trust_care@gmail.com</span>
                    </div>
                </div>
                </div>
            </div>
       
        </div>
    </div>
</div>

<?php require_once("footer.php"); ?>
<?php require_once("includes/initialize.php"); ?>
<?php require_login(); ?>
<?php $page = "state-add-exec.php"; ?>
<?php $page_title = 'Add state';  ?>
<?php require_once("header.php"); ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo $page_title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Add new state</li>
        </ol>
        <?php echo display_errors($errors); ?>
        <?php echo display_session_message(); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-check-circle me-1"></i>
                        Add New state
                    </div>
                    <div class="card-body">
                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">


                            <input type="hidden" name="MAX_FILE_SIZE" value="188743680" />

                            <div class="row">

                                <div class="col-xl-6 offset-xl-2">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>

                                    <div class="form-floating">
                                        <select name="country_id" class="form-select" id="country_id">
                                            <option value="0">Country Name</option>
                                            <?php
                                            $result_set = country_select();
                                            while ($result = mysqli_fetch_array($result_set)) { ?>
                                                <option value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>

                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                    <button type="reset" class="btn btn-danger" name="reset">Reset</button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
</main>
<?php require_once("footer.php"); ?>
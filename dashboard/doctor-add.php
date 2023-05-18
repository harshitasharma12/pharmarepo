<?php require_once("includes/initialize.php"); ?>
<?php $page = "doctor-add-exec.php"; ?>
<?php $page_title = 'Doctor';  ?>
<?php require_once("header.php"); ?>
<?php
$name = "";
$speciality_id = "";
$field_of_expertise="";
$working_as = "";
$pay_price = "";
$education = "";
$experience = "";
$currently_working_in = "";
$awards="";
$email = "";
$password = "";
$action = "Add";
$id = 0;
if (isset($_POST['updatesubmit'])) {
    $id = $_POST['id'];
    $doctor = doctor_select_by_id($id);
    if (is_array($doctor)) {
        $name = $doctor['name'];
        $speciality_id  = $doctor['speciality_id'];
        $field_of_expertise  = $doctor['field_of_expertise'];
        $working_as = $doctor['working_as'];
        $pay_price = $doctor['pay_price'];
        $education = $doctor['education'];
        $experience = $doctor['experience'];
        $currently_working_in = $doctor['currently_working_in'];
        $awards = $doctor['awards'];
        $email = $doctor['email'];
        // $password = $doctor['password'];
        $id = $doctor['id'];
        $action = "update";
    }
}
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?php echo $action . "Doctors"; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><?php echo $action; ?> New Doctors</li>
        </ol>
        <?php echo display_errors($errors); ?>
        <?php echo display_session_message(); ?>
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fab fa-bimobject me-1"></i>
                        <?php echo $action; ?>
                    </div>
                    <div class="card-body">
                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="action" value="<?php echo $action; ?>" />

                            <div class="row">

                                <div class="col-xl-6 offset-xl-2">

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Doctors Name:</label>
                                        <input type="text" class="form-control" id="name" name="name" required value="<?php echo $name; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="floatingSelect">Speciality Name</label>
                                        <select name="speciality_id" class="form-select" id="speciality_id">
                                            <option value="0">--Select--</option>
                                            <?php

                                            $result_set = speciality_select_all();
                                            while ($result = mysqli_fetch_array($result_set)) { ?>
                                                <option value="<?php echo $result['id']; ?>" <?php if ($result['id'] == $speciality_id) echo "selected"; ?>><?php echo $result['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Field of Expertise</label>
                                        <textarea name="field_of_expertise" id="field_of_expertise" cols="30" rows="10" class="form-control"><?php echo trim($field_of_expertise); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Working As</label>
                                        <input type="text" class="form-control" id="working_as" name="working_as" required value="<?php echo $working_as; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Pay Price</label>
                                        <input type="text" class="form-control" id="pay_price" name="pay_price" required value="<?php echo $pay_price; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Education</label>
                                        <textarea name="education" id="doctor_education" cols="30" rows="10" class="form-control"><?php echo trim($education); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Experience</label>
                                        <textarea name="experience" id="doctor_experience" cols="30" rows="10" class="form-control"><?php echo trim($experience); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Currently working in</label>
                                        <input type="text" class="form-control" id="currently_working_in" name="currently_working_in" required value="<?php echo $currently_working_in; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Awards</label>
                                        <textarea name="awards" id="doctor_awards" cols="30" rows="10" class="form-control"><?php echo trim($awards); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Choose File</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required value="<?php echo $email; ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Password</label>
                                        <input type="text" class="form-control" id="password" name="password" required >
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
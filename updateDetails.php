<?php  
include("includes/includedFiles.php");
?>
<div class="container">
    <div class="row">

        <div class="col-md-2"></div>

        <div class="col-md-8">
            <div class="userDetails">

                <div class="box">
                    <h2 class='EmailSetTitle'>Email</h2>
                    <div class="form-group">
                    <input type="text" class="email form-control" name="email" placeholder="Email Address." value="<?php echo $userLoggedIn->getEmail(); ?>">
                    <span class="message"></span>
                    <button class="btn btn-primary button emailChangeBtn" onclick="updateEmail('email')">Update Email</button>
                    </div>
                </div>

                <div class="box">
                    <h2>Password</h2>
                    <div class="form-group">
                    <input type="password" class="oldPassword form-control passwordStyle" name="OldPassword" placeholder="Current Password">
                    <input type="password" class="newPassword1 form-control passwordStyle" name="newPassword1" placeholder="New Password">
                    <input type="password" class="newPassword2 form-control passwordStyle" name="newPassword2" placeholder="Confirm New Password">
                    <span class="message"></span>
                    <button class="btn btn-primary button passwordChangeBtn"  onclick="updatePassword('oldPassword', 'newPassword1', 'newPassword2')">Update Password</button>
                    </div>
                </div>

            </div> <!--End of userDetails-->
        </div> <!--End of col-12-->
        <div class="col-md-2"></div>
    </div> <!--End of row-->
</div> <!--End of container-->

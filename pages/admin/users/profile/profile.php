<?php
	use \FSM\Model\user;
	
	$this->title = "User Profile";
	$this->page = 'profile';
	$this->template('cms','top');
	
	$user = new user($_SESSION['login']['person_id']);
?>
	<h1 class="page-header"><?=$this->title?></h1>
    <div id="register">
        <form class="form-profile">
	        <input type="hidden" name="admin_ide" value="<?=$user->ide?>">
            <input type="hidden" name="full_name" value="<?=$user->person->full_name?>">
            
            <label for="inputFirst">First Name</label>
            <input type="text" id="inputFirst" name="fname" class="form-control" placeholder="First Name" required value="<?=$user->person->fname?>">
            
            <label for="inputLast">Last Name</label>
            <input type="text" id="inputLast" name="lname" class="form-control" placeholder="Last Name" required value="<?=$user->person->lname?>">
            
            <label for="inputEmail">Email Address</label>
            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email address" required value="<?=$user->person->email?>">
            
            <label for="inputUsername">Username</label>
            <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required value="<?=$user->person->username?>">
            
            <label for="inputAccessGroup">Aceess Group</label>
            <input type="text" id="inputAccessGroup" name="access_group" class="form-control" placeholder="Access Group" required value="<?=$user->access_group?>">
            
            <a class="change-pw">Change Password</a>
            
            <div class="tempHide" id="pw-fields">
            	<label for="inputPasswordOld">Old Password</label>
                <input type="password" id="inputPasswordOld" name="old-password" class="form-control" placeholder="Old Password" disabled>
                
                <label for="inputPassword1">New Password</label>
                <input type="password" id="inputPassword1" name="password1" class="form-control" placeholder="New Password" disabled>
                
                <label for="inputPassword2">Password</label>
                <input type="password" id="inputPassword2" name="password2" class="form-control" placeholder="Re-Enter Password" disabled>
            </div>
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Update Profile</button>
            <div id="message"></div>
        </form>
    </div>        
<?	
	$this->template('cms','bottom');
?>
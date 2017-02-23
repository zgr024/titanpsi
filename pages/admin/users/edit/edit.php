<?php
	use \FSM\Model\user;
	
	$this->title = "Edit User";
	$this->page = 'users';
	$this->template('cms','top');
	
	$user = new user(IDE);
?>
	<h1 class="page-header"><?=$this->title?><a class="back-to" href="/admin/users">Back to Users</a></h1>
    <div id="register">
        <form class="form-user">
        	<input type="hidden" name="admin_ide" value="<?=$user->ide?>">
            <input type="hidden" name="full_name">
            
            <label for="inputFirst">First Name</label>
            <input type="text" id="inputFirst" name="fname" class="form-control" placeholder="First Name" required value="<?=$user->person->fname?>">
            
            <label for="inputLast">Last Name</label>
            <input type="text" id="inputLast" name="lname" class="form-control" placeholder="Last Name" required value="<?=$user->person->lname?>">
            
            <label for="inputEmail">Email Address</label>
            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email address" required value="<?=$user->person->email?>">
            
            <label for="inputUsername">Username</label>
            <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required value="<?=$user->person->username?>">
            
            <label for="inputAccessGroup">Aceess Group</label>
            <input type="text" id="inputAccessGroup" name="access_group" class="form-control" placeholder="Access Group" required autofocus value="<?=$user->access_group?>">
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Save User Info</button>
            <div id="message"></div>
        </form>
    </div>        
<?	
	$this->template('cms','bottom');
?>
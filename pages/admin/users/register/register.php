<?php
	$this->title = "Register User";
	$this->noProperty=true;
	$this->template('cms','top');
?>
	<h1 class="page-header"><?=$this->title?><a class="back-to" href="/admin/users">Back to Users</a></h1>
    <div id="register">
        <form class="form-register">
            <input type="hidden" name="full_name">
            
            <label for="inputFirst" class="sr-only">First Name</label>
            <input type="text" id="inputFirst" name="fname" class="form-control" placeholder="First Name" required autofocus>
            
            <label for="inputLast" class="sr-only">Last Name</label>
            <input type="text" id="inputLast" name="lname" class="form-control" placeholder="Last Name" required>
            
            <label for="inputEmail" class="sr-only">Email Address</label>
            <input type="text" id="inputEmail" name="email" class="form-control" placeholder="Email address" required>
            
            <label for="inputUsername" class="sr-only">Username</label>
            <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required>
            
            <label for="inputAccessGroup" class="sr-only">Aceess Group</label>
            <input type="text" id="inputAccessGroup" name="access_group" class="form-control" placeholder="Access Group" required autofocus>
            
            <label for="inputPassword1" class="sr-only">Password</label>
            <input type="password" id="inputPassword1" name="password1" class="form-control" placeholder="Password" required>
            
            <label for="inputPassword2" class="sr-only">Password</label>
            <input type="password" id="inputPassword2" name="password2" class="form-control" placeholder="Re-Enter Password" required>
            
            
            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
            <div id="message"></div>
        </form>
    </div>        
<?	
	$this->template('cms','bottom');
?>
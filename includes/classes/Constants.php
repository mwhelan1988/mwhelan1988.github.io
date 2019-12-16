<?php
class Constants {

    //Register Error Messages
    public static $firstNameCharacters = "Your first name must be between 2 and 25 characters";
    public static $lastNameCharacters = "Your last name must be between 2 and 25 characters";
    public static $emailsDoNotMatch = "Your emails don't match";
    public static $emailInvalid = "Email is invalid";
    public static $emailTaken = "This email is already in use.";
    public static $passwordRules = "Your password can only contain numbers and letters";
    public static $passwordCharacters = "Your password must be between 3 and 30 characters";
    public static $usernameCharacters = "Your username must be between 3 and 25 characters";
	public static $usernameTaken = "This username already exists";

    //Login Error Messages
    public static $loginFailed = "Your username or password was incorrect";
    
}
?>
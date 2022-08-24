<?php
namespace App\Message;

final class Message{
	const EMAIL_NOT_FOUND = 'Email or password is not found!';
	const REGISTER_SUCCESS = 'User successfully registered';
	const LOGOUT_SUCCESS = 'User successfully signed out';
	const PASSWORD_CHANGE_SUCCESS = 'User successfully changed password';
	const NO_PERMISSION = 'You have no permission to access!';
}
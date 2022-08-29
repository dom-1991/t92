<?php
namespace App\Message;

final class Message{
	const EMAIL_NOT_FOUND = 'Email or password is not found!';
	const SENDING_MAIL_SUCCESS = 'Sending mail successfully!';
	const REGISTER_SUCCESS = 'User successfully registered';
	const LOGOUT_SUCCESS = 'User successfully signed out';
	const PASSWORD_CHANGE_SUCCESS = 'User successfully changed password';
	const NO_PERMISSION = 'You have no permission to access!';
	const CREATE_SUCCESS = 'You created successfully!';
	const UPDATE_SUCCESS = 'You updated successfully!';
	const DELETE_SUCCESS = 'You deleted successfully!';
	const UNIQUE_FOREIN_KEY = "Integrity constraint violation: 1062 Duplicate entry for key 'unique'";
	const ID_ROLE_NOT_FOUND = "Role id is not found";
	const ID_ROUTE_NOT_FOUND = "Route id is not found";
	const ROLE_ROUTE_EXIST = "Role and route exist already";
	const ROLE_ROUTE_VALID = "Valid";
	const USER_RESET_INVALID = "User invalid";
	const TOKEN_RESET_INVALID = "Token reset invalid";

	const FORGOT_PASSWORD_5P = "Token expires in 5 mins, please double check it";
	const TOKEN_NOT_FOUND = "Token is not found";
	const TOKEN_VALID = "Token valid!";

	const ERROR_CODE_SUCCESS = 0;
	const ERROR_CODE_FAIL = 1;

	const ERROR_CODE_404 = 404; //Not Found (page or other resource doesn’t exist)
	const ERROR_CODE_401 = 401; //Not authorized (not logged in)
	const ERROR_CODE_403 = 403; //Logged in but access to requested area is forbidden
	const ERROR_CODE_422 = 422; //Unprocessable Entity (validation failed)
	const ERROR_CODE_500 = 500; //General server error	
	const ERROR_CODE_400 = 400; // Bad request
	const ERROR_CODE_200 = 200; // Successful
	const ERROR_CODE_201 = 201;

 }


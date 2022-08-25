<?php
namespace App\Message;

final class Message{
	const EMAIL_NOT_FOUND = 'Email or password is not found!';
	const REGISTER_SUCCESS = 'User successfully registered';
	const LOGOUT_SUCCESS = 'User successfully signed out';
	const PASSWORD_CHANGE_SUCCESS = 'User successfully changed password';
	const NO_PERMISSION = 'You have no permission to access!';
	const CREATE_SUCCESS = 'You create successfully!';
	const UNIQUE_FOREIN_KEY = "Integrity constraint violation: 1062 Duplicate entry for key 'unique'";
	const FORGOT_PASSWORD_5P = "Đã quá thời gian 5 phút, bạn cần thao tác lại để lấy token mới";
	const TOKEN_NOT_FOUND = "Không tìm thấy token đổi mật khẩu";
 }
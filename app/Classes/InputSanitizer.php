<?php

class InputSanitizer
{

    // Sanitize strings to prevent XSS
    public static function sanitizeString($input)
    {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    // Sanitize email address
    public static function sanitizeEmail($email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    // Validate email address
    public static function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        return true;
    }

    // Sanitize phone number (remove unwanted characters)
    public static function sanitizePhoneNumber($phoneNumber)
    {
        return filter_var($phoneNumber, FILTER_SANITIZE_STRING);
    }

    // Validate phone number (optional: regex for format)
    public static function validatePhoneNumber($phoneNumber)
    {
        $regex = '/^(\+2)?01[0-9]{9}$/';
        if (!preg_match($regex, subject: $phoneNumber)) {
            throw new Exception("Invalid phone number format.");
        }
        return true;
    }

    // Validate a general string (length, allowed characters, etc.)
    public static function validateString($input, $minLength = 1, $maxLength = 255)
    {
        if (strlen($input) < $minLength || strlen($input) > $maxLength) {
            throw new Exception("Input must be between $minLength and $maxLength characters.");
        }
        return true;
    }

    // Validate password strength (min 8 characters, mixed case, number, special char)
    public static function validatePassword($password)
    {
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/', $password)) {
            throw new Exception("Password must be at least 8 characters, with at least one letter, one number, and one special character.");
        }
        return true;
    }

    // Sanitize and validate user input (generic method for strings)
    public static function sanitizeAndValidate($input, $type = 'string')
    {
        switch ($type) {
            case 'email':
                $input = self::sanitizeEmail($input);
                self::validateEmail($input);
                break;
            case 'phone':
                $input = self::sanitizePhoneNumber($input);
                self::validatePhoneNumber($input);
                break;
            case 'password':
                self::validatePassword($input);
                break;
            default:
                $input = self::sanitizeString($input);
                self::validateString($input);
                break;
        }
        return $input;
    }
}

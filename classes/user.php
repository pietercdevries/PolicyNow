<?php namespace classes;

use DateTime;
use Exception;

/**
 * User Class is a class to manage login and users.
 *
 * User Class is a class that is used for function management and users and login's in the system.
 * It doesn't directly connected to the database so that we can keep it abstracted.
 * You can use this class for making functions to manipulate the user's data or to preform certain non view actions.
 *
 * Example usage:
 * if (User->$Active = true && User->$Deleted = false){
 *      print('I am an active user! My password may need to be reset.');
 * }
 *
 * @package User
 * @author Pieter de Vries
 * @version 1.0
 * @since 2019/08/03
 * @access public
 */
class User {
    public int $Id;
    public string $FirstName;
    public string $LastName;
    public string $Email;
    public string $Password;
    public int $DepartmentId;
    public string $AvatarURL;
    public string $IpAddress;
    public int $LoginAttempts;
    public DateTime $LastPasswordChangedDate;
    public DateTime $CreatedDate;
    public int $CreatedByUserId;
    public DateTime $LastUpdatedDate;
    public int $LastUpdatedByUserId;
    public bool $Active;
    public DateTime $PasswordExpiresDate;
    public DateTime $DisableAccessDate;
    public bool $Deleted;

    /**
     * You can create a new user with this method and it will store it in the database.
     * It is important to keep in mind that if you set the [id] field it will be ignored.
     * When you save the user you can get the id from the object you used in the parameter as it will update it with
     * the new id.
     * If the function returns false it failed to create the user and the cause will be in the log.
     * One of the causes can be that the user already exists. You can also expect failures when required fields do
     * not have values.
     * All the dates and the passwords expiration dates are managed by the database and can not be changed by the
     * software. You can however set the expiration date if you want but I suggest you use the SetExpirePassword
     * method after you create the user. The expiration date can be null if you do not want to set it however I
     * strongly suggest that you do to keep passwords updated on a regular basis.
     *
     * @param  User  $user  a user class object will be send here to be save in the database.
     *
     * @return bool It will return a true or false when the user was successfully created.
     * @access public This method is publicly available so anyone can create a new user.
     */
    public function CreateNewUser( $user ): bool
    {
        // Store new user object in the database.

        // TODO: Prevent duplicate users also by email and return false if there is a duplicate. Also at that point do not save the user object. In the view offer to change the existing user.
        // TODO: Must have a department set.
        // TODO: Do not include deleted users in the search.

        // TODO: Add Audit Log.
    }

    /**
     * This will be used to get the user by it's unique id number. You can use this for updating a member or simply
     * getting the value from the User's object. This will return users that have been deactivated and also users
     * that have had their password expired. However if a user was deleted it will also be return even though the
     * record still exists in the database. One thing to keep in mind is that this will not have the password
     * returned and you need to use a different function to get that. We don't want to have the hashed password in
     * memory if we do not need to.
     *
     * @param  int  $userId  The is the user id of the user you are trying to retrieve from the database.
     *
     * @return User The user object that you wanted to get from the database. This will not have the password field.
     * @access public You can get a user by id by calling this call and is publicly available.
     */
    public function GetUserById( $userId ): User
    {

        // TODO: Do not return the password field.
        // TODO: Add Audit Log.
    }

    /**
     * If you need to get a user by email address you can do that here. There is only one email existing so this
     * will only return one user object. It will not contain the password as you can get this with a different
     * method. We don't want to return the password and have it in memory if we don't really need it.
     *
     * @param  string  $email  This is the email address of the user you want to look up. There will only be one.
     *
     * @return User It will return a User object without the password and null if it did not find anything.
     * @access public You can access this method publicly.
     */
    public function GetUserByEmail( $email ): User
    {
        // Check if we got a valid email address.
        if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) == FALSE )
        {
            return NULL;
        }

        // TODO: Add Audit Log.
    }

    /**
     * If you need to get a list of users from the database and you want to filter it by user department you can do
     * that with this method. All users must have a department assigned to it for it to work properly. This will
     * include inactive users in the result list however it will not return items that have the deleted flag on it.
     * Once a user has been deleted it can not be resurrected so this means we can not return it in case a new
     * person with the same email get added to the system.
     *
     * @param  int  $departmentId  The id of the department you want to get the list of users from.
     *
     * @return array It will return a list of users in an array for only the select department excluded deleted
     * users.
     * @access public This is a public class and can be useful for user management etc.
     */
    public function GetUsersByDepartment( $departmentId ): array
    {

        // TODO: Add Audit Log.
    }

    /**
     * If you need the password for a user you can use only this method. In fact the password will not be included
     * in any other method. We do this because we only want to put the password in memory when we really need it and
     * not by default. Keep in mind that the password is actually a hash representation of the actual password and
     * can not be reverted back. You will need to compare the hashes if you are checking for password validity.
     *
     * @param  int  $userId  The Id of the user you want to get the password returned for.
     *
     * @return string The hash representation will be returned as a string. You can only ever get the hash
     * representation.
     * @access public You can get the password publicly for a member however this is a hash representation only.
     */
    public function GetUserPasswordFromUser( $userId ): string
    {
        // Retrieve the user.
        $user = $this->GetUserById( $userId );

        // TODO: Add Audit Log.

        return $user->Password;
    }

    /**
     * You can encrypt and create a hash from you password string. This is 512 bit encryption and creates a hash. It
     * automatically adds a salt in the method so we do not need to add this.. The IV is hard coded and is a rand
     * string for character. You generally use this to store sensitive information like passwords to the database so
     * it is not in plain text. Keep in mind you can not ever get the data back that you encrypt and hash. It
     * automatically salts.
     *
     * @param  string  $password  The password you wish to obfuscate and hash to encrypt.
     *
     * @return string The new encrypted hash that can now be stored.
     * @access private You can only get the Hash of a password in this class. This should not be needed anywhere
     * else.
     */
    private function encryptNewPassword( $password ): string
    {
        // Create the hash representation of the password supplied. We are using a random hash.
        return password_hash( $password, PASSWORD_ARGON2I );
    }

    /**
     * If you need to check if a hash matches a password you can use this method. This can be used for when you want
     * to check a login or something like that. You must use encryptNewPassword for this to work properly. The
     * method has build in security like salts etc. Don't try to add a salt as this will break the functionality.
     * We also check to see if someone changed the password in the database and we also checked to see if a
     * different algorithm was used. it also takes care of all the admin for the login attempts etc.
     *
     * @param  int  $userId  The user you want to check to see if the password is the same.
     * @param  string  $testingPassword  The plain text password you wish to check for.
     * @param  string  $passwordHash  The hash you want to check against. This is from the database generally.
     *
     * @return bool If the plain password matches and is the same it will return true otherwise it is false.
     * @access public You can use this anywhere and you can check password validity.
     * @throws Exception
     */
    public function verifyPassword( $userId, $testingPassword, $passwordHash ): bool
    {
        // Retrieve the user.
        $user = $this->GetUserById( $userId );

        // If we can not find the user we should return false because we can not verify it.
        if ( $user == NULL )
        {
            return FALSE;
        }

        // Update the last login attempt to the current time. Also update the last login datetime.
        $user->LoginAttempts += 1;
        $user->LastUpdatedDate = new DateTime( "now" );
        $this->UpdateUser( $userId, $user );
        // TODO: Add Audit Log.

        // Check if the user is active and has not been deleted. If so we can not check the password.
        if ( $user->Deleted == TRUE || $user->Active == FALSE )
        {
            return FALSE;
        }

        // Make sure the password is not expired.
        if ( strtotime( $user->PasswordExpiresDate ) < strtotime( 'now' ) )
        {
            // Deactivate the account because the expiration date does not match.
            $this->SetActiveStatus( $userId, FALSE, NULL );

            return FALSE;
        }

        // Check how many retries have been done.
        if ( $user->LoginAttempts > 3 )
        {
            // To many tries have been done and we need to deactivate the account.
            $this->SetActiveStatus( $userId, FALSE, NULL );

            return FALSE;
        }

        // Check if the password was tampered with or if it is using the wrong algorithm.
        if ( password_needs_rehash( $passwordHash, PASSWORD_ARGON2I ) == TRUE )
        {
            // Update the user so we can deactivate the account because the password has been altered.
            $this->SetActiveStatus( $userId, FALSE, NULL );

            return FALSE;
        }

        // Check if the password matches the hash.
        if ( password_verify( $testingPassword, $passwordHash ) == TRUE )
        {
            // Reset the amount of login attempts.
            $user->LoginAttempts = 0;
            $user->LastUpdatedDate = new DateTime( "now" );
            $this->UpdateUser( $userId, $user );

            // TODO: Add Audit Log.
            return TRUE;
        }
        else
        {
            // TODO: Add Audit Log.
            return FALSE;
        }
    }

    /**
     * This method will update the details about the user and it's information.
     * It is intended to use this for updating the user's information.
     * You can not update the [id] field as this is managed by the database.
     * You also can not change the create and update dates as they are managed by the database and can not be changed by the software.
     *
     * @param  int  $userId  This is the if of the user that you want to update.
     * @param  User  $user  This is the user object with the updated values that you want to update in the database.
     *
     * @return bool This will be true if it was able to successfully store the updated values.
     * @access public You can access this method when you call the class so you can update the user.
     */
    public function UpdateUser( $userId, $user ): bool
    {
        // Retrieve the user.
        $user = $this->GetUserById( $userId );

        // Check if we can find a user if not we need end the method.
        if ( $user == NULL )
        {
            return FALSE;
        }

        // Update the new user information in the database.

        // TODO: Add Audit Log.

        return TRUE;
    }

    /**
     * Sometimes you may need to expire a user's password to be expired at a certain date.
     * You have to use a date in the future and must be at least  today or in the future.
     * The time is also included and so it can be more precise when you want to turn off access automatically.
     * If you do not want an expiration you can keep this blank or change it to be blank. However I strongly suggest
     * you always have an expiration date so you can rotate the passwords.
     * The user can still have their password reset by the admin account and have their password reset.
     *
     * @param  int  $userId  int The id of the user you want to expire automatically.
     * @param  DateTime  $newExpirationDate  DateTime The new expiration date and time you want to set and must be
     * today or in the future.
     *
     * @return bool This will be true if the expiration date was successfully updated.
     * @access public You can assess this publicly to set the expired date.
     */
    public function SetExpirePassword( $userId, $newExpirationDate ): bool
    {
        // Update the expiration date for the password to be reset.
        // Make the date is one day ahead of today or today.

        // Retrieve the user.
        $user = $this->GetUserById( $userId );

        // Check to see if we have a user.
        if ( $user == NULL )
        {
            return FALSE;
        }

        // Check if the new expire date is larger than today
        if ( strtotime( $newExpirationDate ) <= strtotime( 'now' ) )
        {
            return FALSE;
        }

        // Update the expire password date.
        $user->SetExpirePassword( $newExpirationDate );

        $success = $this->UpdateUser( $userId, $user );

        // TODO: Add Audit Log.

        return $success;
    }

    /**
     * A user can be inactive and this can be used if a user needs to be turned off temporarily from access.
     * When a user is inactive they can not login and they can not reset their password except by an admin user.
     * You can set the date so you can automatically disable account. This can be useful when you have a temporary
     * user that needs to be deactivated automatically. You can keep this null if you want to keep it activate at
     * all times.
     *
     * Keep in mind this does not affect or change the password expiration date.
     *
     * @param  int  $userId  This is the id of the user you wish to change the user active state on.
     * @param  bool  $activeStatus  The status if a user is active. If false a user can not login or reset their
     * password.
     * @param  DateTime  $disableAccessDate  This can be null however if you set a date it will disable the account
     * on the date you set. The date must be today or in the future.
     *
     * @return bool This will return true if the active status was updated properly in the database.
     * @access public You can set a user's active status in this software.
     * @throws Exception
     */
    public function SetActiveStatus( $userId, $activeStatus, $disableAccessDate ): bool
    {
        // Chance the active status in the database. Active is used to temporally disable a user. Deleted is to
        // remove them from the system.

        // Retrieve the user.
        $user = $this->GetUserById( $userId );

        // Check to see if we have a user.
        if ( $user == NULL )
        {
            return FALSE;
        }

        // Update the user information.
        $user->Active = $activeStatus;
        $user->LastUpdatedDate = new DateTime( "now" );

        // Check if we wanted to set the new disabled date.
        if ( $disableAccessDate != NULL )
        {
            $user->LastPasswordChangedDate = $disableAccessDate;
        }

        $success = $this->UpdateUser( $userId, $user );

        // TODO: Add Audit Log.

        return $success;
    }

    /**
     * The user may need to be deleted. Because we want to keep all the history we just set a deleted flag instead.
     * When the status is true on deleted the user can not be reactivated by and admin and can not be reset. However
     * reference may still exist to this user and will remain available in the system.
     *
     * I suggest you ask the user if they truly want to remove the user as this can not be undone and it may be
     * better to change the active status if you are not sure.
     *
     * @param  int  $userId  The id of the user you want to delete.
     * @param  bool  $deletedStatus  The status of the user true if they are deleted.
     *
     * @return bool This will return true if the deleted status was saved properly in the database.
     * @access public You can delete a user by calling this class first. You can then delete a user.
     */
    public function SetDeletedStatus( $userId, $deletedStatus ): bool
    {
        // Retrieve the user.
        $user = $this->GetUserById( $userId );

        // Check to see if we have a user.
        if ( $user == NULL )
        {
            return FALSE;
        }

        // Change the status of deletion in the database. You can't remove users in this system from the database.
        $user->Deleted = $deletedStatus;

        $success = $this->UpdateUser( $userId, $user );

        // TODO: Add Audit Log.

        return $success;
    }
}
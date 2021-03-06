<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {
        $record = User::model()->find(array('condition' => 'username="' . $this->username . '"'));  // check user name from database
        if ($record === null) {
            $this->_id = 'user Null';
            $this->errorCode = "Your user name does not found in our database";
        } else if ($record->enabled == 0) {                //  check status as Active in db
            $this->errorCode = "Your account has not activated";
        } else if ($record->password !== sha1($this->password)) {            // compare db password with passwod field
            $this->_id = $this->id;
            $this->errorCode = "Your password are invalid";
        } else {
            if (isset($record->Roles->name)) {
                $sRolesName = $record->Roles->name;
            } else {
                if ($record->roles_id == -1) {
                    $sRolesName = 'Super User';
                } else {
                    $sRolesName = '- (Undefined Roles)';
                }
            }

            $this->_id = $record['id'];
            $this->setState('code', $record->code);
            $this->setState('name', $record->name);
            $this->setState('phone', $record->phone);
            $this->setState('email', $record->email);
            $this->setState('city', $record->city_id);
            $this->setState('address', $record->address);
            $this->setState('roles_id', $record->roles_id);
            $this->setState('departement_id',(isset($record->departement_id)) ? $record->departement_id : '');
            $this->setState('roles_name', $sRolesName);
            $this->setState('avatar_img', landa()->urlImg('avatar/', $record->avatar_img, $this->_id));

            //save the auth session
            if ($record->roles_id == -1) {
                $this->setState('isSuperUser', 1);
            } else {
                $this->setState('isSuperUser', 0);
            }

            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId() {       //  override Id
        return $this->_id;
    }

}

<?php

class User {
    private $UserId;
    private $FirstName;
    private $LastName;
    private $Email;
    private $Password;
    private $IsActive;
    private $CreatedOn;
    private $RoleId;
    private $RoleName;

    function __construct($UserId, $FirstName, $LastName, $Email, $Password, $IsActive, $CreatedOn, $RoleId)
    {
        $this->UserId = $UserId;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->IsActive = $IsActive;
        $this->CreatedOn = $CreatedOn;
        $this->RoleId = $RoleId;
    }
    
    public function getUserId()
    {
        return $this->UserId;
    }
    
    public function setUserId($UserId)
    {
        $this->UserId = $UserId;
    }

    public function getFirstName()
    {
        return trim($this->FirstName);
    }

    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
    }

    public function getLastName()
    {
        return trim($this->LastName);
    }

    public function setLastName($LastName)
    {
        $this->LastName = $LastName;
    }

    public function getEmail()
    {
        return trim($this->Email);
    }

    public function setEmail($Email)
    {
        $this->Email = $Email;
    }

    public function getPassword()
    {
        return trim($this->Password);
    }

    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    public function getIsActive()
    {
        return $this->IsActive;
    }

    public function setIsActive($IsActive)
    {
        $this->IsActive = $IsActive;
    }

    public function getCreatedOn()
    {
        return $this->CreatedOn;
    }
    
    public function setCreatedOn($CreatedOn)
    {
        $this->CreatedOn = $CreatedOn;
    }

    public function getRoleId()
    {
        return $this->RoleId;
    }

    public function setRoleId($RoleId)
    {
        $this->RoleId = $RoleId;
    }   
    
    public function getRoleName()
    {
        return trim($this->RoleName);
    }
    
    public function setRoleName($RoleName)
    {
        $this->RoleName = $RoleName;
    }
}

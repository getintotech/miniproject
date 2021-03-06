<?php include('Header.php'); 
    include 'common.php';
    include '../App/blog_app.php';
    use function App\read_roles, App\create_user, App\delete_user, App\read_user_ById, App\update_user;
    
    $usr = $_SESSION['UserObject'];
    if ((empty($usr)) || (is_null($usr)))
    {
        header("Location: index.php");
    }

    if ($usr->getRoleName() != 'Admin')
    {
        header("Location: index.php");
    }
  
    $operation = "";
    $userId = "";
    if(isset($_GET['ops']))
    {
        $operation = $_GET['ops'];
    }
    if(isset($_GET['Id']))
    {
        $userId = $_GET['Id'];
    }

    if($operation == "Delete")
    {
        delete_user($pdo, $userId);
        header("Location: Admin.php?Manage=user");
    }
    
    $firstName = $lastName = $pass = $email = $isactive = $selectedItem = "";
    $submitButtonText = "Create User";
    if($operation == "Edit")
    {
       $user = read_user_ById($pdo, $userId);
       $firstName = $user->getFirstName();
       $lastName = $user->getLastName();
       $pass = $user->getPassword();
       $email = $user->getEmail();
       $isactive = $user->getIsActive();
       $roleIndex = $user->getRoleId();
       $submitButtonText = "Update";
    }
    
    $firstNameErr = $lastNameErr = $emailErr = $passwordErr = "";    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $firstName = test_input($_POST['firstname']);
        if (empty($firstName)) {
            $firstNameErr = "First name is required";
        }
        else {            
            if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
                $firstNameErr = "Only letters and white space allowed in first name"; 
            }
        }

        $lastName = test_input($_POST['lastname']);
        if (empty($lastName)){
            $lastNameErr = "Last name is required";
        }
        else {            
            if (!preg_match("/^[a-zA-Z ]*$/",$lastName)){
                $lastNameErr = "Only letters and white space allowed in last name"; 
            }
        }
        
        $pass = test_input($_POST['password']);
        if (empty($pass)){
            $passwordErr = "Password is required";
        }
        
        $email = test_input($_POST['email']);
        if (empty($email)){
            $emailErr = "Email is required";
        }
        else {            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format"; 
            }
        }
        
        if (empty($firstNameErr) && empty($lastNameErr) && empty($passwordErr) && empty($emailErr))
        {
            $new_user = new User(0, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], 1, date("Y-m-d H:i:s"), $_POST['role']);
            if($operation == "Edit")
            {
                $new_user->setUserId($userId);
                update_user($pdo, $new_user);
            }
            else 
            {
                echo create_user($pdo, $new_user);
            }            
            $_POST = array();
            header("Location: Admin.php");
        }
    }
    
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<script lang='javascript' type="text/javascript">
    function resetfields()
    {
        document.getElementById("firstname").value = "";
        document.getElementById("lastname").value = "";
        document.getElementById("email").value = "";
        document.getElementById("password").value = "";
        document.getElementById("role").selectedIndex = "0";
    }
</script>

<h1 align='center'> Create New User</h1>
<p><span class="error">* Required field.</span></p>
<form id='createuserform' action='' method='POST'>
  <fieldset>
    <div>
        <table width='100%'>
            <tr>
                <td>
                    First Name
                </td>
                <td>                    
                    <input type='text' name='firstname' id='firstname' maxlength="100" value="<?php echo $firstName ?>" />
                    <span class="error">* <?php echo $firstNameErr;?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Last Name
                </td>
                <td>
                    <input type='text' name='lastname' id='lastname' maxlength="100" value="<?php echo $lastName ?>" />
                    <span class="error">* <?php echo $lastNameErr;?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <input type='text' name='email' id='email' maxlength="150" value="<?php echo $email ?>" />
                    <span class="error">* <?php echo $emailErr;?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Password
                </td>
                <td>
                    <input type='password' name='password' id='password' maxlength="100" value="<?php echo $pass ?>" />
                    <span class="error">* <?php echo $passwordErr;?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Is Active ?
                </td>
                <td>
                    <input type="checkbox" name="IsActive" id="IsActive" checked="<?php echo $isactive ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Role
                </td>
                <td>
                    <?php                         
                        $result = read_roles($pdo);
                        $select = '<select name="role" id="role">';
                        foreach ($result as $role) 
                        {
                         $select .= '<option value ="'.$role->getRoleId().'"';
                         if ($selectedItem ==  $role->getRoleId())
                         {
                            $select .= "selected=true";
                            
                          }
                          $select .= '">'.$role->getName().'</option>"';
                        }
                        $select .= '</select>';
                        echo $select;
                    ?>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                   <button id="createuser" type="submit"><?php echo $submitButtonText ?></button>
                   <button id="reset" type="button" onclick="resetfields();">Reset</button>
                </td>
            </tr>
        </table>
    </div>
  </fieldset>
</form>

<?php include('Footer.php'); ?>

<?php

    function register($conn,$name,$email,$password)
    {
        $sql = "INSERT INTO users(name,email,password) VALUES(:name,:email,:password)";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name'=>$name,'email'=>$email,'password'=>$password]);
        return true;
    }

    // check if email exist
    function userExist($conn,$email)
    {
        $sql = "SELECT email FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // login existing user
    function login($conn,$email)
    {
        $sql = "SELECT email, password FROM users WHERE email = :email AND deleted !=0";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // retreiving current users detatil
    function currentUser($conn,$email)
    {
        $sql = "SELECT * FROM users WHERE email = :email AND deleted !=0";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // forgot password
    function forgot_password($conn,$token,$email)
    {
        $sql='UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(),INTERVAL 10 MINUTE) WHERE email = :email';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['token'=>$token,'email'=>$email]);
        return true;
    }

    //reset password
    function resetPassword($conn,$email,$token)
    {
        $sql = "SELECT id FROM users WHERE email =:email AND token =:token AND token !='' AND token_expire > NOW() AND deleted != 0";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['email'=>$email,'token'=>$token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // Update Password
    function updatePassword($conn,$pass,$email)
    {
        $sql = 'UPDATE users SET token="", password=:pass WHERE email=:email AND deleted !=0';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['pass'=>$pass,'email'=>$email]);
        return true;
    
    }
?>
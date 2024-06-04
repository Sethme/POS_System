<?php

include('../config/function.php');

if(isset($_POST['saveAdmin']))
{
     $name = validate($_POST['name']);
     $email = validate($_POST['email']);
     $paassword = validate($_POST['password']);
     $phone = validate($_POST['phone']);
     $is_ban = isset($_POST['is_ban']) == true ? 1:0;

     if($name != '' && $email != '' && $paassword != '' ){

          $emailCheck = mysqli_query($conn,"SELECT * FROM admins WHERE email='$email'");
          if($emailCheck){
               if(mysqli_num_rows($emailCheck) > 0){
                    redirect('admin-create.php', 'Email Already used by another user.');
          
               }        
          }
          
          $bcrypt_paassword = password_hash($paassword, PASSWORD_BCRYPT);

          $data = [
            'name' => $name,
            'email' => $email,
            'password' => $bcrypt_paassword,
            'phone' => $phone,
            'is_ban' => $is_ban
          ];
          
          $result = insert('admin', $data);
          if($result){
               redirect('admins.php' , 'Admin Created Successfully');
          }else{
               redirect('admin-create.php' , 'Something went wrong!');
          }
       }else{
              redirect('admin-create-php' , 'Please fill required fields.');
          } 
}


if(isset($_POST['updateAdmin']))
{
     $adminId = validate($_POST['adminId']);
     $adminData = getById('admins', $adminId);
     if($adminData['status'] !=200){
       redirect('admin-edit-php?id='.$adminId, 'Please fill required fields.');   
     }
     
     $name = validate($_POST['name']);
     $email = validate($_POST['email']);
     $paassword = validate($_POST['password']);
     $phone = validate($_POST['phone']);
     $is_ban = isset($_POST['is_ban']) == true ? 1:0;

     if($paassword != ''){
          $hashedPassword = password_hash($paassword, PASSWORD_BCRYPT);
     }else{
          $hashedPassword = $adminData['data']['password'];
     }

     if($name != '' && $email != '' )
     {
          $data = [
               'name' => $name,
               'email' => $email,
               'password' =>  $hashedPassword ,
               'phone' => $phone,
               'is_ban' => $is_ban
             ];
             
             $result = update('admin', $adminId , $data);

          
             if($result){
                  redirect('admin-edit.php?id=' .$adminId, 'Admin Updated Successfully');
             }else{
                  redirect('admin-edit.php?id=' .$adminId, 'Something went wrong!');
             }
          }
          else
          {
                 redirect('admin-create-php' , 'Please fill required fields.');
             } 
   
     }  
   
?>
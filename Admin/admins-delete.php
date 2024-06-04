<?php
 
 require '../config/function.php';

 $paraResultId = checkParamId('id'); 
 if(is_numeric($paraResultId)){

      $adminId = validate($paraResultId);
      if($admin['status'] == 200)
      {
        $adminDeleteRes = delete('admin', $adminId);
        if( $adminDeleteRes )
        {
            redirect('admins.php', 'Admin deleted successfully');
        }
        else{
            redirect('admins.php', 'Something Went Wrong');
         }
      }
      else
      {
        redirect('admins.php', $admin['message'] );
      }
       //echo $adminId;

 }else{
    redirect('admins.php', 'Something Went Wrong');
 }

?>
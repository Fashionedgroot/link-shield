<?php
   function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

include 'config.php';

$check=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE email='".$_POST['email']."'"));

		if($check==1)
		{
			$users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE email='".$_POST['email']."'"));
			$code=generateRandomString();
			$msg='Hy, '.$users['name'].' Your New Generated Password is: '.$code.'';
		    $headers = "[Reset Password]";
			$mml=mail($_POST['email'],'Reset Password',$msg,$headers);
		
			if($mml){
mysqli_query($conn,"UPDATE users SET password='".md5($code)."' where email='".$_POST['email']."'");

			echo '<div class="alert alert-success">
                      <strong>New Password Has Been Sent to Your Mail!</strong> Check Your Inbox.
                    </div>';} else {
echo '<div class="alert alert-warning">
                      <strong>Timeout, Try again later!</strong>.
                    </div>';
}
			
		} else {
				echo '<div class="alert alert-danger">
							  <strong>User not found!</strong>.
							</div>';
		}
?>
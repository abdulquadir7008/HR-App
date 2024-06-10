<?php
include("config.php");
if(isset($_POST['subscribe_smn'])) {
	$email = $_POST['email'];
	$sql_email ="select * from subscribe where email='$email'";
	$sql_result=mysqli_query($link,$sql_email); 
 	$list_subscribe=mysqli_fetch_array($sql_result);
	if($list_subscribe['email'] == $email){
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div id="hideDiv" class="success">
            <div class="icon">
                <svg data-name="check-mark (1)" height="30" id="check-mark_1_" viewbox="0 0 30 30" width="30"
                    xmlns="http://www.w3.org/2000/svg">
                    <g data-name="Group 3" id="Group_3" transform="translate(0 0)">
                        <path
                            d="M25.606,25.606a15,15,0,1,0-21.212,0A15,15,0,0,0,25.606,25.606ZM9.622,12.707,13,16.08,20.384,8.7,23,11.312l-7.383,7.383L13,21.309l-2.614-2.614L7.008,15.321Z"
                            data-name="Path 2" fill="#fff" id="Path_2" transform="translate(0 0)"></path>
                    </g>
                </svg>
            </div>
            <div>
                <h3>Notice: </h3>
                <p>You have already subscribe.</p>
            </div>
        </div>';
$errflag = true;
$_SESSION['subscribe_error'] = $errmsg_arr;
header('Location: ' . $_SERVER['HTTP_REFERER']);
		
	}
	else{
		
$query="insert into subscribe (email,status) values('$email','1')";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = '<div id="hideDiv" class="success">
            <div class="icon">
                <svg data-name="check-mark (1)" height="30" id="check-mark_1_" viewbox="0 0 30 30" width="30"
                    xmlns="http://www.w3.org/2000/svg">
                    <g data-name="Group 3" id="Group_3" transform="translate(0 0)">
                        <path
                            d="M25.606,25.606a15,15,0,1,0-21.212,0A15,15,0,0,0,25.606,25.606ZM9.622,12.707,13,16.08,20.384,8.7,23,11.312l-7.383,7.383L13,21.309l-2.614-2.614L7.008,15.321Z"
                            data-name="Path 2" fill="#fff" id="Path_2" transform="translate(0 0)"></path>
                    </g>
                </svg>
            </div>
            <div>
                <h3>Congratulations</h3>
                <p>Thank you for Subscribe Our Website.</p>
            </div>
        </div>';
$errflag = true;
$_SESSION['subscribe_error'] = $errmsg_arr;
header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}
?>
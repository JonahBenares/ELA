<?php 
if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['username']);
    $password = ($this->session->userdata['logged_in']['password']);
} else {
    echo "<script>alert('You are not logged in. Please login to continue.'); 
        window.location ='".base_url()."index.php/template/index'; </script>";
}

/*function is_connected(){
  $connected = fopen("http://localhost/ELA_MOBILE","r");
  if($connected)
  {
     return true;
  } else {
   return false;
  }

}*/
/*function check_internet_connection($sCheckHost = 'http://putokbatok.biz/ELA') {
    return (bool) @fsockopen($sCheckHost, 80, $iErrno, $sErrStr, 5);
}*/
/*function check_internet_connection($sCheckHost = 'http://putokbatok.biz/ELA') 
{
    return (bool) @fsockopen($sCheckHost, 135, $iErrno, $sErrStr, 5);
}

$bIsConnected = check_internet_connection();
$sText = ($bIsConnected) ? 'You are connected to the Internet.' : 'You are not connected to the Internet.';
echo $sText;*/

/*if(!$sock = @fsockopen('http://putokbatok.biz/ELA', 80))
{
    echo 'Not Connected';
}
else
{
echo 'Connected';
}*/
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>ELA MOBILE</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <link href="<?php echo base_url(); ?>assets/assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url(); ?>assets/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url(); ?>assets/assets/css/animate.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/assets/css/animation.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo base_url(); ?>assets/assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url(); ?>assets/assets/css/demo.css" rel="stylesheet" /> 
    <link href="<?php echo base_url(); ?>assets/assets/css/style.css" rel="stylesheet" /> 


    <!--  Fonts and icons     -->
    <link href="<?php echo base_url(); ?>assets/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='<?php echo base_url(); ?>assets/assets/css/font.css' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/assets/css/themify-icons.css" rel="stylesheet">


</head>
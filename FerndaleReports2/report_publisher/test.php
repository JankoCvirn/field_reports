<?php
$html=$_POST['html'];

$myFile = "testFile.html";
$fh = fopen($myFile, 'w') or die("can't open file");

$styles="<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <title>Labor&Material Field Report </title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content=''>
    <meta name='author' content=''>

    <!-- Le styles -->
    <link href='../css/bootstrap.css' rel='stylesheet'>
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href='../css/bootstrap-responsive.css' rel='stylesheet'>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src='http://html5shim.googlecode.com/svn/trunk/html5.js'></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
<!--    <link rel='shortcut icon' href='../assets/ico/favicon.ico'>-->
    <link rel='stylesheet' href='../datatables/media/css/demo_page.css'>
<link rel='stylesheet' href='../datatables/media/css/demo_table.css'>


<script src='../js/jquery-1.7.1.min.js'>
        </script>
        <script src='../js/jquery.dataTables.columnFilter.js' type='text/javascript'></script>
        

<script type='text/javascript'
	src='../datatables/media/js/jquery.dataTables.js'></script>";
fwrite($fh, $styles);
fwrite($fh, $html);
fclose($fh);
shell_exec('/opt/wkhtmltopdf/bin/wkhtmltopdf testFile.html testfile.pdf');

?>
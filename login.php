<?php
session_start();
$session_ID = md5(session_id().time());
$_SESSION['session_ID'] = $session_ID;

function userLogin()
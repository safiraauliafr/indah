<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$alerterror = $this->session->flashdata('error');
if (!empty($alerterror))
{
    echo '<div class="alert alert-danger">', $alerterror, '</div>';
}
$alertsuccess = $this->session->flashdata('success');
if (!empty($alertsuccess))
{
    echo '<div class="alert alert-success">', $alertsuccess, '</div>';
}
$alertwarning = $this->session->flashdata('warning');
if (!empty($alertwarning))
{
    echo '<div class="alert alert-warning">', $alertwarning, '</div><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}
$alertinfo = $this->session->flashdata('info');
if (!empty($alertinfo))
{
    echo '<div class="alert alert-info">', $alertinfo, '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}
?>
<?php
  //test_api.php
  include('api.php');


  if ($_GET['action'] == 'fetch_all') 
  {
    fetch_all();
  }

  if ($_GET['action'] == 'insert') 
  {
    insert();
  }

  if ($_GET['action'] == 'fetch_single') 
  {
    $id = intval($_GET['id']);
    fetch_single($id);
  }

  if ($_GET['action'] == 'update') 
  {
    update();
  }

  if ($_GET['action'] == 'delete') 
  {
    $id = intval($_GET['id']);
    delete($id);
  }
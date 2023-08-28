<?php 
  //api.php
  require_once 'database.php';

  //Function to fetch all the items
  function fetch_all()
  {
    $bdd = Database::connect();
    $query = $bdd -> prepare("SELECT * FROM user ORDER BY id");
    if ($query->execute()) 
    {
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
        Database::disconnect();
      }
      sendJSON($data);
    }
  }

  //Function Insert
  function insert()
  {
    if (isset($_POST['first_name'])) 
    {
      $form_data = array(
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
      );
      $dbb = Database::connect();
      $query = $dbb -> prepare("INSERT INTO user(first_name, last_name) VALUES(:first_name, :last_name)");
      if ($query->execute($form_data)) 
      {
        $data[] = array(
          'success' => '1'
        );
        Database::disconnect();
      }
      else 
      {
        $data[] = array(
          'success' => '0'
        );
      }
      sendJSON($data);
    }
  }

  //Function fetch_single
  function fetch_single($id)
  {
    $bdd = Database::connect();
    $query = $bdd->prepare("SELECT * FROM user WHERE id= ?");

    if ($query->execute(array($id))) 
    {
      $row = $query->fetch();
      $data['first_name'] = $row['first_name'];
      $data['last_name'] = $row['last_name'];
      Database::disconnect(); 
    }
    sendJSON($data);
  }

  function update()
  {
    if (isset($_POST['first_name'])) 
    {
      $form_data = array(
        ':first_name' => $_POST['first_name'],
        ':last_name'  => $_POST['last_name'],
        ':id'         => $_POST['id']
      );

      $bdd = Database::connect();
      $query = $bdd -> prepare("UPDATE user SET first_name = :first_name, last_name = :last_name WHERE id = :id");

      if ($query->execute($form_data)) 
      {
        $data[] = array(
          'success' => '1'
        );
        Database::disconnect();
      }
      else {
        $data[] = array(
          'success' => '0'
        );
      }
    }
    sendJSON($data);
  }

  //Function Delete
  function delete($id)
  {
    $bdd = Database::connect();
    $query = $bdd->prepare("DELETE FROM user WHERE id = ?");

    if ($query->execute(array($id))) {
      $data[] = array(
        'success' => '1'
      );
    }
    else 
    {
      $data[] = array(
        'success' => '0'
      );
    }
    sendJSON($data);
  }

  //Function JSON
  function sendJSON($infos){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($infos, JSON_UNESCAPED_UNICODE);
  }

<?php
include_once("common.php");
global $conn;
if(isset($_SESSION['cpf']) && isset($_GET['request'])){
    $request = esc($_GET['request']);
    if($request == 'field'){
        $a = array();
        $query = "select field_id, name from field_data";
        $result = mysqli_query($conn, $query);
        header('Content-type: application/json');
        while($row = mysqli_fetch_assoc($result)){
            array_push($a,json_encode($row));
        }
        echo json_encode($a);
    }elseif($request == 'field-desc'){
        $field_id = esc($_GET['field_id']);
        $a = array();
        $query = "select description,map_path from field_data where field_id = $field_id";
        $result = mysqli_query($conn, $query);
        header('Content-type: application/json');
        while($row = mysqli_fetch_assoc($result)){
            array_push($a,json_encode($row));
        }
        echo json_encode($a);
    }elseif($request == 'cat'){
        $a = array();
        $query = "select cat_id, name from cat_data";
        $result = mysqli_query($conn, $query);
        header('Content-type: application/json');
        while($row = mysqli_fetch_assoc($result)){
            array_push($a,json_encode($row));
        }
        echo json_encode($a);
    }elseif($request == 'cat-summary'){
        $field_id = esc($_GET['field_id']);
        $query = "select b.name as name, a.cat_id as cat_id, count(*) as total from repo_data a, cat_data b where a.cat_id = b.cat_id and a.field_id = $field_id group by b.name";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            $a = array();
            header('Content-type: application/json');
            while($row = mysqli_fetch_assoc($result)){
                array_push($a,json_encode($row));
            }
            echo json_encode($a);
        }
    }elseif($request == 'summary-click'){
        $field_id = esc($_GET['field_id']);
        $cat_id = esc($_GET['cat_id']);
        $query = "select title,tags,content,path,filename from repo_data where field_id = $field_id and cat_id = $cat_id";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            $a = array();
            header('Content-type: application/json');
            while($row = mysqli_fetch_assoc($result)){
                array_push($a,json_encode($row));
            }
            echo json_encode($a);
        }
    }
}elseif(isset($_POST['action'])){
    $action = esc($_POST['action']);
    if($action == 'upload'){
        $field_id = esc($_POST['field_id']);
        $cat_id = esc($_POST['cat_id']);
        $field_text = esc($_POST['field_text']);
        $cat_text = esc($_POST['cat_text']);

        $root = "uploads/";
        $field_path = $root . $field_text;
        if (!file_exists($field_path)) {
            mkdir($field_path, 0777, true);
        }
        $cat_path = $field_path . "/" . $cat_text;
        if (!file_exists($cat_path)) {
            mkdir($cat_path, 0777, true);
        }
        $target_dir = $cat_path . "/";
        $prefix = $_SESSION['cpf'] . "_" . time() . "_";
        $filename = $prefix . basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $filename;
        //echo $target_file;
        $uploadOk = 1;
        /*if ($_FILES["fileToUpload"]["size"] > 500000) {
            $uploadOk = 0;
        }*/
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        if($uploadOk){
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
            $title = esc($_POST['title']);
            $content = esc($_POST['content']);
            $tags = esc($_POST['tags']);
            $query = "insert into repo_data values($field_id, $cat_id, '$title', '$tags', '$content', '$target_dir','$filename')";
            $result = mysqli_query($conn, $query);
            $_SESSION['status'] = "success";
            $_SESSION['msg'] = "File uploaded successfully.";
        }else{
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "Error encountered while uploading file. Please try again.";
        }
        $_SESSION['field_id'] = $field_id;
        $_SESSION['tab_control'] = "#upload-body";
    }elseif($action == 'browse'){
        $field_id = esc($_POST['field_id']);
        $cat_id = esc($_POST['cat_id']);
        if(isset($_POST['title_chk'])){
            $title_chk = esc($_POST['title_chk']);
        }
        if(isset($_POST['content_chk'])){
            $content_chk = esc($_POST['content_chk']);
        }
        if(isset($_POST['tags_chk'])){
            $tags_chk = esc($_POST['tags_chk']);
        }
        $search_text = esc($_POST['search_text']);
        /*$query = "select title,tags,content,path,filename from repo_data where field_id = $field_id and cat_id = $cat_id";*/
        $query = "select title,tags,content,path,filename from repo_data where field_id = $field_id";
        if($cat_id != 0){
            $query  = $query . " and cat_id = $cat_id";
        }
        if($title_chk){
          $query = $query . " and title LIKE '%$search_text%'";
        }
        elseif($content_chk){
          $query = $query . " and content LIKE '%$search_text%' ";
        }
        elseif($tags_chk){
          $query = $query . " and tags LIKE '%$search_text%' ";
        }
        elseif($title_chk &&  $content_chk){
          $query = $query . " and title LIKE '%$search_text%' and content LIKE '%$search_text%' ";
        }
        elseif($content_chk && $tags_chk){
          $query = $query . " and tags LIKE '%$search_text%' and content LIKE '%$search_text%' ";
        }
        elseif($tags_chk && $title_chk){
          $query = $query . " and title LIKE '%$search_text%' and tags LIKE '%$search_text%' ";
        }
        elseif($title_chk && $tags_chk && $content_chk){
          $query = $query . " and title LIKE '%$search_text%' and content LIKE '%$search_text%' and tags LIKE '%$search_text%'  ";
        }
        //echo $query;
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            $a = array();
            header('Content-type: application/json');
            while($row = mysqli_fetch_assoc($result)){
                array_push($a,json_encode($row));
            }
            $_SESSION['status'] = "success";
            $_SESSION['msg'] =  mysqli_num_rows($result) . " record(s) found for given search query.";
            $_SESSION['context'] = "browse";
            $_SESSION['json'] = json_encode($a);
        }else{
            $_SESSION['status'] = "error";
            $_SESSION['msg'] = "No record found for given search query.";
        }
        $_SESSION['field_id'] = $field_id;
        $_SESSION['tab_control'] = "#browse-body";
    }
    header("location:home.php");
}

?>

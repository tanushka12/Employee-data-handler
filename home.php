<?php
    include_once("common.php");
    $field_id = 0;
    $tab_control = "#upload-body";
    if(isset($_SESSION['field_id'])){
        $field_id = $_SESSION['field_id'];
    }
    if(isset($_SESSION['tab_control'])){
        $tab_control = $_SESSION['tab_control'];
    }
?>
<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <script src="js/jquery-1.12.3.min.js"> </script>
    <script src="js/bootstrap.min.js"> </script>
    <script src="js/verify.notify.min.js"> </script>
    <title> CUBE Home </title>
    <script>

        function getCat(control){
            $.getJSON("db.php?request=cat",function (result){
                $.each(result, function (i, element) {
                    element = jQuery.parseJSON(element);
                    $(control).append("<option value=" + element.cat_id + ">" + element.name + "</option>");
                });
            });
        }

        function selectCat(control,id_val,id_text){
            var cat_id = $(control + " option:selected");
            $(id_val).val(cat_id.val());
            $(id_text).val(cat_id.text());
        }

        function getUpload(){
            var innerHTML = `<br> <form role="form" action="db.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            </div>
                            <div class="form-group">
                                <input type="textarea" class="form-control" id="content" name="content" placeholder="Content">
                            </div>
                            <div class="form-group">
                                <input type="textarea" class="form-control" id="tags" name="tags" placeholder="Tags">
                            </div>
                            <select class="form-control" id="up-cat-select" onchange="selectCat('#up-cat-select','#up-cat-id','#up-cat-text')">
                                <option>Select Category</option>
                            </select>
                            <br> <input type="file" class="form-control" name="fileToUpload" id="fileToUpload"/> <br>
                            <input type="hidden" id="action" name="action" value="upload" />
                            <input type="hidden" id="up-field-id" name="field_id" value="" />
                            <input type="hidden" id="up-field-text" name="field_text" value="" />
                            <input type="hidden" id="up-cat-id" name="cat_id" value="" />
                            <input type="hidden" id="up-cat-text" name="cat_text" value="" />
                            <center> <input type="submit" class="btn btn-default" value="Upload"/> </center>
                        `;
            $("#upload-body").html("");
            $("#upload-body").html(innerHTML);
            getCat("#up-cat-select");
        }

        function getBrowse(){
            var innerHTML = `<br> <form role="form" action="db.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search_text" name="search_text" placeholder="Search Text">
                            </div>
                            <select class="form-control" id="br-cat-select" onchange="selectCat('#br-cat-select','#br-cat-id','#br-cat-text')">
                              <option value = 0>All Categories</option>
                            </select>
                            <br>
                            <div class="form-control">
                                <label> Search In: </label>
                                <label class="checkbox-inline"><input type="checkbox" name = "title_chk" value="true">Title</label>
                                <label class="checkbox-inline"><input type="checkbox" name = "content_chk" value="Yes">Content</label>
                                <label class="checkbox-inline"><input type="checkbox" name = "tags_chk" value="true">Tags</label>
                            </div>
                            <br> <br>
                            <input type="hidden" id="action" name="action" value="browse" />
                            <input type="hidden" id="br-field-id" name="field_id" value="" />
                            <input type="hidden" id="br-field-text" name="field_text" value="" />
                            <input type="hidden" id="br-cat-id" name="cat_id" value="" />
                            <input type="hidden" id="br-cat-text" name="cat_text" value="" />
                            <center> <input type="submit" class="btn btn-default" value="Browse"/> </center>
                        </form>
                `;
            $("#browse-body").html("");
            $("#browse-body").html(innerHTML);
            getCat('#br-cat-select');
        }

        function summaryClick(field_id, cat_id){
            var innerHTML = `<table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Tags</th>
                                <th>Attachment</th>
                            </tr>
                        `;
            $.when(
                $.getJSON("db.php?request=summary-click&field_id=" + field_id + "&cat_id=" + cat_id, function(result){
                    $.each(result, function(i, element){
                        element = jQuery.parseJSON(element);
                        innerHTML += '<tr> <td>' + element.title + '</td> <td>' + element.content + '</td> <td>' + element.tags + '</td> <td> <a href="' + element.path + element.filename + '" target="_blank"> Download </td> <td><button><a href="delete.php">Delete</a></button></td></tr>';
                    });
                })
            ).then(function(){
                innerHTML += '</table>';
                $("#browse-table").html(innerHTML);
                $("#browse-modal").modal();
                $('#browse-modal').on('hidden.bs.modal', function (e) {
                    memPage(field_id);
                });
            });
        }

        function getSummary(field_id){
            $("#summary-body").html("");
            var innerHTML = '<center> <h4> Summary </h4> </center> <br> <ul class="list-group">';
            $.when(
                $.getJSON("db.php?request=cat-summary&field_id=" + field_id,function (result){
                    $.each(result, function(i, element){
                        element = jQuery.parseJSON(element);
                        innerHTML = innerHTML + '<li class="list-group-item" onclick = "summaryClick(' + field_id + ',' + element.cat_id + ')" style = "cursor:pointer"><span class="badge">'+ element.total + '</span>' + element.name + '</li>';
                    });
                })
            ).then(function(){
                innerHTML = innerHTML + '</ul>';
                $("#summary-body").html(innerHTML);
            });
        }

        function getFieldDetails(field_id){
            $("#field-desc").html("");
            $("#field-desc").html("<label>Field Description:</label> <br> <textarea class='form-control' rows='12' id = 'field-desc-text' readonly> </textarea>");
            var desc = "",src = "";
            $.when(
                $.getJSON("db.php?request=field-desc&field_id=" + field_id,function (result){
                    $.each(result, function(i, element){
                        element = jQuery.parseJSON(element);
                        desc = desc + element.description;
                        
                    });
                })
            ).then(function(){
                $("#field-desc-text").val(desc);
                
            });
        }

        function selectField() {
            var field = $("#field-select option:selected");
            var field_id = field.val();
            var field_text = field.text();
            getUpload();
            getBrowse();
            getSummary(field_id);
            getFieldDetails(field_id);
            $("#up-field-id").val(field_id);
            $("#up-field-text").val(field_text);
            $("#br-field-id").val(field_id);
            $("#br-field-text").val(field_text);
        }

        function showBrowse(result,field_id){
            var innerHTML = `<table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Tags</th>
                                <th>Attachment</th>
                            </tr>
                        `;
            $.each(result, function(i, element){
                element = jQuery.parseJSON(element);
                innerHTML += '<tr> <td>' + element.title + '</td> <td>' + element.content + '</td> <td>' + element.tags + '</td> <td> <a href="' + element.path + element.filename + '" target="_blank"> Download </td> </tr>';
            });
            innerHTML += '</table>';
            $("#browse-table").html(innerHTML);
            $("#browse-modal").modal();
            $('#browse-modal').on('hidden.bs.modal', function (e) {
                memPage(field_id);
            });
        }

        function memPage(field_id){
            if(field_id){
                $("#field-select").val(field_id).change();
            }
        }

        function pageLoad(field_id,tab_control){
            $.when(
                $.getJSON("db.php?request=field", function (result) {
                    $.each(result, function (i, element) {
                        element = jQuery.parseJSON(element);
                        $("#field-select").append("<option value=" + element.field_id + ">" + element.name + "</option>");
                    });
                })
            ).then(function(x){
                memPage(field_id);
                $("#tab-control a[href='" + tab_control + "']").tab('show');
            });
        }

        function selectAccessField(){
            var field = $("#access-select option:selected");
            var field_id = field.val();
            alert(field_id);
            $("#access-field-id").val(field_id);
        } 
        function getAccessFieldList(){
          $('#access-modal').on('shown.bs.modal', function () {
           $.getJSON("db.php?request=field", function (result) {
                $.each(result, function (i, element) {
                    element = jQuery.parseJSON(element);
                    $("#access-select").append("<option value=" + element.field_id + ">" + element.name + "</option>");

                });
            });
          });

        } 

    </script>
</head>

<body onload=<?php echo "pageLoad($field_id,'$tab_control')"; ?>>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"> CUBE </a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" > <strong> <?php echo $_SESSION['name']; ?> </strong>  </a>
                   <li><a href="#logout-modal" data-target="#logout-modal" data-toggle="modal"><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>
                <li><a href='delete.php'> Delete Account </a></li>
                       
                </li>
            </ul>
        </div>
    </nav>



    <div id="logout-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> <h3 class="modal-title">CUBE Logout</h3> </center>
                </div>
                <div class="modal-body">
                    <form role="form" action="account.php" method="post">
                        <p> Are you sure you want to logout ? </p>
                        <center>
                            <input type="hidden" name="action" value="logout" />
                            <input type="submit" class="btn btn-default" value="Yes">
                            <button type="button" class="btn btn-default" data-dismiss="modal"> No </button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br /> <br />
    <div class="container-fluid">
	
	<center>
	<br>
				<marquee behavior="alternate"><h3> Welcome to CUBE</h3></marquee>
                    <img src="images/cube.png" height="200" width="200" class="img-thumbnail">
                    <br />
                    
                </center>
                <br /><br />
        <div class="row">
            <div class="col-lg-4">
                
                <label> Choose department: </label>
                <select class="form-control" name="field-select" id="field-select" onchange="selectField()">
                    <option>Select department here</option>
                </select>
                <br /><br />
                <div id="field-desc"></div>
            </div>
            <div class="col-lg-4">
	           <ul class="nav nav-tabs" id="tab-control">
                    <li class="active"><a data-toggle="tab" href="#upload-body">Upload</a></li>
                    <li><a data-toggle="tab" href="#browse-body">Browse</a></li>
                </ul>
                <div class="tab-content">
                    <div id="upload-body" class="tab-pane fade in active"></div>
                    <div id="browse-body" class="tab-pane fade"></div>
                </div>
            </div>
            <div class="col-lg-4">                
                <div id="summary-body" style="overflow-y: auto;"></div>
            </div>
        </div>
    </div>

    <div id="browse-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> <h3 class="modal-title">CUBE - Browse</h3> </center>
                </div>
                <div class="modal-body" id="browse-table">
                </div>
            </div>
        </div>
    </div>

    <?php

        if(isset($_SESSION['status']) && isset($_SESSION['msg'])){
            $status = $_SESSION['status'];
            $msg = $_SESSION['msg'];
            echo "<script> $.notify('$msg', { className: '$status', globalPosition: 'right middle', autoHideDelay: 7000 }); </script>";
            unset($_SESSION['status']);
            unset($_SESSION['msg']);
        }

        if(isset($_SESSION['context']) && isset($_SESSION['json'])){
            $json = $_SESSION['json'];
            $context = $_SESSION['context'];
            if($context == 'browse'){
                echo "<script> showBrowse($json,$field_id); </script>";
            }
            unset($_SESSION['context']);
            unset($_SESSION['json']);
        }





    ?>

</body>
</html>

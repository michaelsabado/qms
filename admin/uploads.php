<?php
session_start();
include '../database/dbconfig.php';


if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] != 1) {
    header("Location: ../main/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>QMS | Uploads</title>
    <style>
        h3 {
            line-height: 30px;
            text-align: center;
        }

        #drop_file_area {
            height: 200px;
            border: 2px dashed #ccc;
            line-height: 200px;
            text-align: center;
            font-size: 20px;
            background: #f9f9f9;
            margin-bottom: 15px;
        }

        /* .drag_over {
            color: #000;
            border-color: #000;
        } */
    </style>
</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_admin_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_admin_nav.php' ?>

            <div class="content p-5" style="height: calc(100vh - 72px); overflow-y: auto">
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-photo-film me-3"></i>Manage Uploads</div>


                <div class="card round-2 border-0 shadow-sm mb-3">
                    <div class="card-body p-4">
                        <div class="smalltxt mb-2 text-muted fst-italic">Media uploaded will be displayed as announcement/advertisement to clients.</div>
                        <div class="container">

                            <div id="drop_file_area" class="round-1 h6" ondragenter="$(this).addClass('bg-info')" ondragleave="$(this).removeClass('bg-info')" ondrop="$(this).removeClass('bg-info')">
                                Drag and Drop Files Here
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card round-2 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center" id="medias">


                        </div>
                    </div>
                </div>



            </div>

            <?php include '../partials/_admin_footer.php' ?>

            <script>
                $(document).ready(function() {
                    $("#nav-uploads").addClass('mynav-active');
                    getMedias();
                    $("html").on("dragover", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                    });

                    $("html").on("drop", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                    });

                    $('#drop_file_area').on('dragover', function() {
                        $(this).addClass('drag_over');
                        return false;
                    });

                    $('#drop_file_area').on('dragleave', function() {
                        $(this).removeClass('drag_over');
                        return false;
                    });

                    $('#drop_file_area').on('drop', function(e) {
                        e.preventDefault();
                        $(this).removeClass('drag_over');
                        var formData = new FormData();
                        var files = e.originalEvent.dataTransfer.files;
                        for (var i = 0; i < files.length; i++) {
                            formData.append('file[]', files[i]);
                        }
                        uploadFormData(formData);
                    });

                    function uploadFormData(form_data) {
                        $.ajax({
                            url: "php/file_upload.php",
                            method: "POST",
                            data: form_data,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(data) {
                                getMedias();
                            }
                        });
                    }

                    function getMedias() {
                        $("#medias").load("php/getmedias.php");
                    }



                });


                function deleteMedia(mediaid) {
                    Swal.fire({
                        title: 'Are you sure?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {



                            $.post('php/deleteMedia.php', {
                                mediaid
                            }, function(data) {
                                if (data == 1) {
                                    $("#medias").load("php/getmedias.php");

                                    Swal.fire(
                                        'Success!',
                                        'Media has been deleted.',
                                        'success'
                                    )
                                } else {
                                    alert(data);
                                }
                            });



                        }
                    })
                }


                function updateMedia(id, val) {

                    if (val == 1) val = 0
                    else if (val == 0) val = 1
                    $.post("php/updatemedia.php", {
                        id,
                        val
                    }, function(data) {
                        console.log(val + ' ' + data);
                        $("#medias").load("php/getmedias.php");
                    });


                }
            </script>

</body>

</html>
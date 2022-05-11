<?php 
    session_start();
    session_destroy(); 
    // header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@200;300;400;500;600&display=swap');
        *{
            font-family: 'Prompt', sans-serif;
        }
        
        a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <script>
        Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'ออกจากระบบสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                }).then((result) =>{
                    window.location.href='index.php';
                });
    </script>
</body>
</html>
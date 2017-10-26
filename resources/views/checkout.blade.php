<html>
<head>
    <title>Merchant Check Out Page</title>
</head>
<body>
<center>
<h1>Please do not refresh this page...</h1>
</center>

<form method="post" action="<?php echo $url; ?>" name="f1">
    <table border="1">
        <tbody>
        <?php
        foreach($param as $name => $value) {
            echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
        }
        ?>
        </tbody>
    </table>
    <script type="text/javascript">
        document.f1.submit();
    </script>
</form>
</body>
</html>
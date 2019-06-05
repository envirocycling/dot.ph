<script>
    function closeMe(){
    window.close();
    }
</script>
<?php
$id=$_GET['id'];

echo "<h3>Are you sure you sant to hide this supplier with id number <b><u>$id</u></b> ?";
echo "<hr>";
echo "<a href='hide_supplier.php?id=$id'><button>Yes</button></a>";
echo "<button onclick='closeMe();'>No</button>";
?>   
</main>
<?php 
$basePath = ($page == "Dashboard") ? "../" : (($page != "Home") ? "../../" : "");
?>
<script src="<?= $basePath ?>public/js/sidebar.js"></script>
<script src="<?= $basePath ?>public/js/dropdown.js"></script>
</body>
</html>

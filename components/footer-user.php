</main>

<?php
$footerPath = ($page != "Home") ? "../../public" : "public";
// $actionPath = ($page != "Home") ? "/playstation/" : "/playstation/";
?>
<script src="<?= $footerPath ?>/js/dropdown.js"></script>
<script>
    function autoCancelBooking() {
        fetch('/playstation/action/booking/auto_cancel.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(message => {
                    alert(message);
                    console.log(message);
                    window.location.reload();
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    setInterval(autoCancelBooking, 60000);

    autoCancelBooking();
</script>
<footer class="footer">
        <p>&copy; 2021 Concert Starlight Symphony</p>
    </footer>
</body>

</html>
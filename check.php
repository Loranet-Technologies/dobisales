<script type="text/javascript">
        var chk = 0;
        chk = localStorage.getItem('chk');
        if(chk==1)
        {
                
        }
        else
        {
                alert("Page is secured. Please login first");
                        window.location.href = 'index.php';
        }
</script>
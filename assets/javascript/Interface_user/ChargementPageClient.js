<script >
$(document).ready(function() {
    $('#submit').click(function() {
        var form_data = {
            username : $('.username').val(),
            ajax : '1'
        };
$.ajax({
    url: "<?php echo site_url('simulation/lancerSimu'); ?>",
    type: 'POST',
    async : false,
    data: form_data,
    success: function (data) {
    alert('test');
    }
});
return false;
});

});

</script>
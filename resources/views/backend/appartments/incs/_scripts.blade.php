<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('backend/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">
    $(document).on('change', '#hasBeds', function(event) {
        let availbeds = document.getElementById('availableBeds');
        let hasbeds   = document.getElementById('hasBeds');
        availbeds.value = hasbeds.value;
    });
</script>


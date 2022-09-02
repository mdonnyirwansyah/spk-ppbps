<script>
    $(document).ready( function() {
        $('#form-update-status').submit(function (e) {
            e.preventDefault();
            $('#btn').attr('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.success) {
                        toastr.success(response.success, 'Selamat,');
                    } else if(response.warning) {
                        toastr.warning(response.warning, 'Peringatan,');
                        $('#btn').attr('disabled', false);
                    } else if(response.failed) {
                        toastr.error(response.failed, 'Gagal,');
                        $('#btn').attr('disabled', false);
                    } else {
                        printErrorMsg(response.error);
                        $('#btn').attr('disabled', false);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
                }
            });
        });
    });
</script>

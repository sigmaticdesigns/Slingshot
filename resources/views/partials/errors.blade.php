@if (count($errors) > 0)
    <script>
        $(function() {
            toastr["error"]("{{ addcslashes(join('<br />', $errors->all()), '\"') }}");
        });
    </script>
@endif
@if (session('error.message'))
    <script>
        $(function() {
            toastr["error"]("{{ addcslashes(session('error.message'), '\"') }}", "Error !", { timeOut: {{ session('timeout.message', 10000) }} })
        });
    </script>
@endif
@if (session('success.message'))
    <script>
        $(function() {
            toastr["success"]("{{ addcslashes(session('success.message'), '\"') }}", "Success !", { timeOut: {{ session('timeout.message', 10000) }} })
        });
    </script>
@endif
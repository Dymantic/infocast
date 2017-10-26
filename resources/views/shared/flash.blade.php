@if(session()->has('flash_message'))
    <script>
        swal({
            icon: "{{ session('flash_message.icon') }}",
            title: "{{ session('flash_message.title') }}",
            text: "{{ session('flash_message.text') }}",
            button: false,
            timer: 2000
        });
    </script>
@endif
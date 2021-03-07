@if (session('success'))
    <script>
        Swal.fire({
            position: 'top-start',
            icon: 'success',
            text: '{{ Str::title(session('success')) }}',
            showConfirmButton: false,
            timer: 1500
        })
        const Toast = Swal.mixin({
            background: 'rgb(179,233,252)',
            iconColor: '#02c600',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: '{{ Str::title(session('success')) }}'
        })
    </script>
@php
Session::remove('success');
@endphp
@endif

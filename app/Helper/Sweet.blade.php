<script>
    @if(session()->has('flash_message'))
    Swal.fire({
        icon: "{{session('flash_message.level')}}",
        title: "{{session('flash_message.title')}}",
        text: "{{session('flash_message.message')}}",
        showConfirmButton: "{{session('flash_message.button')}}",
        timer: 1500,
        //position: 'top',                              // Pozisyon : top - top-end
    });
    @endif
</script>



{{--const Toast = Swal.mixin({
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
title: 'Signed in successfully'
})--}}

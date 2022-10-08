@if(session('message'))
    <script>
        $(function(){
            if ('{{session('title')}}'==''){
                title = 'Notification';
            }else{
                title = '{{session('title')}}';
            }
            new PNotify({
                title: title,
                text: '{{session('message')}}',
                type: '{{session('status')}}',
                styling: 'bootstrap3',
                delay: 3000
            })
        });
    </script>
@endif

{{--You can add more custom ones here--}}
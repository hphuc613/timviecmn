{{--https://www.cssscript.com/bootstrap-5-toast-generator --}}
@if(session('success'))
    <script>
        new bs5.Toast({
            className: 'border-0 bg-success text-white',
            header: `
		<svg width="24" height="24" class="text-success me-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
		</svg>
		<h6 class="mb-0">Success!</h6>
		`,
            body: '{{ session('success') }}',
        }).show()

    </script>
@endif

@if(session('danger'))
    <script>
        new bs5.Toast({
            className: 'border-0 bg-danger text-white',
            header: `
		<i style="font-size: 24px"  class="text-danger far fa-times-circle me-2"></i>
		<h6 class="mb-0">Fail!</h6>
		`,
            body: '{{ session('danger') }}',
        }).show()

    </script>
@endif

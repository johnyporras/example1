@push('styles')
<link rel="stylesheet" href="{{ url('plugins/toastr-js/toastr.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('plugins/toastr-js/toastr.min.js') }}"></script>
@endpush

@if(Session::has('toasts'))
<script type="text/javascript">
	toastr.options = {
			"closeButton": true,
			"newestOnTop": true,
			"positionClass": "toast-top-right",
			"progressBar": true
		};

	@foreach(Session::get('toasts') as $toast)
		toastr["{{ $toast['level'] }}"]("{{ $toast['message'] }}","{{ $toast['title'] }}");
	@endforeach
</script>
@endif
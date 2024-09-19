<script src="{{asset('/js/manifest.js')}}?v={{sha1_file(public_path('/js/manifest.js'))}}"></script>
<script src="{{asset('/js/vendor.min.js')}}?v={{sha1_file(public_path('/js/vendor.min.js'))}}"></script>
<script src="{{asset('/js/app.min.js')}}?v={{sha1_file(public_path('/js/app.min.js'))}}"></script>


{{-- visually impaired plagin --}}
<script src="{{asset('/lib/jquery.min.js')}}"></script>
<script src="{{asset('/lib/visually-impaired/dist/js/bvi.min.js')}}"></script>
<script src="{{asset('/lib/visually-impaired/dist/js/bvi-init.js')}}"></script>
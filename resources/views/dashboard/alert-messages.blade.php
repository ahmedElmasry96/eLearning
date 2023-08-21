
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
    @if (session()->has('add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{ trans('dashboard/message.add') }}",
                    type: "success"
                });
            }

        </script>
    @endif

    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{ trans('dashboard/message.edit') }}",
                    type: "success"
                });
            }

        </script>
    @endif

    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "{{ trans('dashboard/message.delete') }}",
                    type: "success"
                });
            }

        </script>
    @endif

    @if (session()->has('error'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ trans('dashboard/message.error') }}",
                type: "success"
            });
        }

    </script>
@endif
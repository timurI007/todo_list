@if ($errors->any())
    <div class="error-list">
        <ul>
            @foreach ($errors->all() as $error)
                <li>
                    <x-alert type="error" :message="$error" />
                </li>
            @endforeach
        </ul>
    </div>
@endif

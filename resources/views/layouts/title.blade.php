<div id="jCrumbs" class="breadCrumb module">
    <ul>
        <li>
            <a href="#"><i class="icon-folder-open"></i></a>
        </li>
        <li>
            {{ session()->get('menu') }}
        </li>
        @if(session()->has('submenu'))
            <li>
                {{ session()->get('submenu') }}
            </li>
        @endif
    </ul>
</div>
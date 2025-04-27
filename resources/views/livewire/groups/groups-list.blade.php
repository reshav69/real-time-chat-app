<div>
    <div>
        <h2>My groups</h2>
        @foreach ($myGroups as $group)
            <a href="">{{$group->name}}</a>
        @endforeach
    </div>
</div>

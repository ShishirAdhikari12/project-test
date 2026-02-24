@props(['user', 'size'=>'w-10 h-10'])
<div>
    @if ($user->image)
        <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}" class="{{ $size }} object-cover rounded-full ">
    @else
        <img src="/user-avatar.png" alt="avatar" class="{{ $size }} object-cover rounded-full">
    @endif
</div>

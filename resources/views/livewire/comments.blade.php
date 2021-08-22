<div>
    <div class="container mt-4">
        @include('sweet::alert')        
        <form class="row g-3" wire:submit.prevent="addComment">
            <div class="col-10">                
                <input wire:model.debounce.500ms="newComment" type="text" class="form-control" placeholder="Comments">
            @error('newComment') <span class="error mt-0 fs-6 text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-2">
                <button type="submit" class="w-100 btn btn-primary mb-3">Submit</button>
            </div>
        </form>
        @foreach($comments as $comment)
        <div class="counter-comments mb-2">
            <figure>
                <blockquote class="blockquote d-flex justify-content-between">
                    <p>{{ $comment->creator->name }}</p>
                    <span class="material-icons text-muted" wire:click="remove({{$comment->id}})">highlight_off</span>
                </blockquote>
                <figcaption class="blockquote-footer">
                {{ $comment->created_at->diffForHumans() }}
                </figcaption>
            </figure>
            <small class="text-muted">{{ $comment->body }}</small>
        </div>
        @endforeach
    </div>    
</div>

@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
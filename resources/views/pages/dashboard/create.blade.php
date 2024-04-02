@extends('layouts.app')

@section('content')
    <main class="container py-3">

        <h1>Aggiungi un nuovo progetto</h1>

        <form action=" {{ route('dashboard.project.store') }} " method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input
                    type="text"
                    class="form-control
                        @error('title')
                            is-invalid
                        @enderror"
                    name="title"
                    id="title"

                />
                @error('title')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <input
                type="file"
                name="cover_image"
                id="cover_image"
                class="form-control
                    @error('cover_image')
                        is-invalid
                    @enderror">
            </div>

            {{-- select per selezionare il tipo --}}
            <div class="mb-3">

                <label for="type_id" class="form-label">Type</label>

                <select
                class="
                form-select
                form-select-md
                @error('type_id')
                    is_invalid
                @enderror"
                name="type_id"
                id="type_id">

                    <option selected value="">Select One</option>

                    @foreach ($types as $item)

                        <option value="{{ $item->id }}"{{ $item->id == old('type_id') ? 'selected' : ''}}>

                            {{ $item->name }}

                        </option>

                    @endforeach

                </select>

            </div>


            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea
                class="form-control
                        @error('content')
                            is-invalid
                        @enderror"
                name="content"
                id="content"
                rows="3"
                ></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Crea</button>



        </form>

    </main>
@endsection

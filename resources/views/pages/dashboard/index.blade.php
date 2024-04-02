@extends('layouts.app')

@section('content')
    <main class="container py-3">
        <h1>Lista dei progetti</h1>

        <a class="btn btn-primary" href=" {{ route('dashboard.project.create') }} ">Create</a>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Type</th>
                        <th scope="col">Cover</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $item)
                    <tr class="">
                        <td>{{ $item->id }}</td>
                        <td>
                            <a href=" {{ route('dashboard.project.show', $item->id) }} ">
                                {{ $item->title }}
                            </a>
                        </td>
                        <td>{{ $item->content }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->type ? $item->type->name : 'Non è stato selezionato un Tipo'}}</td>
                        <td>{{ $item->cover_image ? 'si' : 'no'}}</td>
                        <td>
                            <a class="btn btn-primary" href=" {{ route('dashboard.project.edit', $item->id ) }} ">
                                Modifica
                            </a>

                            <form method="POST" action=" {{route( 'dashboard.project.destroy', $item->id )}} ">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>


    </main>
@endsection

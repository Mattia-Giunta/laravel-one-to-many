@extends('layouts.app')

@section('content')


        <div class="container-fluid w-75 ">

            <div class="row text-center">

                <div class="col ">

                    <h1 class="mt-3 text-uppercase ">{{ $project->title }}</h1>


                    @if ($project->cover_image)
                        <img class="img-fluid" src="{{ asset('/storage/' . $project->cover_image) }}" alt="{{ $project->title }}">
                    @endif

                    <p>
                        <strong>
                            {{ $project->type ? $project->type->name : 'Non è stato selezionato un Tipo'}}
                        </strong>
                    </p>

                    <p class="mt-3 text-uppercase ">{{ $project->content }}</p>

                </div>


            </div>


        </div>




@endsection

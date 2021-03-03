@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2">
            <div class="sticky-top py-2">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">
                        <i class="fas fa-search"></i>
                    </span>
                    </div>
                </div>

                <h4>Game Colors</h4>

                <p class="my-3">Find the colors of your favourite video games!</p>

                <a class="btn btn-primary" href="#">Create Your Own Palette</a>
            </div>
        </div>
        <div class="col-md-10">
            <palettes-component></palettes-component>
        </div>
    </div>
@endsection

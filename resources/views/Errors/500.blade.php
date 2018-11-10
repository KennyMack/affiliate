@extends('layouts.app')

@section('content')
    <div class="modal fade show" style="padding-right: 15px; display: block;" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Problema interno</h5>
                </div>
                <div class="modal-body">
                    500 Problema interno
                </div>
                <div class="modal-footer">
                    <a href="/" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                        Home </a>
                </div>
            </div>
        </div>
    </div>

@endsection

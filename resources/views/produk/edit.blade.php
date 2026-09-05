@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@include('layouts.navbar')

<style>
    .edit-page {
        background: #fff9fc;
        min-height: calc(100vh - 60px);
        padding: 35px 0 50px;
    }

    .edit-header {
        margin-bottom: 25px;
    }

    .page-title {
        color: #4f3540;
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #947682;
        font-size: 14px;
    }

    .edit-wrapper {
        max-width: 850px;
        margin: 0 auto;
    }

    .edit-card {
        background: #ffffff;
        border: 1px solid #f3dce6;
        border-radius: 16px;
        box-shadow: 0 5px 18px rgba(225, 150, 180, 0.10);
        padding: 25px;
    }
</style>


<div class="edit-page">

    <div class="container">

        <div class="edit-wrapper">

            {{-- HEADER --}}
            <div class="edit-header">

                <h2 class="page-title">
                    Edit Produk
                </h2>

                <p class="page-subtitle mb-0">
                    Ubah foto, nama, harga, atau stok produk.
                </p>

            </div>


            {{-- FORM --}}
            <div class="edit-card">

                <form
                    action="{{ route('produk.update', $produk) }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @method('PUT')

                    @include('produk._form')

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
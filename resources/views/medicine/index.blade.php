@extends('layouts.app')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Medicine</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Medicine</li>
        <li class="breadcrumb-item active">Index</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Medicine Index</h5>
            <p>Information about all medicine data</p>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Code</th>
                  <th scope="col">Name</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Additional Data</th>
                  <th scope="col">Created At</th>
                </tr>
              </thead>
              <tbody>
                @foreach($medicines as $key => $medicine)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $medicine->obatalkes_kode }}</td>
                  <td>{{ $medicine->obatalkes_nama }}</td>
                  <td>{{ $medicine->stok }}</td>
                  <td>{{ $medicine->additional_data }}</td>
                  <td>{{ date('d/m/Y', strtotime($medicine->created_date)) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection

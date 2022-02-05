@extends('layouts.app')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Signa</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Signa</li>
        <li class="breadcrumb-item active">Index</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Signa Index</h5>
            <p>Information about all signa data</p>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Code</th>
                  <th scope="col">Name</th>
                  <th scope="col">Additional Data</th>
                  <th scope="col">Created At</th>
                </tr>
              </thead>
              <tbody>
                @foreach($signas as $key => $signa)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $signa->signa_kode }}</td>
                  <td>{{ $signa->signa_nama }}</td>
                  <td>{{ $signa->additional_data }}</td>
                  <td>{{ date('d/m/Y', strtotime($signa->created_date)) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

            {{ $signas->links() }}
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->
@endsection

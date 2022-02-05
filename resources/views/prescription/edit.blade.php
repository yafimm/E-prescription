@extends('layouts.app')

@section('content')
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Prescription</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('prescription.index') }}">Prescription</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h5>Prescription Create</h5>
              <a href="{{ route('prescription.create') }}" class="btn btn-primary">Add Data</a>

            </div>
            <p>Information about all prescription data</p>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Created By</th>
                  <th scope="col">Created At</th>
                </tr>
              </thead>
              <tbody>
                @foreach($prescriptions as $key => $prescription)
                <tr>
                  <th scope="row">{{ $key + 1 }}</th>
                  <td>{{ $prescription->name }}</td>
                  <td>{{ $prescription->user->name }}</td>
                  <td>{{ $prescription->created_at->format('d/m/Y') }}</td>
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
